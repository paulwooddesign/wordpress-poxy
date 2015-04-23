<?php  
//////////////////////////////////////////////////////////////
// CREATE packages POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_package_post_type' );

function poxy_create_package_post_type() {

  $labels = array(
    'name' => __( 'package' ),
    'singular_name' => __( 'package' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New package' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit package' ),
    'new_item' => __( 'New package' ),
    'view' => __( 'View package' ),
    'view_item' => __( 'View package' ),
    'search_items' => __( 'Search package' ),
    'not_found' => __( 'No package found' ),
    'not_found_in_trash' => __( 'No package found in Trash' ),
    'parent' => __( 'Parent package' ),
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
  
  register_post_type( 'package' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// REGISTER packages TAXONOMIES
/////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
//package options
$config = array(
    'id' => 'package_options', 
    'title' => 'package Options',
    'prefix' => $prefix."package_",
    'postType' => array('package'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

// $slide_options_meta_box = new mrMetaBox($config);







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