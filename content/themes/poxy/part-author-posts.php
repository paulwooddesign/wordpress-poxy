<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true); ?><?php if($author_id) : ?><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 3,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><section><div class="sw"><div class="cw"><h3>Projects</h3></div></div></section><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php get_template_part('part-blog-section'); ?><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?>