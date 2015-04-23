<?php  
//////////////////////////////////////////////////////////////
// CREATE FAQ POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_grain_post_type' );

function poxy_create_grain_post_type() {

  // Grains
  $labels = array(
    'name' => __( 'Grains' ),
    'singular_name' => __( 'Grain' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Grain' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Grain' ),
    'new_item' => __( 'New Grain' ),
    'view' => __( 'View Grain' ),
    'view_item' => __( 'View Grain' ),
    'search_items' => __( 'Search Grains' ),
    'not_found' => __( 'No Grains found' ),
    'not_found_in_trash' => __( 'No Grains found in Trash' ),
    'parent' => __( 'Parent Grain' ),
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,    
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'thumbnail', 'editor', 'comments', 'revisions', 'excerpt')
  );  
  
  register_post_type( 'grain' , $args );
  flush_rewrite_rules( false );

}


function poxy_custom_grain_flush_rules(){  
  //defines the post type so the rules can be flushed.
  poxy_create_grain_post_type();
  //and flush the rules.
  flush_rewrite_rules();  
}
add_action('after_switch_theme', 'poxy_custom_grain_flush_rules');





/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'grain_options', 
    'title' => 'Grain Options',
    'prefix' => $prefix."grain_",
    'postType' => array('grain'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'grain_image', 
//   'label' => __('Grain Image: ','poxy'),
//   'attachToPost' => false 
// ));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Short Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'background_image', 
  'label' => __('Nutrition Facts: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'mobile_image', 
  'label' => __('Vertical Nutrition Facts: ','poxy'),
  'attachToPost' => false 
));

// $slide_options_meta_box->addField(array(
//   'type' => 'Text',
//   'id' => 'url', 
//   'label' => __('Event URL: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Text',
//   'id' => 'location', 
//   'label' => __('Event Location: ','poxy')
// ));






?>