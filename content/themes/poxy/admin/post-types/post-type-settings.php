<?php
//////////////////////////////////////////////////////////////
// REGISTER Setting TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_setting_taxonomies' );

function poxy_create_setting_taxonomies() {

$labels = array(
      'name' => __( 'Setting Categories' ),
      'singular_name' => __( 'Setting Category' ),
      'search_items' =>  __( 'Search Setting Categories' ),
      'all_items' => __( 'All Setting Categories' ),
      'parent_item' => __( 'Parent Setting Category' ),
      'parent_item_colon' => __( 'Parent Setting Category:' ),
      'edit_item' => __( 'Edit Setting Category' ),
      'update_item' => __( 'Update Setting Category' ),
      'add_new_item' => __( 'Add New Setting Category' ),
      'new_item_name' => __( 'New Setting Category' )
    );

    register_taxonomy('setting_cat',array('setting'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}

//////////////////////////////////////////////////////////////
// CREATE Setting POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_setting_post_type' );

function poxy_create_setting_post_type() {

  $labels = array(
    'name' => __( 'Settings' ),
    'singular_name' => __( 'Setting' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Setting' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Setting' ),
    'new_item' => __( 'New Setting' ),
    'view' => __( 'View Setting' ),
    'view_item' => __( 'View Setting' ),
    'search_items' => __( 'Search Settings' ),
    'not_found' => __( 'No Settings found' ),
    'not_found_in_trash' => __( 'No Settings found in Trash' ),
    'parent' => __( 'Parent Setting' ),
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
    'supports' => array('title', 'editor', 'revisions')
  );

  register_post_type( 'setting' , $args );
  flush_rewrite_rules( false );

}
