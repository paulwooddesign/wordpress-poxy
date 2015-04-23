<?php
//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_dealer_taxonomies' );

function poxy_create_dealer_taxonomies() {

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

    register_taxonomy('dealer_cat', array('dealer'), array(
      'labels' => $labels,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'dealers', 'hierarchical' => true, 'with_front' => false)
    ));

  flush_rewrite_rules( false );


}


//////////////////////////////////////////////////////////////
// CREATE Dealers POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_dealers_post_type' );

function poxy_create_dealers_post_type() {

  $labels = array(
    'name' => __( 'Dealers' ),
    'singular_name' => __( 'Dealer' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Dealer' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Dealer' ),
    'new_item' => __( 'New Dealer' ),
    'view' => __( 'View Dealer' ),
    'view_item' => __( 'View Dealer' ),
    'search_items' => __( 'Search Dealers' ),
    'not_found' => __( 'No Dealers found' ),
    'not_found_in_trash' => __( 'No Dealers found in Trash' ),
    'parent' => __( 'Parent Dealer' ),
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

  register_post_type( 'dealer' , $args );
  flush_rewrite_rules( false );

}



//////////////////////////////////////////////////////////////
// PERMALINKS
/////////////////////////////////////////////////////////////
function dealers_add_rewrite_rules() {
  // add_rewrite_rule( '^dealers/(.+?)/(.+?)/(.+?)/(.+?)$', 'index.php?product_cat=$matches[1]&product_cat=$matches[2]&product_cat=$matches[3]&product=$matches[4]', 'top' );
  add_rewrite_rule( '^dealers/(.+?)/(.+?)/(.+?)$', 'index.php?dealer_cat=$matches[1]&dealer_cat=$matches[2]&dealer_cat=$matches[3]', 'top' );
  // add_rewrite_rule( '^dealers/(.+?)/(.+?)/(.+?)$', 'index.php?product_cat=$matches[1]&product_cat=$matches[2]&product=$matches[3]', 'top' );
  // add_rewrite_rule( '^dealers/(.+?)/(.+?)/$', 'index.php?product=$matches[2]', 'top' );
  // add_rewrite_rule( '^dealers/(.+?)/(.+?)/(.+?)$', 'index.php?product=$matches[3]', 'top' );
  add_rewrite_rule( '^dealers/(.+?)/(.+?)/?$', 'index.php?dealer_cat=$matches[2]', 'top' );
  add_rewrite_rule( '^dealers/(.+?)$', 'index.php?dealer_cat=$matches[1]', 'top' );
}
add_action('init', 'dealers_add_rewrite_rules');



function dealers_post_type_link( $post_link, $post, $leavename ) {
  global $wp_rewrite;
  $draft_or_pending = isset( $post->post_status ) && in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft' ) );

  if ( $draft_or_pending and !$leavename ) {
    return $post_link;
  }

  if ( $post->post_type == 'dealer' ) {

    $post_type_object = get_post_type_object( $post->post_type );
    $post_link = home_url() . '/' . $post_type_object->rewrite['slug'] . '/';
    $parent_dirs = '';

    if ( $terms = get_the_terms( $post->ID, 'dealer_cat' ) ) {
      foreach ( $terms as $term ) {
        if ( $term->parent != 0 ) {
          $dirs = dealers_get_taxonomy_parents( $term->term_id, 'dealer_cat', false, '/', true );
        } else {
          $dirs = $term->slug.'/';
        }
      }
    }
    $post_link = $post_link . $dirs . $post->post_name;
  }

  return $post_link;
}
add_filter( 'post_type_link', 'dealers_post_type_link', 10, 3 );



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

function dealers_get_taxonomy_parents( $id, $taxonomy = 'dealer_cat', $link = false, $separator = '/', $nicename = false, $visited = array() ) {
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
    $chain .= dealers_get_taxonomy_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
  }

  if ( $link ) {
    $chain .= '<a href="' . get_term_link( $parent->term_id, $taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
  } else {
    $chain .= $name.$separator;
  }
  return $chain;
}






/////////////////////////////////////////////////////////////
// Dealer Meta
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'dealer_options',
    'title' => 'Options',
    // 'prefix' => $prefix."dealer_",
    'prefix' => "dealer_",
    'postType' => array('dealer'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => true
);

$slide_options_meta_box = new mrMetaBox($config);


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'description',
  'label' => __('Short Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'contact_name',
  'label' => __('Contact Name: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'contact_title',
  'label' => __('Contact Title: ','poxy')
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'street1',
  'label' => __('Address: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'street2',
  'label' => __('Address 2: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'city',
  'label' => __('City: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'state',
  'label' => __('State: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'zip',
  'label' => __('Zip: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'country',
  'label' => __('Country: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'website',
  'label' => __('Website: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'email',
  'label' => __('Email: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'phone',
  'label' => __('Phone: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'fax',
  'label' => __('Fax: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'rental',
  'label' => __('Rental: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'latitude',
  'label' => __('Latitude: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'longitude',
  'label' => __('Longitude: ','poxy')
));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image',
//   'id' => 'dealer_image',
//   'label' => __('dealer Image: ','poxy'),
//   'attachToPost' => false
// ));




?>
