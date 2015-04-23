<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .84)';
$background_color_100 = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';

 ?><?php if($author_id) : ?><?php $args = array(
  //- 'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project'),
  'project_cat' => 'web'
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post;
$id = get_the_ID();
$post_type = get_post_type( $id );


$title = get_the_title();
$sub_title = get_post_meta($id, "_poxy_sub_head", true);
$description = get_post_meta($id, "_poxy_description", true);
$header_layout = get_post_meta($id, "_poxy_header_layout", true);

$image_url = get_poxy_banner();
$image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)';
$section_number = '1';
$i = '1';
$image_url = wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'full')[0] ? wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'full')[0] : '';
$image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)'; ?><section class="ofh hole txa-4 txb-2"><div class="sw"><div class="cw"><figure class="rel a13a_12b13b_12"><div class="qaxy pt1 a35a_35 hide"><div class="rel qoxya13a_25"><h1 class="mb1 bold tx-8 txt-0">Overview</h1><div class="poxy a14b14c13d13 mb2"><div class="title mb2"><h5 class="bold mr4 mb4">Studio</h5><?php $terms = get_the_terms( $post->ID , 'project_studio' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_studio' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<a href="' . $term_link . '">' . $term->name . '</a>';
  //- echo $term->name;
  echo '<p class="txb-1">' . $term->name . '</p>';
}
 ?></div></div><div class="poxy a14b14c13d13 mb2"><div class="title mb2"><h5 class="bold mr4 mb4">Technology</h5><ul class="txb-1"><?php $terms = get_the_terms( $post->ID , 'project_tech' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_tech' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
  //- echo '<li>' . $term->name . '</li>';
  echo '<p>' . $term->name . '</p>';
} ?></ul></div></div><div class="poxy a14b14c13d13 mb2"><div class="title mb2"><h5 class="bold mr4 mb4">Code</h5><ul class="txb-1"><?php $terms = get_the_terms( $post->ID , 'project_code' );
foreach ( $terms as $term ) {
  $term_link = get_term_link( $term, 'project_code' );
  if( is_wp_error( $term_link ) )
  continue;
  //- echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
  //- echo '<span>' . $term->name . ', </span>';
  echo '<p>' . $term->name . '</p>';
}

 ?></ul></div></div></div></div></figure></div><div class="cw rel pla__13 plb__13"><figure class="op___1h rel mt1 bgp-ct bgs-cover poxy qoxya23b23c11d11e11"><div class="content-box p1 oxy fill"><div class="content-box pr1 pl1 paxy fill bg-black"></div><div style="<?php echo $background_color; ?>" class="content-box pr1 pl1 paxy fill shadow-r45-inset--dark"></div></div><div style="<?php echo $image; ?>" class="oxy fill shadow-r45-dark-small"></div><div class="op___0 oxy fill z10"><div class="op___50 oxy fill bg-black"></div><a href="#" style="<?php echo $background_color_100; ?>" class="op___100 br___3 oxy b14b_112 tx-c white tx-u"><div class="oxy">View Project</div></a></div><img src="<?php echo $image_url; ?>"/></figure></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php endif; ?>