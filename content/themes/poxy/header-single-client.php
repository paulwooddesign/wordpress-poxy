<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .4)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba(0,0,0, 1)';

 ?><?php if($author_id) : ?><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post; ?><?php $image_url = get_poxy_banner(); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)'; ?><section class="rel bg-black"><div style="<?php echo $background_color; ?>" class="paxy fill"></div><div class="sw"><div class="cw rel"><figure style="<?php echo $image; ?>" class="rel mb0 poxya11a_12 qoxyb11b_35 poxyc11c_35 poxyd11d_58 poxye11e_58 bgp-ct bg-100"></figure></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?><?php while (have_posts()): ?><?php the_post();
$image_url = get_poxy_featured('full');
$image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)';
$title = get_the_title();
$href = get_the_permalink();
 ?><section class="rel clear"><div class="sw"><div class="cw"><figure class="mt2 mb2 mb2 poxyb34b_112 tx-v"><div><div class="tx-6 title bold mt4"><?php the_title(); ?></div></div></figure><figure class="qoxyb14 mt2 mb2"><button class="fill p3 bg-accent"><a href="#" class="white">View Project</a></button></figure><?php get_template_part( 'nav-project' ); ?></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php if($author_id) : ?><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post; ?><?php $image = wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_1_1_image', true), 'poxy_1000x1500')[0] ? "background-image: url(".wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_1_1_image', true), 'poxy_1000x1500')[0].");" : ''; ?><section class="hole"><div class="sw"><div class="cw rel"><div class="poxya14poxyb14poxyc11poxyd11"><h2 style="<?php echo $accent_color; ?>" class="accent bold mr4 mb4">Overview</h2></div><div class="poxya14poxyb14poxyc13poxyd13 tx-2"><div class="title mb2"><h5 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">Studio</h5><?php $terms = get_the_terms( $post->ID , 'project_studio' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_studio' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<a href="' . $term_link . '">' . $term->name . '</a>';
  echo $term->name;
}
 ?></div></div><div class="poxya14poxyb14poxyc13poxyd13 tx-2"><div class="title mb2"><h5 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">Technology</h5><ul><?php $terms = get_the_terms( $post->ID , 'project_tech' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_tech' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
  echo '<li>' . $term->name . '</li>';
} ?></ul></div></div><div class="poxya14poxyb14poxyc13poxyd13 tx-2"><div class="title mb2"><h5 style="<?php echo $accent_color; ?>" class="bold mr4 mb4">Code</h5><?php $terms = get_the_terms( $post->ID , 'project_code' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_code' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
  echo '<span>' . $term->name . ', </span>';
}
 ?></div></div></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?>