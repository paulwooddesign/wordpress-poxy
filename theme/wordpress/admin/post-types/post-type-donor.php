<?php
//////////////////////////////////////////////////////////////
// CREATE staffs POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_donor_post_type' );

function poxy_create_donor_post_type() {

  $labels = array(
    'name' => __( 'Donors' ),
    'singular_name' => __( 'donor' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New donor Member' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit donor Member' ),
    'new_item' => __( 'New donor Member' ),
    'view' => __( 'View donor Member' ),
    'view_item' => __( 'View donor Member' ),
    'search_items' => __( 'Search donor Members' ),
    'not_found' => __( 'No donor members found' ),
    'not_found_in_trash' => __( 'No donor members found in Trash' ),
    'parent' => __( 'Parent donor Member' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    //'rewrite' => array('slug' => 'visonaries'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt')
  );

  register_post_type( 'donor' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_donor_taxonomies' );

function poxy_create_donor_taxonomies() {

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

    register_taxonomy('donor_cat',array('donor'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}
















/////////////////////////////////////////////////////////////
// Author options
/////////////////////////////////////////////////////////////
// $prefix = "_poxy_";
//
//
// function poxy_get_donor_array(){
// // Pull all the pages into an array
//   $options_pages = array();
//   $options_pages_obj = get_users('orderby=nicename');
//   $options_pages[''] = 'Match User with donor:';
//   foreach ($options_pages_obj as $page) {
//       $options_pages[$page->ID] = $page->display_name;
//   }
//   return $options_pages;
// }
//
// $donor_array = poxy_get_donor_array();
//
// //Member options
// $config = array(
//     'id' => 'author_options',
//     'title' => 'Author Options',
//     'prefix' => $prefix."donor_",
//     'postType' => array('donor'),
//     'context' => 'normal',
//     'priority' => 'high',
//     'usage' => 'theme',
//     'showInColumns' => true
// );
//
// $author_options_meta_box = new mrMetaBox($config);
//
//
//
// $author_options_meta_box->addField(array(
//   'type' => 'Select',
//   'id' => "name",
//   'label' => __('donor Name: ','poxy'),
//   'default' => '',
//   'options' => $donor_array
// ));
//
//
//
// $author_options_meta_box->addField(array(
//   'type' => 'Checkbox',
//   'id' => 'show_member',
//   'label' => __('Show donor: ','poxy')
// ));
//
// $author_options_meta_box->addField(array(
//   'type' => 'Text',
//   'id' => "sub_head",
//   'label' => __('Sub Head: ','poxy'),
//   'default' => ''
// ));
//
// $author_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'description',
//   'label' => __('Description: ','poxy')
// ));
