<?php  
//////////////////////////////////////////////////////////////
// CREATE staffs POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_author_post_type' );

function poxy_create_author_post_type() {

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
    'rewrite' => array('slug' => 'vip'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt')
  );  
  
  register_post_type( 'author' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// REGISTER staffs TAXONOMIES
/////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////
// Author options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";


function poxy_get_author_array(){
// Pull all the pages into an array
  $options_pages = array();  
  $options_pages_obj = get_users('orderby=nicename');
  $options_pages[''] = 'Match User with Author:';
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->ID] = $page->display_name;
  }
  return $options_pages;
}

$author_array = poxy_get_author_array();

//Member options
$config = array(
    'id' => 'author_options', 
    'title' => 'Author Options',
    'prefix' => $prefix."author_",
    'postType' => array('author'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$author_options_meta_box = new mrMetaBox($config);



$author_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "name", 
  'label' => __('Author Name: ','poxy'),
  'default' => '', 
  'options' => $author_array
));



$author_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'show_member', 
  'label' => __('Show Author: ','poxy')
));





?>