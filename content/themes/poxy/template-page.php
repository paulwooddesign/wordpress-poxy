<?php /**
 * Chimera template for displaying the blog page
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
get_template_part( 'part-header' );
 ?><?php if (have_posts()): ?><?php get_template_part( 'part-header' ); ?><?php while (have_posts()): ?><?php the_post(); ?><main><article class="container"><?php get_template_part('title'); ?><?php get_template_part('meta'); ?><section class="main"><?php if (get_field('post_intro')): ?><p class="intro"><?php the_field('post_intro'); ?></p><?php endif; ?><?php the_content(); ?></section><?php get_template_part('comments'); ?></article><?php get_sidebar(); ?></main><?php endwhile; ?><?php endif; ?>