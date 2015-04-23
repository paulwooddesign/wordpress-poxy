<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .4)';
$button_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba(0,0,0, 1)';
 ?><?php while (have_posts()): ?><?php the_post();
$image_url = get_poxy_featured('full');
$image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)';
$title = get_the_title();
$href = get_the_permalink();
 ?><section class="clear ofh"><div class="sw"><div class="cw a_18b_112c_16 thumbs"></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?>