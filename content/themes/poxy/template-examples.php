<?php $args = array(
  'post_parent' => poxy_id(),
  'orderby' => 'menu_order',
  'post_type' => array('page')
);

$sections = new WP_Query( $args );
while ($sections->have_posts()) : $sections->the_post();
  get_template_part('part-section');
endwhile;
wp_reset_query(); ?>