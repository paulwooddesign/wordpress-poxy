<?php
//////////////////////////////////////////////////////////////
// CREATE Link POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_link_post_type' );

function poxy_create_link_post_type() {

  $labels = array(
    'name' => __( 'Link' ),
    'singular_name' => __( 'Link' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Link' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Link' ),
    'new_item' => __( 'New Link' ),
    'view' => __( 'View Link' ),
    'view_item' => __( 'View Link' ),
    'search_items' => __( 'Search Links' ),
    'not_found' => __( 'No Links found' ),
    'not_found_in_trash' => __( 'No Links found in Trash' ),
    'parent' => __( 'Parent Link' ),
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
    'supports' => array('title', 'editor', 'revisions')
  );

  register_post_type( 'link' , $args );
  flush_rewrite_rules( false );

}

//////////////////////////////////////////////////////////////
// REGISTER Link TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_link_taxonomies' );

function poxy_create_link_taxonomies() {

$labels = array(
      'name' => __( 'Link Category' ),
      'singular_name' => __( 'Link Category' ),
      'search_items' =>  __( 'Search Link Categories' ),
      'all_items' => __( 'All Link Categories' ),
      'parent_item' => __( 'Parent Link Category' ),
      'parent_item_colon' => __( 'Parent Link Category:' ),
      'edit_item' => __( 'Edit Link Category' ),
      'update_item' => __( 'Update Link Category' ),
      'add_new_item' => __( 'Add New Link Category' ),
      'new_item_name' => __( 'New Link Category' )
    );

    register_taxonomy('link_cat',array('link'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}



/////////////////////////////////////////////////////////////
// Options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$config = array(
    'id' => 'event_options',
    'title' => 'Event Options',
    'prefix' => $prefix."link_",
    'postType' => array('link'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => false
);

$slide_options_meta_box = new mrMetaBox($config);


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'description',
  'label' => __('Short Description: ','poxy')
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'url',
  'label' => __('Link URL: ','poxy')
));
