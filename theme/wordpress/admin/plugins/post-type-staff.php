<?php  
//////////////////////////////////////////////////////////////
// CREATE staffs POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_staff_post_type' );

function poxy_create_staff_post_type() {

  $labels = array(
    'name' => __( 'Staff' ),
    'singular_name' => __( 'Staff' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Staff' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Staff' ),
    'new_item' => __( 'New Staff' ),
    'view' => __( 'View Staff' ),
    'view_item' => __( 'View Staff' ),
    'search_items' => __( 'Search Staff' ),
    'not_found' => __( 'No Staff found' ),
    'not_found_in_trash' => __( 'No Staff found in Trash' ),
    'parent' => __( 'Parent Staff' ),
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
    'supports' => array('title', 'thumbnail', 'editor', 'comments', 'revisions', 'excerpt')
  );  
  
  register_post_type( 'staff' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// REGISTER staffs TAXONOMIES
/////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
//staff options
$config = array(
    'id' => 'staff_options', 
    'title' => 'staff Options',
    'prefix' => $prefix."staff_",
    'postType' => array('staff'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);







// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'home_image', 
//   'label' => __('Featured Home Image (350x350px): ','poxy'),
//   'attachToPost' => false 
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'featured_text', 
//   'label' => __('Featured Home Text: ','poxy')
// ));
// // $slide_options_meta_box->addField(array(
// //   'type' => 'Text', 
// //   'id' => "text_color", 
// //   'label' => __('Text Color (Hex): ','poxy'),
// //   'default' => ''
// // ));

// // $slide_options_meta_box->addField(array(
// //   'type' => 'Select', 
// //   'id' => "text_alignment", 
// //   'label' => __('Text Alignment: ','poxy'),
// //   'default' => '', 
// //   'options' => $text_alignment
// // ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'background_image', 
//   'label' => __('Nutrition Facts: ','poxy'),
//   'attachToPost' => false 
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'mobile_image', 
//   'label' => __('Vertical Nutrition Facts: ','poxy'),
//   'attachToPost' => false 
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'ingredients', 
//   'label' => __('Ingredients: ','poxy')
// ));



// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'usda_organic', 
//   'label' => __('USDA Organic: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'gluten_free', 
//   'label' => __('Certified Gluten-Free: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'star_kosher', 
//   'label' => __('Star Kosher: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'scroll_kosher', 
//   'label' => __('Scroll Kosher: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'non_gmo', 
//   'label' => __('Non GMO: ','poxy')
// ));


// $slide_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'description', 
//   'label' => __('Description (Extra Field): ','poxy')
// ));


?>