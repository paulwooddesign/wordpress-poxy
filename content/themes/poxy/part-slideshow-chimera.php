<?php $args = array(
 //-  'orderby' => 'rand',
  'posts_per_page' => 2,
  'post_type' => array('slide')
);

$parts = new WP_Query( $args );
 ?><section class="home-slideshow clear"><div class="sw m0 poxy a_12 b_12 c_58 d_58 e_p11 ofh"><slick class="mb0"><?php while ($parts->have_posts()) : $parts->the_post();
  get_template_part('part-slide-chimera');
endwhile;
wp_reset_query(); ?></slick></div></section>