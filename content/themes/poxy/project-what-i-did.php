<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .4)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba(0,0,0, 1)';
 ?><?php if($author_id) : ?><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post; ?><?php $image = wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_1_1_image', true), 'poxy_1000x1500')[0] ? "background-image: url(".wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_1_1_image', true), 'poxy_1000x1500')[0].");" : ''; ?><section class="shadow-right-inset bg-main"><div class="sw"><div class="cw rel"><div class="poxya14poxyb14poxyc11poxyd11"><h2 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">What I Did</h2></div><div class="poxya14poxyb34poxyc13poxyd13 tx-2"><div class="poxybp50"><div class="title mb2"><h5 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">Design</h5></div></div><div class="poxybp50"><div class="title mb2"><h5 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">Development</h5></div></div></div></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?>