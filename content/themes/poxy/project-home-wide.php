<?php $author_id = get_post_meta($post->ID, "_poxy_client_name", true);
$color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0';
$color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0';
$color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0';
$background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', .84)';
$background_color_100 = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
$accent_color = 'color: rgba('.$color_red.','.$color_green.','.$color_blue.', 1)';
//- $accent_color = 'color: rgba(0,0,0, 1)';



 ?><section class="ofh rel bgp-ct bgs-100 z8"><div class="paxy fill bg-black"></div><div class="paxy fill shadow-r45-inset--dark bg___svg"></div><div class="sw"><?php if($author_id) : ?><div class="cw"><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post; ?><?php $image_url = get_poxy_banner(); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)'; ?><figure style="<?php echo $image; ?>" class="shadow-r45-dark-small rel mb0 qoxya11a_12 qoxyb11b_35 poxyc11c_35 poxyd11d_58 poxye11e_58 bgp-ct bg-100"></figure><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?></div><?php endif; ?></div></section><?php get_template_part( 'project-overview' ); ?><section class="ofh rel bgp-ct bgs-100 hole2 txa-4 txb-2 txc-2"><div class="sw"><div class="cw"><figure class="rel a13a_12b14b_12c13c_12"><div class="qaxy mt1 bg-main2 a35a_35b35b_35c35c_35"><div class="rel qoxya13a_25qoxyb14b_25qoxyc13c_25"><h1 class="b_18 mb2 bold txa-10 txb-7 txc-6 txt-0"><?php the_title(); ?></h1><div class="mb4"><span class="mr4 bold tx-u">Location:</span><span>Boulder, CO</span></div><div class="mb1"><span class="mr4 bold tx-u">Industry:</span><span>Profesional Lighting</span></div><div class="content mr2"><?php the_content(); ?></div><button class="baxy"><a href="#" style="<?php echo $accent_color; ?>" class="poxy tx-v pt4 pb4"><div><p class="tx-1">View Project</p></div></a></button></div></div></figure></div><?php if($author_id) : ?><div class="cw rel pla__13 plb__14 plc__13"><div class="m0"><div class="content-box mla__13 mlb__14 mlc__13 z10 paxya34a_12paxyb34b_12paxyc34c_12"><div style="<?php echo $background_color; ?>" class="content-box ml1 z10 paxya11a_35paxyb11b_35paxyc11c_35"><div class="content-box paxy fill bg-black"></div><div style="<?php echo $background_color; ?>" class="content-box paxy fill shadow-r45-inset--dark"><?php $args = array(
  'ignore_sticky_posts' => 1,
  'posts_per_page' => 1,
  'author__in' => $author_id,
  'post_type' => array('project')
);
$member_posts = new WP_Query( $args );
 ?><?php if ($member_posts->have_posts()) : ?><?php while ($member_posts->have_posts()) : $member_posts->the_post(); ?><?php global $post; ?><?php $image_url = get_poxy_banner(); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)'; ?><figure style="<?php echo $image; ?>" class="op___1h bgp-ct bg-100 ml1 mt1 shadow-r45-dark-small rel mb0 poxya23a_12 poxyb34b_12 poxyc23c_12 poxyd11d_58 poxye11e_58"><div class="op___0 oxy fill"><div class="op___70 oxy fill bg-black"></div><div class="oxy"><div class="poxy p100"><button class="br___100 b110b_110 mr2"><svg-icon p="facebook" class="white oxy b116b_116"></svg-icon></button><button class="br___100 b110b_110 mr2"><svg-icon p="link" class="white oxy b116b_116"></svg-icon></button><button class="br___100 b110b_110"><svg-icon p="twitter" class="white oxy b116b_116"></svg-icon></button></div></div></div></figure><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?></div></div><?php endif; ?></div></div></div></div></section>