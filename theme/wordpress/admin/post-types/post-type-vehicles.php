<?php  
//////////////////////////////////////////////////////////////
// CREATE vehicles POST TYPE
/////////////////////////////////////////////////////////////
add_action( 'init', 'poxy_create_vehicle_post_type' );

function poxy_create_vehicle_post_type() {

  $labels = array(
    'name' => __( 'Vehicles' ),
    'singular_name' => __( 'vehicle' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New vehicle' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit vehicle' ),
    'new_item' => __( 'New vehicle' ),
    'view' => __( 'View vehicle' ),
    'view_item' => __( 'View vehicle' ),
    'search_items' => __( 'Search vehicle' ),
    'not_found' => __( 'No vehicle found' ),
    'not_found_in_trash' => __( 'No vehicle found in Trash' ),
    'parent' => __( 'Parent vehicle' ),
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
  
  register_post_type( 'vehicle' , $args );
  flush_rewrite_rules( false );

}






//////////////////////////////////////////////////////////////
// REGISTER FAQ TAXONOMIES
/////////////////////////////////////////////////////////////

add_action( 'init', 'poxy_create_vehicle_taxonomies' );

function poxy_create_vehicle_taxonomies() {

$labels = array(
      'name' => __( 'Vehicle Type' ),
      'singular_name' => __( 'Vehicle Type' ),
      'search_items' =>  __( 'Search FAQ Type' ),
      'all_items' => __( 'All Vehicle Types' ),
      'parent_item' => __( 'Parent Vehicle Type' ),
      'parent_item_colon' => __( 'Parent Vehicle Type:' ),
      'edit_item' => __( 'Edit Vehicle Type' ),
      'update_item' => __( 'Update Vehicle Type' ),
      'add_new_item' => __( 'Add New Vehicle Type' ),
      'new_item_name' => __( 'New Vehicle Type' )
    );  

    $rewrite = array(
      'slug'                       => '',
      'with_front'                 => false,
      'hierarchical'               => true,
    );

     $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => $rewrite,
    );

    register_taxonomy('vehicle_cat', array('vehicle'), $args );

   

  flush_rewrite_rules( false );


}


// function filter_post_type_link($link, $post)
// {
//     if ($post->post_type != 'vehicle')
//         return $link;

//     if ($cats = get_the_terms($post->ID, 'vehicle_cat'))
//         $link = str_replace('vehicle', array_pop($cats)->slug, $link);
//     return $link;
// }
// add_filter('post_type_link', 'filter_post_type_link', 10, 2);


/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";
$text_alignment = array("left" => "Left", "right" => "Right");

//Slide options

$config = array(
    'id' => 'slide_options', 
    'title' => 'Vehicle Options',
    'prefix' => $prefix."vehicle_",
    'postType' => array('vehicle'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "text_alignment", 
  'label' => __('Text Alignment: ','poxy'),
  'default' => '', 
  'options' => $text_alignment
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'right_banner_image', 
  'label' => __('Right Banner Image: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'show_text', 
  'label' => __('Show Text: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "text_color", 
  'label' => __('Text Color (Hex): ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text', 
  'id' => "sub_text_color", 
  'label' => __('Sub Text Color (Hex): ','poxy'),
  'default' => ''
));






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
    'pages' => array('vehicle_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
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
  //$my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> __('My select ','tax-meta'), 'std'=> array('selectkey2')));
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

?>