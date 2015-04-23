<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';

$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';

$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)'; ?><div style="<?php echo $background_color; ?>" class="pfxy a15a_15 b16b_16 c15c_15 d18d_18 e18e_18 z5"></div><?php get_template_part( 'nav-project' ); ?><?php get_template_part( 'project-home-wide' ); ?><?php get_template_part( 'project-overview' ); ?><?php get_template_part( 'project-title' ); ?><?php get_template_part( 'project-home-full' ); ?><?php if($author_id) : ?><?php $args = array(
 //- 'ignore_sticky_posts' => 1,
 'posts_per_page' => 1,
 'author__in' => $author_id,
 'post_type' => array('project'),
 'project_cat' => 'web'
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php poxy_section(1); ?><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?><?php get_template_part( 'project-what-i-did' ); ?><?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .4)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
 ?><?php if($author_id) : ?><?php $args = array(
 //- 'ignore_sticky_posts' => 1,
 'posts_per_page' => 1,
 'author__in' => $author_id,
 'post_type' => array('project'),
 'project_cat' => 'web'
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php poxy_section(2); ?><?php poxy_section(3); ?><?php poxy_section(4); ?><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?>