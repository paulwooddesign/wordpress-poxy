<?php
//////////////////////////////////////////////////////////////
// CREATE staffs POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_client_post_type' );

function poxy_create_client_post_type() {

  $labels = array(
    'name' => __( 'Clients' ),
    'singular_name' => __( 'Clients' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Client' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Client' ),
    'new_item' => __( 'New Client' ),
    'view' => __( 'View Client' ),
    'view_item' => __( 'View Client' ),
    'search_items' => __( 'Search Clients' ),
    'not_found' => __( 'No Clients found' ),
    'not_found_in_trash' => __( 'No Clients found in Trash' ),
    'parent' => __( 'Parent Client' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'rewrite' => array('slug' => 'client'),
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt')
  );

  register_post_type( 'client' , $args );
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
  $options_pages[''] = 'Match Client with Author:';
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->ID] = $page->display_name;
  }
  return $options_pages;
}

$author_array = poxy_get_author_array();

//Member options
$config = array(
    'id' => 'client_options',
    'title' => 'Client Options',
    'prefix' => $prefix."client_",
    'postType' => array('client'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);

$author_options_meta_box = new mrMetaBox($config);



$author_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "name",
  'label' => __('Client Name: ','poxy'),
  'default' => '',
  'options' => $author_array
));

$author_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'featured',
  'label' => __('Featured: ','poxy')
));

$author_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'show',
  'label' => __('Show Author: ','poxy')
));

$author_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'color_red',
  'label' => __('Color RED: ','poxy')
));

$author_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'color_green',
  'label' => __('Color GREEN: ','poxy')
));

$author_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'color_blue',
  'label' => __('Color BLUE: ','poxy')
));
