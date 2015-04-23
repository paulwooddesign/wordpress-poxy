<?php



/////////////////////////////////////////////////////////////
// Event options
/////////////////////////////////////////////////////////////
$prefix = "_poxy_";

$header_layout = array(
  "0" => "Default",
  "fixed" => "Fixed Height",
  "auto" => "Auto Height",
  "video" => "Video",
);

$image_bgp = array(
  "cc" => "Center",
  "rc" => "Right",
  "lc" => "Left",
  "ct" => "Top",
  "cb" => "Bottom",
  "rt" => "Top Right",
  "lt" => "Top Left",
  "rb" => "Bottom Right",
  "lb" => "Bottom Left"
);

$image_bgs = array(
  "cover" => "Cover",
  "contain" => "Contain",
  "100" => "100%",
  "98" => "98%",
  "96%" => "96%",
  "50" => "50%"
);

$text_align = array(
  "c" => "Center",
  "l" => "Left",
  "r" => "Right",
);

$config = array(
    'id' => 'page_options',
    'title' => 'Page Options',
    'prefix' => $prefix,
    'postType' => array('page', 'post', 'project', 'slide'),
    'context' => 'side',
    'priority' => 'default',
    'usage' => 'theme',
    'showInColumns' => false
);

$page_options_meta_box = new mrMetaBox($config);

$page_options_meta_box->addField(array(
  'type' => 'Checkbox',
  'id' => 'featured',
  'label' => __('Featured: ','poxy')
));
$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "header_layout",
  'label' => __('Header Layout: ','poxy'),
  'default' => '',
  'options' => $header_layout
));
$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "video_sd",
  'label' => __('Video SD URL: ','poxy'),
  'default' => ''
));
$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "video_hd",
  'label' => __('Video HD URL: ','poxy'),
  'default' => ''
));
$project_section_4_options_meta_box->addField(array(
  'type' => 'Image',
  'id' => 'video_cover',
  'label' => __('Video Cover Image: ','poxy'),
  'attachToPost' => false
));
$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "image_bgp",
  'label' => __('Featured Image Position: ','poxy'),
  'default' => '',
  'options' => $image_bgp
));

$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "image_bgp",
  'label' => __('Featured Image Position: ','poxy'),
  'default' => '',
  'options' => $image_bgp
));

$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "image_bgs",
  'label' => __('Featured Image Size: ','poxy'),
  'default' => '',
  'options' => $image_bgs
));

$page_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'sub_head',
  'label' => __('Sub Heading: ','poxy')
));

$page_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description',
  'label' => __('Description: ','poxy')
));

$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "image_copywrite_name",
  'label' => __('Image Copywrite Name: ','poxy'),
  'default' => ''
));

$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "image_copywrite_link",
  'label' => __('Image Copywrite Link: ','poxy'),
  'default' => ''
));

$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "button_url",
  'label' => __('Button URL: ','poxy'),
  'default' => ''
));
$page_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => "button_text",
  'label' => __('Button Title: ','poxy'),
  'default' => ''
));



// $page_options_meta_box->addField(array(
//   'type' => 'Text',
//   'id' => 'background_color',
//   'label' => __('Background Color(#hex): ','poxy')
// ));
//
// $page_options_meta_box->addField(array(
//   'type' => 'Text',
//   'id' => 'font_color',
//   'label' => __('Font Color(#hex): ','poxy')
// ));



$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "header_layout",
  'label' => __('Header Layout: ','poxy'),
  'default' => '',
  'options' => $header_layout
));

$page_options_meta_box->addField(array(
  'type' => 'Select',
  'id' => "header_text_align",
  'label' => __('Text align: ','poxy'),
  'default' => '',
  'options' => $text_align
));
