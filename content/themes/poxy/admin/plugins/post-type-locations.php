<?php  
//////////////////////////////////////////////////////////////
// CREATE FAQ POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_location_post_type' );

function poxy_create_location_post_type() {

  // locations
  $labels = array(
    'name' => __( 'Locations' ),
    'singular_name' => __( 'Location' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Location' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Location' ),
    'new_item' => __( 'New Location' ),
    'view' => __( 'View Location' ),
    'view_item' => __( 'View Location' ),
    'search_items' => __( 'Search Locations' ),
    'not_found' => __( 'No Locations found' ),
    'not_found_in_trash' => __( 'No Locations found in Trash' ),
    'parent' => __( 'Parent Location' ),
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
    'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'revisions')
  );  
  
  register_post_type( 'location' , $args );
  flush_rewrite_rules( false );

}


function poxy_custom_location_flush_rules(){  
  //defines the post type so the rules can be flushed.
  poxy_create_location_post_type();
  //and flush the rules.
  flush_rewrite_rules();  
}
add_action('after_switch_theme', 'poxy_custom_location_flush_rules');


//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_location_taxonomies' );

function poxy_create_location_taxonomies() {

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

    register_taxonomy('location_cat',array('location'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}





/////////////////////////////////////////////////////////////
// location options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'location_options', 
    'title' => 'Options',
    'prefix' => $prefix."location_",
    'postType' => array('location'),
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
  'id' => 'address', 
  'label' => __('Address: ','poxy')
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
  'id' => 'phone', 
  'label' => __('Phone: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'fax', 
  'label' => __('Fax: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'location_image', 
  'label' => __('location Image: ','poxy'),
  'attachToPost' => false 
));




?>