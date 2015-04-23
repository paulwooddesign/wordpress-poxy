<?php
//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_product_taxonomies' );

function poxy_create_product_taxonomies() {

$labels = array(
      'name' => __( 'Categories' ),
      'singular_name' => __( 'Category' ),
      'search_items' =>  __( 'Search Categories' ),
      'all_items' => __( 'All Categories' ),
      'parent_item' => __( 'Parent Category' ),
      'parent_item_colon' => __( 'Parent Category:' ),
      'edit_item' => __( 'Edit Category' ),
      'update_item' => __( 'Update Category' ),
      'add_new_item' => __( 'Add New Category' ),
      'new_item_name' => __( 'New Category' )
    );

    register_taxonomy('product_cat', array('product'), array(
      'labels' => $labels,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'products', 'hierarchical' => true, 'with_front' => false)
    ));

  flush_rewrite_rules( false );


}


//////////////////////////////////////////////////////////////
// CREATE Products POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_products_post_type' );

function poxy_create_products_post_type() {

  $labels = array(
    'name' => __( 'Products' ),
    'singular_name' => __( 'Product' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Product' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Product' ),
    'new_item' => __( 'New Product' ),
    'view' => __( 'View Product' ),
    'view_item' => __( 'View Product' ),
    'search_items' => __( 'Search Products' ),
    'not_found' => __( 'No Products found' ),
    'not_found_in_trash' => __( 'No Products found in Trash' ),
    'parent' => __( 'Parent Product' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
   // 'rewrite' => array('slug' => 'team'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'thumbnail', 'editor', 'revisions', 'excerpt')
  );

  register_post_type( 'product' , $args );
  flush_rewrite_rules( false );

}



//////////////////////////////////////////////////////////////
// PERMALINKS
/////////////////////////////////////////////////////////////
function keha_add_rewrite_rules() {
  // add_rewrite_rule( '^products/(.+?)/(.+?)/(.+?)/(.+?)$', 'index.php?product_cat=$matches[1]&product_cat=$matches[2]&product_cat=$matches[3]&product=$matches[4]', 'top' );
  add_rewrite_rule( '^products/(.+?)/(.+?)/(.+?)$', 'index.php?product_cat=$matches[1]&product_cat=$matches[2]&product_cat=$matches[3]', 'top' );
  // add_rewrite_rule( '^products/(.+?)/(.+?)/(.+?)$', 'index.php?product_cat=$matches[1]&product_cat=$matches[2]&product=$matches[3]', 'top' );
  // add_rewrite_rule( '^products/(.+?)/(.+?)/$', 'index.php?product=$matches[2]', 'top' );
  // add_rewrite_rule( '^products/(.+?)/(.+?)/(.+?)$', 'index.php?product=$matches[3]', 'top' );
  add_rewrite_rule( '^products/(.+?)/(.+?)/?$', 'index.php?product_cat=$matches[2]', 'top' );
  add_rewrite_rule( '^products/(.+?)$', 'index.php?product_cat=$matches[1]', 'top' );
}
add_action('init', 'keha_add_rewrite_rules');

function keha_post_type_link( $post_link, $post, $leavename ) {

        global $wp_rewrite;

        $draft_or_pending = isset( $post->post_status ) && in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft' ) );
        if ( $draft_or_pending and !$leavename ) {
                return $post_link;
        }

        if ( $post->post_type == 'product' ) {

                $post_type_object = get_post_type_object( $post->post_type );
                $post_link = home_url() . '/' . $post_type_object->rewrite['slug'] . '/';
                $parent_dirs = '';
                if ( $terms = get_the_terms( $post->ID, 'product_cat' ) ) {
                        foreach ( $terms as $term ) {
                                if ( $term->parent != 0 ) {
                                        $dirs = keha_get_taxonomy_parents( $term->term_id, 'product_cat', false, '/', true );
                                } else {
                                        $dirs = $term->slug.'/';
                                }
                        }
                }
                $post_link = $post_link . $dirs . $post->post_name;
        }

        return $post_link;
}
add_filter( 'post_type_link', 'keha_post_type_link', 10, 3 );

/**
 * Custom function based on WordPress own get_category_parents()
 * @link http://core.trac.wordpress.org/browser/tags/3.6.1/wp-includes/category-template.php#L0
 *
 * @param integer $id
 * @param string $taxonomy
 * @param string $link
 * @param string $separator
 * @param string $nicename
 * @param array $visited
 * @return string
 */

function keha_get_taxonomy_parents( $id, $taxonomy = 'category', $link = false, $separator = '/', $nicename = false, $visited = array() ) {
        $chain = '';
        $parent = get_term( $id, $taxonomy, OBJECT, 'raw');
        if ( is_wp_error( $parent ) ) {
                return $parent;
        }

        if ( $nicename ){
                $name = $parent->slug;
        } else {
                $name = $parent->name;
        }

        if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
                $visited[] = $parent->parent;
                $chain .= keha_get_taxonomy_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
        }

        if ( $link ) {
                $chain .= '<a href="' . get_term_link( $parent->term_id, $taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
        }else {
                $chain .= $name.$separator;
        }
        return $chain;
}

//////////////////////////////////////////////////////////////
// META DATA
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$product_layout = array("short" => "Short", "long" => "Long");

//Product options
$config = array(
    'id' => 'product_options',
    'title' => 'Product Options',
    'prefix' => $prefix."product_",
    'postType' => array('product'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => true
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'feature_home',
  'label' => __('Feature on Homepage: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description',
  'label' => __('Description (Extra Field): ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'note',
  'label' => __('*Asterisk/Note: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'contents',
  'label' => __('Contents: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "size",
  'label' => __('Size: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "width_in",
  'label' => __('Width(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "width_cm",
  'label' => __('Width(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "height_in",
  'label' => __('Height(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "height_cm",
  'label' => __('Height(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "depth_in",
  'label' => __('Depth(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "depth_cm",
  'label' => __('Depth(cm): ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "diameter_in",
  'label' => __('Diameter(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "diameter_cm",
  'label' => __('Diameter(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "weight",
  'label' => __('Weight: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "rating",
  'label' => __('Rating(Wattage): ','poxy'),
  'default' => ''
));



$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "pole_length_in",
  'label' => __('Pole Length(in): ','poxy'),
  'default' => ''
));



$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "pole_length_cm",
  'label' => __('Pole Length(cm): ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "lights_mounts",
  'label' => __('Lights/Mounts: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "type",
  'label' => __('Type: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "fits",
  'label' => __('Fits: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "voltage",
  'label' => __('Voltage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "wattage",
  'label' => __('Wattage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "max_wattage",
  'label' => __('Max Wattage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "stand_adapters",
  'label' => __('Stand Adapter(s): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "micro_lightbanks",
  'label' => __('Micro Lightbanks: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "other_lights_for",
  'label' => __('Other Lights For: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "folds_to",
  'label' => __('Folds To: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "frame_size",
  'label' => __('Frame Size: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "window_size",
  'label' => __('Window Size: ','poxy'),
  'default' => ''
));
