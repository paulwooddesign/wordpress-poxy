<?php add_action('wp_enqueue_scripts', 'finder_load_scripts');

function finder_load_scripts() {
 wp_enqueue_script( 'my-ajax-request', get_bloginfo('stylesheet_directory') . '/admin/ajax/ajax.js', array( 'jquery' ), '1.0', true );
 wp_localize_script( 'my-ajax-request', 'MyAjax', array(
  'ajaxurl'					=> admin_url( 'admin-ajax.php' ),
  'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' ),
  )
 );
}

add_action( 'wp_ajax_nopriv_myajax-submit', 'ajax_project_load' );
add_action( 'wp_ajax_myajax-submit', 'ajax_project_load' );

function ajax_project_load() {
 $the_slug = $_POST['slug'];
 // generate the response
 $response = json_encode( "Success" );
 
 // response output
 header( "Content-Type: application/json" );
 
 $args=array(
  'post_type' => 'project',
  'post_status' => 'publish',
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 20,
  'project_cat' => $the_slug
 );
 $myposts = get_posts( $args );
 foreach ( $myposts as $post ) : setup_postdata( $post ); ?><?php $id = $post->ID; ?><?php $link = get_the_permalink($id); ?><?php $title = get_the_title(); ?><?php $slug = $post->slug; ?><?php $image_id = get_post_thumbnail_id($id); ?><?php $image_url = wp_get_attachment_image_src($image_id, 'poxy_square_thumb_350', false); ?><?php $image_url = $image_url[0]; ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><?php $color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0'; ?><?php $color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0'; ?><?php $color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0'; ?><?php $background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.',.9)'; ?><li class="thumb rel z1_45 br2 bs0 m0"><div><a href="<?php echo $link; ?>" rel="bookmark" class="pjax"><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95 z10"></span><span class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bg-cover bgp-ct z10"></span><div class="shadow oxy shadow ofh br2 z10"></div></a></div></li><?php endforeach; ?><?php wp_reset_postdata(); ?><?php exit;
} ?>