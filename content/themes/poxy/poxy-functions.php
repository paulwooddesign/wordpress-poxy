<?php function poxy_get_tax_header() {
global $wp_query;
$term_id = $wp_query->queried_object->term_id;
$tax_meta = get_option( "taxonomy_term_$term_id" );


$title = $wp_query->queried_object->name;
$description = $wp_query->queried_object->description;
$sub_title = $wp_query->queried_object->name;
$button_url = false;

$image = poxy_tax_image($term_id);
$image = 'background-image: url('. $image. ')';

$featured_image_position = 'cc';
if ($tax_meta['featured_image_position']) {
  $featured_image_position = $tax_meta['featured_image_position'];
}

$bgs = $tax_meta['featured_image_bgs'];

//- $featured_image_position = 'cc';
//- if (isset($tax_meta['featured_image_position']) {
//-   $featured_image_position = $tax_meta['featured_image_position'];
//- }


//- $featured_image_position = 'cc';
//- if (  isset( $tax_meta['featured_image_position'] )
//-   $featured_image_position = $tax_meta['featured_image_position'];

 ?><h1 class="mb2 bold txa-12 txb-11 txc-10 txd-9 txe-9 tx-gold"><?php echo $title; ?></h1><?php if($description) : ?><div class="tx-2 description"><?php echo $description ?></div><?php endif; ?><?php } ?><?php function poxy_get_children() {
 ?><?php if (have_posts()): ?><?php while (have_posts()): ?><?php the_post(); ?><?php //- $image_url = get_poxy_thumb();
$image_url = get_poxy_thumb_650();
if ($image_url) {
  $image = 'background-image: url('. $image_url. ')';
} else {
  $image_ph = get_bloginfo('template_url') . '/images/logo-blue.svg';
  $image = 'background-image: url('.$image_ph.')';
}

 ?><?php $title = get_the_title(); ?><?php $slug = poxy_slug(); ?><?php $description = poxy_meta('_poxy_product_description'); ?><?php $size = poxy_meta('_poxy_product_size'); ?><?php $size = poxy_meta('_poxy_product_size'); ?><?php $height_in = poxy_meta('_poxy_product_height_in'); ?><?php $height_cm = poxy_meta('_poxy_product_height_cm'); ?><?php $diameter_in = poxy_meta('_poxy_product_diameter_in'); ?><?php $diameter_cm = poxy_meta('_poxy_product_diameter_cm'); ?><?php $depth_in = poxy_meta('_poxy_product_depth_in'); ?><?php $depth_cm = poxy_meta('_poxy_product_depth_cm'); ?><?php $length_in = poxy_meta('_poxy_product_length_in'); ?><?php $length_cm = poxy_meta('_poxy_product_length_cm'); ?><?php $width_in = poxy_meta('_poxy_product_width_in'); ?><?php $width_cm = poxy_meta('_poxy_product_width_cm'); ?><?php $weight = poxy_meta('_poxy_product_weight'); ?><?php $pole_length_in = poxy_meta('_poxy_product_pole_length_in'); ?><?php $pole_length_cm = poxy_meta('_poxy_product_pole_length_cm'); ?><?php $fits = poxy_meta('_poxy_product_fits'); ?><?php $voltage = poxy_meta('_poxy_product_voltage'); ?><?php $max_wattage = poxy_meta('_poxy_product_max_wattage'); ?><?php $lights_mounts = poxy_meta('_poxy_product_lights_mounts'); ?><?php $rating = poxy_meta('_poxy_product_rating'); ?><?php $max_wattage = poxy_meta('_poxy_product_max_wattage'); ?><section class="txa-2 txb-1"><div class="sw"><div class="cw rel"><div class="poxy11a_58 poxb11b_58 poxc12c_14 poxd12d_12 poxe12e_12 tx-c z1_45"><figure style="<?php echo $image; ?>" class="poxya11a_58 poxyb11b_58 poxyc12c_14 poxyd12d_12 poxye12e_12 bgp-ct bg-cover"></figure></div></div></div></section><?php //- Section 1
global $post;
$section_number = 2;
$id = $post->ID;

$layout = get_post_meta($id, '_poxy_project_section_'.$section_number.'_layout', true);
$layout = $layout ? $layout : '1';

$title = get_post_meta($id, '_poxy_project_section_'.$section_number.'_title', true);
$title = $title ? $title : 'Section 1 Title';

$description = get_post_meta($id, '_poxy_project_section_'.$section_number.'_description', true);
$description = $description ? $description : 'Section 1 Description';

//- Section 1
//- Figure 1
$fig_number = 1;
for($i=1; $i <= 5; $i++) {
  ${'f1_image_' . $i} = wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'full')[0] ? "background-image: url(".wp_get_attachment_image_src(get_post_meta($post->ID, '_poxy_project_fig_'.$section_number.'_'.$i.'_image', true), 'full')[0].");" : '';
  ${'f1_bgs_' . $i} = get_post_meta($id, '_poxy_project_fig_'.$section_number.'_'.$i.'_bgs', true) ? get_post_meta($id, '_poxy_project_fig_'.$section_number.'_'.$i.'_bgs', true) : 'cover';
  ${'f1_bgp_' . $i} = get_post_meta($id, '_poxy_project_fig_'.$section_number.'_'.$i.'_bgp', true) ? get_post_meta($id, '_poxy_project_fig_'.$section_number.'_'.$i.'_bgp', true) : 'ct';
}
 ?><section class="white-shadow bg-main"><div class="sw"><div class="cw tx-c"><div class="rel poxa11 poxb11 poxc11 poxd11 poxe11"><h2 title="" class="txa-6 txb-6 txc-6 txd-6 txe-6"><span class="mr2"></span><?php echo $title; ?></h2><div class="txa-3 mt2"><?php echo $description; ?></div></div><figure style="<?php echo $f1_image_1; ?>" class="rel image z1_45 poxya14a_12 poxyb14b_12 poxyc14c_114 poxyd11d_12 poxye11e_12 bgp-<?php echo $f1_bgp_1; ?> bgs-<?php echo $f1_bgs_1; ?>"></figure><figure style="<?php echo $f1_image_2; ?>" class="rel image z1_45 poxya14a_12 poxyb14b_12 poxyc14c_114 poxyd11d_12 poxye11e_12 bgp-<?php echo $f1_bgp_2; ?> bgs-<?php echo $f1_bgs_2; ?>"></figure><figure style="<?php echo $f1_image_3; ?>" class="rel image z1_45 poxya14a_12 poxyb14b_12 poxyc14c_114 poxyd11d_12 poxye11e_12 bgp-<?php echo $f1_bgp_3; ?> bgs-<?php echo $f1_bgs_3; ?>"></figure><figure style="<?php echo $f1_image_4; ?>" class="rel image z1_45 poxya14a_12 poxyb14b_12 poxyc14c_114 poxyd11d_12 poxye11e_12 bgp-<?php echo $f1_bgp_3; ?> bgs-<?php echo $f1_bgs_3; ?>"></figure></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?><?php }
 ?><?php function poxy_get_parents($termchildren, $section, $bgp = 'cc', $bgs = 'contain' ) {
 ?><?php if($section == 1) : ?><?php foreach ( $termchildren as $child ) : ?><?php $title = $child->name; ?><?php $description = $child->description; ?><?php $slug = $child->slug; ?><?php $term_id = $child->slug; ?><?php $image = poxy_tax_image($term_id); ?><?php $image = 'background-image: url('. $image. ')'; ?><section><div class="sw"><div class="cw"><figure style="<?php echo $image; ?>" class="rel image poxya34a_38poxyb34b_12poxyc12c_12poxyd11d_12poxye11e_12 bgp-<?php echo $bgp; ?> bgs-<?php echo $bgs; ?>"><a href="<?php echo $slug; ?>" rel="bookmark" class="paxy fill"></a></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc12c_12 11dpoxd_11 11epoxe_11"><a href="<?php echo $slug; ?>" rel="bookmark"><h3 class="txa-6 txb-4 txc-4 txd-5 txe-3"><?php echo $title; ?></h3></a><div class="poxyap11 poxybp11 poxycp11 poxydp11 poxyep11"><div class="poxya112 poxyb112 poxyc18 poxyd16 poxye14 line mt1 mb1 bg-black"></div></div><p><?php echo $description; ?></p><a href="<?php echo $slug; ?>" rel="bookmark" class="poxy mt1"><button class="p2">Read More</button></a></div></div></div></section><?php endforeach; ?><?php else : ?><?php foreach ( $termchildren as $child ) : ?><?php $title = $child->name; ?><?php $description = $child->description; ?><?php $slug = $child->slug; ?><?php $term_id = $child->slug; ?><?php $image = poxy_tax_image($term_id); ?><?php $image = 'background-image: url('. $image. ')'; ?><section><div class="sw"><div class="cw"><figure style="<?php echo $image; ?>" class="rel image poxya34a_38 poxyb34b_12 poxyc12c_12 poxyd11d_12 poxye11e_12 bgp-ct bgs-cover"><a href="<?php echo $slug; ?>" rel="bookmark" class="paxy fill"></a></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc12c_12 11dpoxd_11 11epoxe_11"><a href="<?php echo $slug; ?>" rel="bookmark"><h3 class="txa-6 txb-4 txc-4 txd-5 txe-3"><?php echo $title; ?></h3></a><div class="poxyap11 poxybp11 poxycp11 poxydp11 poxyep11"><div class="poxya112 poxyb112 poxyc18 poxyd16 poxye14 line mt1 mb1 bg-black"></div></div><p><?php echo $description; ?></p><a href="<?php echo $slug; ?>" rel="bookmark" class="poxy mt1"><button class="p2">Read More</button></a></div></div></div></section><?php endforeach; ?><?php endif; ?><?php } ?>