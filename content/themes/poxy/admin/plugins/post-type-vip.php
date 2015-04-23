<?php  
//////////////////////////////////////////////////////////////
// CREATE staffs POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_vip_post_type' );

function poxy_create_vip_post_type() {

  $labels = array(
    'name' => __( 'VIP' ),
    'singular_name' => __( 'VIP' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New VIP Member' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit VIP Member' ),
    'new_item' => __( 'New VIP Member' ),
    'view' => __( 'View VIP Member' ),
    'view_item' => __( 'View VIP Member' ),
    'search_items' => __( 'Search VIP Members' ),
    'not_found' => __( 'No vip members found' ),
    'not_found_in_trash' => __( 'No vip members found in Trash' ),
    'parent' => __( 'Parent VIP Member' ),
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,    
    'rewrite' => true,
    'rewrite' => array('slug' => 'visonaries'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt')
  );  
  
  register_post_type( 'vip' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_vip_taxonomies' );

function poxy_create_vip_taxonomies() {

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

    register_taxonomy('vip_cat',array('vip'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}



/////////////////////////////////////////////////////////////
// Author options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";


function poxy_get_vip_array(){
// Pull all the pages into an array
  $options_pages = array();  
  $options_pages_obj = get_users('orderby=nicename');
  $options_pages[''] = 'Match User with VIP:';
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->ID] = $page->display_name;
  }
  return $options_pages;
}

$vip_array = poxy_get_vip_array();

//Member options
$config = array(
    'id' => 'author_options', 
    'title' => 'Author Options',
    'prefix' => $prefix."vip_",
    'postType' => array('vip'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$author_options_meta_box = new mrMetaBox($config);



$author_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "name", 
  'label' => __('VIP Name: ','poxy'),
  'default' => '', 
  'options' => $vip_array
));



$author_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'show_member', 
  'label' => __('Show VIP: ','poxy')
));

$author_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "sub_head", 
  'label' => __('Sub Head: ','poxy'),
  'default' => ''
));

$author_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description: ','poxy')
));


?>