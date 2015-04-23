<?php
/////////////////////////////////
// Register Slide post type
/////////////////////////////////

function poxy_register_slides() {
  register_post_type( 'slide',
    array(
        'labels' => array(
        'name' => __( 'Slides', 'poxy'),
        'menu_name' => __( 'Slides', 'poxy'),
        'singular_name' => __( 'Slide', 'poxy'),
        'all_items' => __( 'All Slides', 'poxy'),
        'add_new' => __( 'Add New', 'poxy' ),
        'add_new_item' => __( 'Add New Slide', 'poxy' ),
        'edit_item' => __( 'Edit Slide', 'poxy' ),
        'new_item' => __( 'New Slide', 'poxy' ),
        'view_item' => __( 'View Slide', 'poxy' ),
        'search_items' => __( 'Search Slides', 'poxy' ),
        'not_found' => __( 'No slides found', 'poxy' ),
        'not_found_in_trash' => __( 'No slides found in Trash', 'poxy' )
      ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'menu_icon' => get_template_directory_uri(). '/admin/images/image-empty.png',
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_position ' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical' => false,
        'has_archive' => true,
        'rewrite' => 'slide'
    )
  );
}





function poxy_slide_custom_flush_rules(){
  //defines the post type so the rules can be flushed.
  poxy_register_slides();
  //and flush the rules.
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'poxy_slide_custom_flush_rules');
add_action( 'init', 'poxy_register_slides' );



$prefix = "_poxy_";
$text_alignment = array("left" => "Left", "right" => "Right", "center" => "Center");

//Slide options

$config = array(
    'id' => 'slide_options',
    'title' => 'Slide Options',
    'prefix' => $prefix."slide_",
    'postType' => array('slide'),
    'context' => 'normal',
    'priority' => 'high',
    'usage' => 'theme',
    'showInColumns' => true
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'show_text',
  'label' => __('Show Text: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'hide_title',
  'label' => __('Hide Title: ','poxy')
));


$slide_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'text_image',
  'label' => __('In Text Image: ','poxy'),
  'attachToPost' => false
));


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "sub_head",
  'label' => __('Sub Head: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description',
  'label' => __('Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "url",
  'label' => __('Slide Link: ','poxy'),
  'default' => ''
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
  'id' => 'background_image',
  'label' => __('Background Image: ','poxy'),
  'attachToPost' => false
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


$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "image_copywrite_name",
  'label' => __('Image Copywrite Name: ','poxy'),
  'default' => ''
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "image_copywrite_link",
  'label' => __('Image Copywrite Link: ','poxy'),
  'default' => ''
));



?>
