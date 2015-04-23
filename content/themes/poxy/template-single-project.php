<div class="poxy shadow-right-inset"><?php get_template_part( 'header-project' ); ?><?php global $wp_query;
if (!is_archive()) {
  $page_id = $wp_query->get_queried_object();
  $page_id = $page_id->ID;
}


$blog_page_id = of_get_option('poxy_blog_page');
$blog_page = get_page($blog_page_id);

if ($blog_page_id == $page_id) {
  $image = of_get_option('poxy_blog_banner');
  if ($image) {
    $image = of_get_option('poxy_blog_banner');
    $image = 'background-image: url('. $image. ')';
  } else {
    $image = 'background-image: url(http://placehold.it/1900x800)';
  }
  $title = $blog_page->post_title;
  $copywrite_name = 'test';
  $copywrite_url = '#';
  $sub_title = get_post_meta($blog_page_id, "_poxy_page_description", true);
} else {
  // $image = get_poxy_banner();
  $image = get_poxy_thumb_650();
  if ($image) {
    $image = 'background-image: url('. $image. ')';
  } else {
    $image = 'background-image: url(http://placehold.it/1900x800)';
  }
  
  $title = get_the_title();
  $description = get_post_meta($page_id, "_poxy_page_description", true);
  $sub_title = get_post_meta($page_id, "_poxy_page_sub_head", true);
  
  $copywrite_name = get_post_meta($page_id, "_poxy_page_image_copywrite_name", true);
  $copywrite_url = get_post_meta($page_id, "_poxy_page_image_copywrite_link", true);
  
  // Link
  $button_url = get_post_meta($post->ID, "_poxy_slide_url", true);
  $button_text = get_post_meta($post->ID, "_poxy_slide_button_text", true);
  
}
 ?><?php poxy_section(1); ?><?php poxy_section(2); ?><?php poxy_section(3); ?><?php poxy_section(4); ?></div>