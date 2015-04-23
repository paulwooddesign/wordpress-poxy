<?php /**
 * Chimera template for displaying the blog page
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
  ?><?php if (have_posts()): ?><?php get_template_part( 'part-header' ); ?><?php get_template_part('part-blog-categories'); ?><?php while (have_posts()): ?><?php the_post(); ?><?php $pt = get_post_type( get_the_ID() ); ?><?php if ($pt == 'post'): ?><?php get_template_part('part-blog-section'); ?><?php elseif ($pt == 'event'): ?><?php get_template_part('part-featured-pages'); ?><?php get_template_part('part-section'); ?><?php elseif ($pt == 'page'): ?><?php elseif ($pt == 'vip'): ?><?php get_template_part('part-featured-pages'); ?><?php get_template_part('part-section'); ?><?php elseif ($pt == 'taxonomy'): ?><?php get_template_part('part-section'); ?><?php elseif ($pt == 'product'): ?><?php endif; ?><?php endwhile; ?><?php endif; ?>