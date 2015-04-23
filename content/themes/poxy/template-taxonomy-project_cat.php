<section class="___a15a_13b14b_13c12c_35d12d_35e12e_35 ofh hole"><div class="sw"><div class="cw"><div class="poxy a25 b12b_16 c23"><?php poxy_get_tax_header(); ?></div></div><div class="cw thumbs"><?php if (have_posts()): ?><?php while (have_posts()): ?><?php the_post(); ?><?php $image_url = get_poxy_thumb_300x400();
$image = $image_url ? 'background-image: url('. $image_url. ')' : false;
$i = 1;
$section_number = 1;
//- $image = wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'poxy_thumb_300x400')[0] ? "background-image: url(".wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'poxy_thumb_300x400')[0].");" : '';
$sub_title = get_post_meta($post->ID, "_poxy_vip_sub_head", true);
$title = get_the_title();
$id = get_the_ID();
 ?><figure class="br2"><a href="<?php the_permalink(); ?>" onclick="loadProject("static")" class="gray-scale"><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span style="<?php echo $background_color; ?>" class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bg-cover bgp-ct"></span></a></figure><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?></div></div></section>