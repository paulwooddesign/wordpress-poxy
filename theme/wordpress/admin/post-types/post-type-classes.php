<?php
//////////////////////////////////////////////////////////////
// REGISTER Class TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_class_taxonomies' );

function poxy_create_class_taxonomies() {

$labels = array(
      'name' => __( 'Class Categories' ),
      'singular_name' => __( 'Class Category' ),
      'search_items' =>  __( 'Search Class Categories' ),
      'all_items' => __( 'All Class Categories' ),
      'parent_item' => __( 'Parent Class Category' ),
      'parent_item_colon' => __( 'Parent Class Category:' ),
      'edit_item' => __( 'Edit Class Category' ),
      'update_item' => __( 'Update Class Category' ),
      'add_new_item' => __( 'Add New Class Category' ),
      'new_item_name' => __( 'New Class Category' )
    );

    register_taxonomy('class_cat',array('class'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}

//////////////////////////////////////////////////////////////
// CREATE Class POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_class_post_type' );

function poxy_create_class_post_type() {

  $labels = array(
    'name' => __( 'Classes' ),
    'singular_name' => __( 'Class' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Class' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Class' ),
    'new_item' => __( 'New Class' ),
    'view' => __( 'View Class' ),
    'view_item' => __( 'View Class' ),
    'search_items' => __( 'Search Classes' ),
    'not_found' => __( 'No Classes found' ),
    'not_found_in_trash' => __( 'No Classes found in Trash' ),
    'parent' => __( 'Parent Class' ),
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

  register_post_type( 'class' , $args );
  flush_rewrite_rules( false );

}
