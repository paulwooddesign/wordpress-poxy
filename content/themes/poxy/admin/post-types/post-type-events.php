<?php  
//////////////////////////////////////////////////////////////
// CREATE FAQ POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_event_post_type' );

function poxy_create_event_post_type() {

  // Events
  $labels = array(
    'name' => __( 'Events' ),
    'singular_name' => __( 'Event' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Event' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Event' ),
    'new_item' => __( 'New Event' ),
    'view' => __( 'View Event' ),
    'view_item' => __( 'View Event' ),
    'search_items' => __( 'Search Events' ),
    'not_found' => __( 'No events found' ),
    'not_found_in_trash' => __( 'No events found in Trash' ),
    'parent' => __( 'Parent Event' ),
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
    'supports' => array('title', 'excerpt', 'editor', 'revisions')
  );  
  
  register_post_type( 'event' , $args );
  flush_rewrite_rules( false );

}


function poxy_custom_event_flush_rules(){  
  //defines the post type so the rules can be flushed.
  poxy_create_event_post_type();
  //and flush the rules.
  flush_rewrite_rules();  
}
add_action('after_switch_theme', 'poxy_custom_event_flush_rules');





/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'event_options', 
    'title' => 'Event Options',
    'prefix' => $prefix."event_",
    'postType' => array('event'),
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
  'id' => 'city', 
  'label' => __('City: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Date',
  'id' => 'end_date', 
  'label' => __('End Date: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'link', 
  'label' => __('Event URL: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'event_image', 
  'label' => __('Event Image: ','poxy'),
  'attachToPost' => false 
));




?>