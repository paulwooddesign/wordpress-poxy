<?php  
//////////////////////////////////////////////////////////////
// CREATE FAQ POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_dealer_post_type' );

function poxy_create_dealer_post_type() {

  // dealers
  $labels = array(
    'name' => __( 'dealers' ),
    'singular_name' => __( 'dealer' ),
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
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'revisions')
  );  
  
  register_post_type( 'dealer' , $args );
  flush_rewrite_rules( false );

}


function poxy_custom_dealer_flush_rules(){  
  //defines the post type so the rules can be flushed.
  poxy_create_dealer_post_type();
  //and flush the rules.
  flush_rewrite_rules();  
}
add_action('after_switch_theme', 'poxy_custom_dealer_flush_rules');


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

    register_taxonomy('dealer_cat',array('dealer'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}





/////////////////////////////////////////////////////////////
// dealer options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'dealer_options', 
    'title' => 'Options',
    'prefix' => $prefix."dealer_",
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
  'id' => 'contact_name', 
  'label' => __('Contact Name: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'address', 
  'label' => __('Address: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'address2', 
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
  'id' => 'dealer_image', 
  'label' => __('dealer Image: ','poxy'),
  'attachToPost' => false 
));




?>