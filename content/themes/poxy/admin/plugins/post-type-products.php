<?php  
//////////////////////////////////////////////////////////////
// CREATE Products POST TYPE
/////////////////////////////////////////////////////////////
// add_action( 'init', 'poxy_create_products_post_type' );

// function poxy_create_products_post_type() {

//   $labels = array(
//     'name' => __( 'Products' ),
//     'singular_name' => __( 'Product' ),
//     'add_new' => __( 'Add New' ),
//     'add_new_item' => __( 'Add New Product' ),
//     'edit' => __( 'Edit' ),
//     'edit_item' => __( 'Edit Product' ),
//     'new_item' => __( 'New Product' ),
//     'view' => __( 'View Product' ),
//     'view_item' => __( 'View Product' ),
//     'search_items' => __( 'Search Products' ),
//     'not_found' => __( 'No Products found' ),
//     'not_found_in_trash' => __( 'No Products found in Trash' ),
//     'parent' => __( 'Parent Product' ),
//   );
  
//   $args = array(
//     'labels' => $labels,
//     'public' => true,
//     'publicly_queryable' => true,
//     'show_ui' => true,
//     'query_var' => true,    
//     'rewrite' => true,
//    // 'rewrite' => array('slug' => 'team'),
//     'capability_type' => 'post',
//     'hierarchical' => false,
//     'menu_position' => null,
//     'supports' => array('title', 'thumbnail', 'editor', 'comments', 'revisions', 'excerpt')
//   );  
  
//   register_post_type( 'product' , $args );
//   flush_rewrite_rules( false );

// }






//////////////////////////////////////////////////////////////
// REGISTER Products TAXONOMIES
/////////////////////////////////////////////////////////////

// add_action( 'init', 'poxy_create_product_taxonomies' );

// function poxy_create_product_taxonomies() {

// $labels = array(
//      'name' => __( 'Product Types' ),
//       'singular_name' => __( 'Product Type' ),
//       'search_items' =>  __( 'Search Award Types' ),
//       'all_items' => __( 'All Product Types' ),
//       'parent_item' => __( 'Parent Product Type' ),
//       'parent_item_colon' => __( 'Parent Product Type:' ),
//       'edit_item' => __( 'Edit Product Type' ),
//       'update_item' => __( 'Update Product Type' ),
//       'add_new_item' => __( 'Add New Product Type' ),
//       'new_item_name' => __( 'New Product Type' )
//     );  

//     register_taxonomy('p_type',array('products', 'product'),array(
//       'hierarchical' => true,
//       'rewrite' => array('slug' => 'products'),
//       'labels' => $labels
//     ));

//   flush_rewrite_rules( false );

// }




/////////////////////////////////////////////////////////////
// Vehicle Categorie options
/////////////////////////////////////////////////////////////
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'poxy_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Demo Meta Box',          // meta box title
    'pages' => array('product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
 

// textarea field
$my_meta->addTextarea($prefix.'product_cat_testimonial',array('name'=> __('Testimonial ','tax-meta')));

// text field
$my_meta->addText($prefix.'product_cat_testimonial_author',array('name'=> __('Tesimonial Author ','tax-meta')));


    //text field
  //$my_meta->addText($prefix.'text_field_id',array('name'=> __('Button Label ','tax-meta')));
  //select field
  $my_meta->addSelect($prefix.'product_cat_page_layout',
    array('default'=>'Default',
      'layout_1'=>'Layout 1', 
      'layout_2'=>'Layout 2', 
      'layout_3'=>'Layout 3', 
      'layout_4'=>'Layout 4', 
      'layout_5'=>'Layout 5 (Grid)', 
      'layout_6'=>'Layout 6', 
      'layout_kits_1'=>'Layout Kits 1',
      'layout_kits_2'=>'Layout Kits 2',
      'layout_kits_3'=>'Layout Kits 3'
      ),


    array('name'=> __('Page Layout ','tax-meta'), 'std'=> array('default')));
  //radio field
  //$my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> __('My Radio Filed','tax-meta'), 'std'=> array('radionkey2')));
  //date field
  //$my_meta->addDate($prefix.'date_field_id',array('name'=> __('My Date ','tax-meta')));
  //Time field
  ///$my_meta->addTime($prefix.'time_field_id',array('name'=> __('My Time ','tax-meta')));
  //Color field
  //$my_meta->addColor($prefix.'color_field_id',array('name'=> __('My Color ','tax-meta')));
  //Image field
  $my_meta->addImage($prefix.'cat_featured_image',array('name'=> __('Featured Image ','tax-meta')));
  $my_meta->addImage($prefix.'cat_banner_image',array('name'=> __('Banner Image ','tax-meta')));
  //file upload field
  //$my_meta->addFile($prefix.'file_field_id',array('name'=> __('My File ','tax-meta')));
  //wysiwyg field
  //$my_meta->addWysiwyg($prefix.'wysiwyg_field_id',array('name'=> __('My wysiwyg Editor ','tax-meta')));
  //taxonomy field
  //$my_meta->addTaxonomy($prefix.'taxonomy_field_id',array('taxonomy' => 'category'),array('name'=> __('My Taxonomy ','tax-meta')));
  //posts field
  //$my_meta->addPosts($prefix.'posts_field_id',array('args' => array('post_type' => 'page')),array('name'=> __('My Posts ','tax-meta')));
  
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  
  // $repeater_fields[] = $my_meta->addText($prefix.'re_text_field_id',array('name'=> __('My Text ','tax-meta')),true);
  // $repeater_fields[] = $my_meta->addTextarea($prefix.'re_textarea_field_id',array('name'=> __('My Textarea ','tax-meta')),true);
  // $repeater_fields[] = $my_meta->addCheckbox($prefix.'re_checkbox_field_id',array('name'=> __('My Checkbox ','tax-meta')),true);
  // $repeater_fields[] = $my_meta->addImage($prefix.'image_field_id',array('name'=> __('My Image ','tax-meta')),true);
  
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  //$my_meta->addRepeaterBlock($prefix.'re_',array('inline' => true, 'name' => __('This is a Repeater Block','tax-meta'),'fields' => $repeater_fields));
  /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}

























/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$product_layout = array("short" => "Short", "long" => "Long");

//Product options
$config = array(
    'id' => 'product_options', 
    'title' => 'Product Options',
    'prefix' => $prefix."product_",
    'postType' => array('product'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);
// $slide_options_meta_box = new mrMetaBox($config);

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'feature_home', 
//   'label' => __('Feature on Homepage: ','poxy')
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Text', 
//   'id' => "sub_head", 
//   'label' => __('Sub Heading: ','poxy'),
//   'default' => ''
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'image_2', 
//   'label' => __('Box Image: ','poxy'),
//   'attachToPost' => true 
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'nutrition_icons', 
//   'label' => __('Nutrition Icons (400x100): ','poxy'),
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

// //short, medium, long
// $slide_options_meta_box->addField(array(
//   'type' => 'Select', 
//   'id' => "layout", 
//   'label' => __('Product Layout: ','poxy'),
//   'default' => 'Short', 
//   'options' => $product_layout
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'description', 
//   'label' => __('Description (Extra Field): ','poxy')
// ));




$slide_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'feature_home', 
  'label' => __('Feature on Homepage: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description (Extra Field): ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'note', 
  'label' => __('*Asterisk/Note: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'contents', 
  'label' => __('Contents: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "size", 
  'label' => __('Size: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "width_in", 
  'label' => __('Width(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "width_cm", 
  'label' => __('Width(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "height_in", 
  'label' => __('Height(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "height_cm", 
  'label' => __('Height(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "depth_in", 
  'label' => __('Depth(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "depth_cm", 
  'label' => __('Depth(cm): ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "diameter_in", 
  'label' => __('Diameter(in): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "diameter_cm", 
  'label' => __('Diameter(cm): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "weight", 
  'label' => __('Weight: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "rating", 
  'label' => __('Rating(Wattage): ','poxy'),
  'default' => ''
));



$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "pole_length_in", 
  'label' => __('Pole Length(in): ','poxy'),
  'default' => ''
));



$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "pole_length_cm", 
  'label' => __('Pole Length(cm): ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "lights_mounts", 
  'label' => __('Lights/Mounts: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "type", 
  'label' => __('Type: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "fits", 
  'label' => __('Fits: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "voltage", 
  'label' => __('Voltage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "wattage", 
  'label' => __('Wattage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "max_wattage", 
  'label' => __('Max Wattage: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "stand_adapters", 
  'label' => __('Stand Adapter(s): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "micro_lightbanks", 
  'label' => __('Micro Lightbanks: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "other_lights_for", 
  'label' => __('Other Lights For: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "folds_to", 
  'label' => __('Folds To: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "frame_size", 
  'label' => __('Frame Size: ','poxy'),
  'default' => ''
));


$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "window_size", 
  'label' => __('Window Size: ','poxy'),
  'default' => ''
));



?>