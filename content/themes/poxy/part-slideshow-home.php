<?php /**
 *
 * Chimera template part for displaying page head
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
 $args = array(
   'orderby' => 'rand',
   'posts_per_page' => 6,
   'post_type' => array('slide')
 );
 
 $parts = new WP_Query( $args );
  ?><?php if ($parts->have_posts()): ?><section class="home-slideshow clear"><div class="sw m0 poxy a_11 b_11 c_11 d_58 e_p11 ofh"><slick class="mb0"><?php while ($parts->have_posts()) : $parts->the_post();
  get_template_part('part-slide-chimera');
endwhile;
wp_reset_query(); ?></slick></div></section><?php endif; ?>