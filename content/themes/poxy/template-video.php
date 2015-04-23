<?php global $post;
$id = get_the_ID();
$description = get_post_meta($id, "_poxy_description", true);

$args = array(
  //- 'posts_per_page' => 8,
  'orderby' => 'menu_order',
  'order'   => 'ASC',
  'project_cat' => 'video',
  'meta_key' => '_poxy_featured',
  'post_type' => 'project'
);

$sections = new WP_Query( $args );
 ?><section class="___a13a_12b13b_12c12c_35d12d_35e12e_35 hole"><div class="sw"><div class="cw"><?php get_template_part( 'header-inside' ); ?></div><div class="cw thumbs"><?php while ($sections->have_posts()) : $sections->the_post(); ?><?php $link = get_the_permalink(); ?><?php $title = get_the_title(); ?><?php $image_url = get_poxy_featured('large'); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><?php $background_color = 'background-color: rgba(255,255,255,.9)'; ?><figure class="br2"><a href="<?php the_permalink(); ?>" class="gray-scale"><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span style="<?php echo $background_color; ?>" class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bgs-cover bgp-ct"></span></a></figure><?php endwhile; ?><?php wp_reset_query(); ?></div></div></section><?php $args = array(
  'orderby' => 'menu_order',
  'order'   => 'ASC',
  'posts_per_page' => 99,
  'meta_key' => '_poxy_featured',
  'meta_compare' =>   'NOT EXISTS',
  'project_cat' => 'video',
  'post_type' => array('project')
);

$sections = new WP_Query( $args );
 ?><section class="___a16a_14b14b_13c14c_13d13d_12e13e_12 hole"><div class="sw"><div class="cw thumbs"><?php while ($sections->have_posts()) : $sections->the_post(); ?><?php $link = get_the_permalink(); ?><?php $title = get_the_title(); ?><?php $image_url = get_poxy_featured('large'); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><?php $background_color = 'background-color: rgba(255,255,255,.9)'; ?><figure class="br2"><a href="<?php the_permalink(); ?>" class="gray-scale"><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span style="<?php echo $background_color; ?>" class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bgs-cover bgp-ct"></span></a></figure><?php endwhile; ?><?php wp_reset_query(); ?></div></div></section>