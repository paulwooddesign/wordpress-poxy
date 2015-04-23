<?php /**
 * Chimera template for displaying the blog page
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
  ?><?php get_template_part( 'part-header' ); ?><?php get_template_part('part-blog-categories'); ?><?php if (have_posts()): ?><?php while (have_posts()): ?><?php the_post(); ?><?php get_template_part('part-blog-section'); ?><?php endwhile; ?><?php endif; ?><?php get_template_part( 'part-pagination'); ?>