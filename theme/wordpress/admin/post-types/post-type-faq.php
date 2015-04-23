<?php  
//////////////////////////////////////////////////////////////
// CREATE FAQ POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_faq_post_type' );

function poxy_create_faq_post_type() {

  $labels = array(
    'name' => __( 'FAQ' ),
    'singular_name' => __( 'FAQ' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New FAQ' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit FAQ' ),
    'new_item' => __( 'New FAQ' ),
    'view' => __( 'View FAQ' ),
    'view_item' => __( 'View FAQ' ),
    'search_items' => __( 'Search FAQs' ),
    'not_found' => __( 'No FAQs found' ),
    'not_found_in_trash' => __( 'No FAQs found in Trash' ),
    'parent' => __( 'Parent FAQ' ),
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
  
  register_post_type( 'faq' , $args );
  flush_rewrite_rules( false );

}

//////////////////////////////////////////////////////////////
// REGISTER FAQ TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_faq_taxonomies' );

function poxy_create_faq_taxonomies() {

$labels = array(
      'name' => __( 'FAQ Section' ),
      'singular_name' => __( 'FAQ Section' ),
      'search_items' =>  __( 'Search FAQ Sections' ),
      'all_items' => __( 'All FAQ Sections' ),
      'parent_item' => __( 'Parent FAQ Section' ),
      'parent_item_colon' => __( 'Parent FAQ Section:' ),
      'edit_item' => __( 'Edit FAQ Section' ),
      'update_item' => __( 'Update FAQ Section' ),
      'add_new_item' => __( 'Add New FAQ Section' ),
      'new_item_name' => __( 'New FAQ Section' )
    );  

    register_taxonomy('faq_section',array('faq'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

  flush_rewrite_rules( false );


}











?>