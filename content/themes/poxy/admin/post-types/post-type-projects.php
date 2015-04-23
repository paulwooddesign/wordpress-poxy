<?php
//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_project_taxonomies' );

function poxy_create_project_taxonomies() {

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

  register_taxonomy('project_cat', array('project'), array(
    'labels' => $labels,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'projects', 'hierarchical' => true, 'with_front' => false)
  ));

  $labels = array(
    'name' => __( 'Clients' ),
    'singular_name' => __( 'Client' ),
    'search_items' =>  __( 'Search Clients' ),
    'all_items' => __( 'All Clients' ),
    'parent_item' => __( 'Parent Client' ),
    'parent_item_colon' => __( 'Parent Client:' ),
    'edit_item' => __( 'Edit Client' ),
    'update_item' => __( 'Update Client' ),
    'add_new_item' => __( 'Add New Client' ),
    'new_item_name' => __( 'New Client' )
  );

  register_taxonomy('project_client', array('project'), array(
    'labels' => $labels,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'project_client', 'hierarchical' => true, 'with_front' => false)
  ));

  flush_rewrite_rules( false );

  $labels = array(
    'name' => __( 'Technologies' ),
    'singular_name' => __( 'Technology' ),
    'search_items' =>  __( 'Search Technologies' ),
    'all_items' => __( 'All Technologies' ),
    'parent_item' => __( 'Parent Technology' ),
    'parent_item_colon' => __( 'Parent Technology:' ),
    'edit_item' => __( 'Edit Technology' ),
    'update_item' => __( 'Update Technology' ),
    'add_new_item' => __( 'Add New Technology' ),
    'new_item_name' => __( 'New Technology' )
  );

  register_taxonomy('project_tech', array('project'), array(
    'labels' => $labels,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'technologies', 'hierarchical' => true, 'with_front' => false)
  ));

  $labels = array(
    'name' => __( 'Code' ),
    'singular_name' => __( 'Code' ),
    'search_items' =>  __( 'Search Code' ),
    'all_items' => __( 'All Code' ),
    'parent_item' => __( 'Parent Code' ),
    'parent_item_colon' => __( 'Parent Code:' ),
    'edit_item' => __( 'Edit Code' ),
    'update_item' => __( 'Update Code' ),
    'add_new_item' => __( 'Add New Code' ),
    'new_item_name' => __( 'New Code' )
  );

  register_taxonomy('project_code', array('project'), array(
    'labels' => $labels,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'code', 'hierarchical' => true, 'with_front' => false)
  ));

  $labels = array(
    'name' => __( 'Studios' ),
    'singular_name' => __( 'Studio' ),
    'search_items' =>  __( 'Search Studios' ),
    'all_items' => __( 'All Studios' ),
    'parent_item' => __( 'Parent Studio' ),
    'parent_item_colon' => __( 'Parent Studio:' ),
    'edit_item' => __( 'Edit Studio' ),
    'update_item' => __( 'Update Studio' ),
    'add_new_item' => __( 'Add New Studio' ),
    'new_item_name' => __( 'New Studio' )
  );

  register_taxonomy('project_studio', array('project'), array(
    'labels' => $labels,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'studios', 'hierarchical' => true, 'with_front' => false)
  ));

  flush_rewrite_rules( false );


}


//////////////////////////////////////////////////////////////
// CREATE Projects POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_projects_post_type' );

function poxy_create_projects_post_type() {

  $labels = array(
    'name' => __( 'Projects' ),
    'singular_name' => __( 'Project' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Project' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Project' ),
    'new_item' => __( 'New Project' ),
    'view' => __( 'View Project' ),
    'view_item' => __( 'View Project' ),
    'search_items' => __( 'Search Projects' ),
    'not_found' => __( 'No Projects found' ),
    'not_found_in_trash' => __( 'No Projects found in Trash' ),
    'parent' => __( 'Parent Project' ),
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
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array('title', 'thumbnail', 'editor', 'page-attributes', 'revisions', 'author', 'excerpt')
  );

  register_post_type( 'project' , $args );
  flush_rewrite_rules( false );

}



//////////////////////////////////////////////////////////////
// PERMALINKS
/////////////////////////////////////////////////////////////
function keha_add_rewrite_rules() {
  // add_rewrite_rule( '^projects/(.+?)/(.+?)/(.+?)/(.+?)$', 'index.php?project_cat=$matches[1]&project_cat=$matches[2]&project_cat=$matches[3]&project=$matches[4]', 'top' );
  add_rewrite_rule( '^projects/(.+?)/(.+?)/(.+?)$', 'index.php?project_cat=$matches[1]&project_cat=$matches[2]&project_cat=$matches[3]', 'top' );
  // add_rewrite_rule( '^projects/(.+?)/(.+?)/(.+?)$', 'index.php?project_cat=$matches[1]&project_cat=$matches[2]&project=$matches[3]', 'top' );
  // add_rewrite_rule( '^projects/(.+?)/(.+?)/$', 'index.php?project=$matches[2]', 'top' );
  // add_rewrite_rule( '^projects/(.+?)/(.+?)/(.+?)$', 'index.php?project=$matches[3]', 'top' );
  add_rewrite_rule( '^projects/(.+?)/(.+?)/?$', 'index.php?project_cat=$matches[2]', 'top' );
  add_rewrite_rule( '^projects/(.+?)$', 'index.php?project_cat=$matches[1]', 'top' );
}
add_action('init', 'keha_add_rewrite_rules');

function keha_post_type_link( $post_link, $post, $leavename ) {

        global $wp_rewrite;

        $draft_or_pending = isset( $post->post_status ) && in_array( $post->post_status, array( 'draft', 'pending', 'auto-draft' ) );
        if ( $draft_or_pending and !$leavename ) {
                return $post_link;
        }

        if ( $post->post_type == 'project' ) {

          $post_type_object = get_post_type_object( $post->post_type );
          $post_link = home_url() . '/' . $post_type_object->rewrite['slug'] . '/';
          $parent_dirs = '';
          if ( $terms = get_the_terms( $post->ID, 'project_cat' ) ) {
            foreach ( $terms as $term ) {
                if ( $term->parent != 0 ) {
                  $dirs = keha_get_taxonomy_parents( $term->term_id, 'project_cat', false, '/', true );
                } else {
                  $dirs = $term->slug.'/';
                }
            }
          }
          $post_link = $post_link . $dirs . $post->post_name;
        }

        return $post_link;
}
//add_filter( 'post_type_link', 'keha_post_type_link', 10, 3 );

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

$project_layout = array("short" => "Short", "long" => "Long");

$section_layout = array(
  "1" => "None",
  "responsive" => "responsive",
  "grid-12x35" => "Grid - 12x35",
  "section-auto-height" => "Section Auto Height",
  "section-1-1" => "1 Images - 1",
  "section-1-2" => "1 Images - 2",
  "section-1-3" => "1 Images - 3",
  "section-1-4" => "1 Images - 4",
  "section-2-1" => "2 Images - 1",
  "section-2-2" => "2 Images - 2",
  "section-2-3" => "2 Images - 3",
  "section-2-4" => "2 Images - 4",
  "section-3-1" => "3 Images - 1",
  "section-3-2" => "3 Images - 2",
  "section-3-3" => "3 Images - 3",
  "section-3-4" => "3 Images - 4",
  "section-4-1" => "4 Images - 1",
  "section-4-2" => "4 Images - 2",
  "section-4-3" => "4 Images - 3",
  "section-4-4" => "4 Images - 4"
  );

$bgp_array = array(
  "cc" => "Center",
  "rc" => "Right",
  "lc" => "Left",
  "ct" => "Top",
  "cb" => "Bottm",
  "rt" => "Top Right",
  "lt" => "Top Left",
  "rb" => "Bottom Right",
  "lb" => "Bottom Left"
  );

$bgs_array = array(
  "cover" => "Cover",
  "contain" => "Contain",
  "100" => "100%",
  "50" => "50%"
  );


// //Project options
// $config = array(
//     'id' => 'project_options',
//     'title' => 'Project Options',
//     'prefix' => $prefix."project_",
//     // 'prefix' => "project_",
//     'postType' => array('project'),
//     'context' => 'normal',
//     'priority' => 'high',
//     'usage' => 'theme',
//     'showInColumns' => false
// );
//
// $project_options_meta_box = new mrMetaBox($config);
//
// $project_options_meta_box->addField(array(
//   'type' => 'Checkbox',
//   'id' => 'feature',
//   'label' => __('Feature: ','poxy')
// ));
//
// $project_options_meta_box->addField(array(
//   'type' => 'Checkbox',
//   'id' => 'feature_home',
//   'label' => __('Feature on Homepage: ','poxy')
// ));




//////////////////////////
// Section 1
//////////////////////////
$section_number = "1";
$config = array(
    'id' => 'project_fig_'.$section_number.'_options',
    'title' => 'Section '.$section_number.' Options',
    'prefix' => $prefix."project_",
    // 'prefix' => "project_",
    'postType' => array('project'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);

$project_fig_1_options_meta_box = new mrMetaBox($config);

//Section 1 options
$project_fig_1_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => 'section_'.$section_number.'_layout',
  'label' => __('Section('.$section_number.') Layout: ','poxy'),
  'default' => '',
  'options' => $section_layout
));

$project_fig_1_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'section_'.$section_number.'_title',
  'label' => __('Fig('.$section_number.') Title: ','poxy')
));

$project_fig_1_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'section_'.$section_number.'_description',
  'label' => __('Fig('.$section_number.') Description: ','poxy')
));


$project_fig_1_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_1_image',
  'label' => __('(Fig('.$section_number.') Image 1: ','poxy'),
  'attachToPost' => false
));
$project_fig_1_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_2_image',
  'label' => __('(Fig('.$section_number.') Image 2: ','poxy'),
  'attachToPost' => false
));
$project_fig_1_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_3_image',
  'label' => __('(Fig('.$section_number.') Image 3: ','poxy'),
  'attachToPost' => false
));
$project_fig_1_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_4_image',
  'label' => __('(Fig('.$section_number.') Image 4: ','poxy'),
  'attachToPost' => false
));

//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_fig_1_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));




//////////////////////////
// Section 2
//////////////////////////
$section_number = "2";
$config = array(
    'id' => 'project_fig_'.$section_number.'_options',
    'title' => 'Section '.$section_number.' Options',
    'prefix' => $prefix."project_",
    // 'prefix' => "project_",
    'postType' => array('project'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);

$project_section_2_options_meta_box = new mrMetaBox($config);

//Section 1 options
$project_section_2_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => 'section_'.$section_number.'_layout',
  'label' => __('Section('.$section_number.') Layout: ','poxy'),
  'default' => '',
  'options' => $section_layout
));

$project_section_2_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'section_'.$section_number.'_title',
  'label' => __('Fig('.$section_number.') Title: ','poxy')
));

$project_section_2_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'section_'.$section_number.'_description',
  'label' => __('Fig('.$section_number.') Description: ','poxy')
));


$project_section_2_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_1_image',
  'label' => __('(Fig('.$section_number.') Image 1: ','poxy'),
  'attachToPost' => false
));
$project_section_2_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_2_image',
  'label' => __('(Fig('.$section_number.') Image 2: ','poxy'),
  'attachToPost' => false
));
$project_section_2_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_3_image',
  'label' => __('(Fig('.$section_number.') Image 3: ','poxy'),
  'attachToPost' => false
));
$project_section_2_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_4_image',
  'label' => __('(Fig('.$section_number.') Image 4: ','poxy'),
  'attachToPost' => false
));

//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_2_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));




//////////////////////////
// Section 3
//////////////////////////
$section_number = "3";
$config = array(
    'id' => 'project_fig_'.$section_number.'_options',
    'title' => 'Section '.$section_number.' Options',
    'prefix' => $prefix."project_",
    // 'prefix' => "project_",
    'postType' => array('project'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);

$project_section_3_options_meta_box = new mrMetaBox($config);

//Section 1 options
$project_section_3_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => 'section_'.$section_number.'_layout',
  'label' => __('Section('.$section_number.') Layout: ','poxy'),
  'default' => '',
  'options' => $section_layout
));

$project_section_3_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'section_'.$section_number.'_title',
  'label' => __('Fig('.$section_number.') Title: ','poxy')
));

$project_section_3_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'section_'.$section_number.'_description',
  'label' => __('Fig('.$section_number.') Description: ','poxy')
));


$project_section_3_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_1_image',
  'label' => __('(Fig('.$section_number.') Image 1: ','poxy'),
  'attachToPost' => false
));
$project_section_3_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_2_image',
  'label' => __('(Fig('.$section_number.') Image 2: ','poxy'),
  'attachToPost' => false
));
$project_section_3_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_3_image',
  'label' => __('(Fig('.$section_number.') Image 3: ','poxy'),
  'attachToPost' => false
));
$project_section_3_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_4_image',
  'label' => __('(Fig('.$section_number.') Image 4: ','poxy'),
  'attachToPost' => false
));

//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_1_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_2_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_3_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));
//
//
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgp',
//   'label' => __('Fig('.$section_number.') BG Position: ','poxy'),
//   'default' => 'cc',
//   'options' => $bgp_array
// ));
//
// $project_section_3_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => 'fig_'.$section_number.'_4_bgs',
//   'label' => __('Fig('.$section_number.') BG Size: ','poxy'),
//   'default' => 'cover',
//   'options' => $bgs_array
// ));




//////////////////////////
// Section 4
//////////////////////////
$section_number = "4";
$config = array(
    'id' => 'project_fig_'.$section_number.'_options',
    'title' => 'Section '.$section_number.' Options',
    'prefix' => $prefix."project_",
    // 'prefix' => "project_",
    'postType' => array('project'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);
$project_section_4_options_meta_box = new mrMetaBox($config);

$project_section_4_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => 'section_'.$section_number.'_layout',
  'label' => __('Section('.$section_number.') Layout: ','poxy'),
  'default' => '',
  'options' => $section_layout
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'section_'.$section_number.'_title',
  'label' => __('Fig('.$section_number.') Title: ','poxy')
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'section_'.$section_number.'_description',
  'label' => __('Fig('.$section_number.') Description: ','poxy')
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_1_image',
  'label' => __('(Fig('.$section_number.') Image 1: ','poxy'),
  'attachToPost' => false
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_2_image',
  'label' => __('(Fig('.$section_number.') Image 2: ','poxy'),
  'attachToPost' => false
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_3_image',
  'label' => __('(Fig('.$section_number.') Image 3: ','poxy'),
  'attachToPost' => false
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_4_image',
  'label' => __('(Fig('.$section_number.') Image 4: ','poxy'),
  'attachToPost' => false
));


//////////////////////////
// Section 5
//////////////////////////
$section_number = "4";
$config = array(
    'id' => 'project_fig_'.$section_number.'_options',
    'title' => 'Section '.$section_number.' Options',
    'prefix' => $prefix."project_",
    // 'prefix' => "project_",
    'postType' => array('project'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);
$project_section_5_options_meta_box = new mrMetaBox($config);

$project_section_5_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => 'section_'.$section_number.'_layout',
  'label' => __('Section('.$section_number.') Layout: ','poxy'),
  'default' => '',
  'options' => $section_layout
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'section_'.$section_number.'_title',
  'label' => __('Fig('.$section_number.') Title: ','poxy')
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'section_'.$section_number.'_description',
  'label' => __('Fig('.$section_number.') Description: ','poxy')
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_1_image',
  'label' => __('(Fig('.$section_number.') Image 1: ','poxy'),
  'attachToPost' => false
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_2_image',
  'label' => __('(Fig('.$section_number.') Image 2: ','poxy'),
  'attachToPost' => false
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_3_image',
  'label' => __('(Fig('.$section_number.') Image 3: ','poxy'),
  'attachToPost' => false
));
$project_section_5_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'fig_'.$section_number.'_4_image',
  'label' => __('(Fig('.$section_number.') Image 4: ','poxy'),
  'attachToPost' => false
));
