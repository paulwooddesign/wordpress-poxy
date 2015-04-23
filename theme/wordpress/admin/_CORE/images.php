<?php
//////////////////////////////////////////////////////////////
// Custom Background
/////////////////////////////////////////////////////////////

//add_theme_support( 'custom-background');


//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

add_theme_support('post-thumbnails');

set_post_thumbnail_size(350, 350, true);
add_image_size('poxy_thumb_700x900', 700, 900, array( 'center', 'top' ), true);
add_image_size('poxy_thumb_300x400', 300, 400, array( 'center', 'top' ), true);
add_image_size('poxy_1000x1500', 1000, 1500, array( 'center', 'top' ), true);
add_image_size('poxy_600x1000', 600, 1000, array( 'center', 'top' ), true);
// add_image_size('poxy_post_thumb_small', 150, 150, true);
//add_image_size('poxy_post_thumb_tiny', 50, 50, true);
add_image_size('poxy_square_thumb_350', 350, 350, true);
// add_image_size('poxy_thumb_600x400', 600, 400, true);
// add_image_size('poxy_thumb_900x500', 900, 500, true);
// add_image_size('poxy_thumb_650x650', 650, 650, true);
// add_image_size('poxy_post_thumb', 150, 300, true);

add_image_size('poxy_banner_bg', 2000, 1440, false);
add_image_size('poxy_background_image_full', 3000, 30000);
// add_image_size( 'poxy_banner_bg_crop', 2000, 1440, array( 'center', 'center' ) );
//add_image_size('w45_home_slide', 1600, 600, true);
//add_image_size('poxy_one_third_cropped', 300, 175, true);
//add_image_size('w45_600x400_cropped', 600, 400, true);
//add_image_size('w45_600x750_cropped', 600, 750, true);

// if(of_get_option('w45_product_image_width') & of_get_option('w45_product_image_height')) {
// $w45_product_width = of_get_option('w45_product_image_width');
// $w45_product_height = of_get_option('w45_product_image_height');
// add_image_size('w45_product_cropped', $w45_product_width, $w45_product_height, true);
// } else {
// add_image_size('w45_product_cropped', 800, 500, true);
// }

new MultiPostThumbnails(array(
  'label' => 'Banner Image',
  'id' => 'background_image',
  'post_type' => 'page'
  )
);


new MultiPostThumbnails(array(
  'label' => 'Banner Image',
  'id' => 'background_image',
  'post_type' => 'project'
  )
);


// new MultiPostThumbnails(array(
//   'label' => 'Background Image',
//   'id' => 'background_image',
//   'post_type' => 'post'
//   )
// );

// new MultiPostThumbnails(array(
//   'label' => 'Banner Image',
//   'id' => 'background_image',
//   'post_type' => 'project'
//   )
// );


// new MultiPostThumbnails(array(
//   'label' => 'Bio Background Image',
//   'id' => 'background_image',
//   'post_type' => 'team'
//   )
// );

// new MultiPostThumbnails(array(
//   'label' => 'Home Sprite icon',
//   'id' => 'background_image',
//   'post_type' => 'service'
//   )
// );



 add_image_size('poxy_background_image_full', 3000, 30000);

// Hide MultiPostThumbnails Links in regular media upload page

function multi_post_thumbnail_links() {
   echo '<style type="text/css">
           .media-php .post-slidewhow_image-thumbnail{display: none;}
           .media-php .page-slidewhow_image-thumbnail{display: none;}
           .media-php .project-slidewhow_image-thumbnail{display: none;}
         </style>';
}

add_action('admin_head', 'multi_post_thumbnail_links');

function get_single_custom_background() {
  global $wp_query;
  global $post;
  $post_type = get_post_type($post->ID);
  $is_tiled_bkg = get_post_meta($post->ID, "_poxy_background_tile_value", true);
  $custom_background_img = MultiPostThumbnails::get_the_post_thumbnail_url($post_type, "background_image", $post->ID, "poxy_background_image_full");
  return $custom_background_img;
}

function get_banner_bg() {
  global $wp_query;
  global $post;
  $post_type = get_post_type($post->ID);
  //$is_tiled_bkg = get_post_meta($post->ID, "_poxy_background_tile_value", true);
  $custom_background_img = MultiPostThumbnails::get_the_post_thumbnail_url($post_type, "background_image", NULL, "poxy_post_thumb_tiny");
  return $custom_background_img;
}

function get_single_custom_background_thumb() {
  global $wp_query;
  global $post;
  $post_type = get_post_type($post->ID);
  $is_tiled_bkg = get_post_meta($post->ID, "_poxy_background_tile_value", true);
  $custom_background_img = MultiPostThumbnails::w45_get_the_post_thumbnail_url($post_type, "background_image", $post->ID, "w45_square_thumb_350");
  return $custom_background_img;
}

function has_single_custom_background() {
  if(get_single_custom_background()){
    return true;
  }
}
