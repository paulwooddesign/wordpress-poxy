<?php $image = get_poxy_banner();
if ($image) {
 $image = 'background-image: url('. $image. ')';
}
elseif (poxy_catch_first_image()) {
  $image_url = poxy_catch_first_image();
  $image = 'background-image: url('. $image_url. ')';
}
else {
 $image_ph = get_bloginfo('template_url') . '/images/logo-blue.svg';
 $image = 'background-image: url('.$image_ph.')';
}

// BGS
$bgs = get_post_meta($id, "_poxy_image_bgs", true);
$bgs = $bgs ? $bgs : 'cover';

// BGP
$bgp = get_post_meta($id, "_poxy_image_bgp", true);
$bgp = $bgp ? $bgp : 'cc';

$title = get_the_title();
 ?><section><div class="sw"><div class="cw"><figure style="<?php echo $image; ?>" class="rel image poxya34a_38 poxyb34b_12 poxyc12c_12 poxyd11d_12 poxye11e_12 bgp-<?php echo $bgp; ?> bgs-<?php echo $bgs; ?>"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="paxy fill"></a></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc12c_12 11dpoxd_11 11epoxe_11"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><h3 class="txa-6 txb-4 txc-4 txd-5 txe-3"><?php echo $title; ?></h3></a><div class="poxyap11 poxybp11 poxycp11 poxydp11 poxyep11"><div class="poxya112 poxyb112 poxyc18 poxyd16 poxye14 line mt1 mb1"></div></div><?php the_excerpt(); ?><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="poxy mt1"><button class="p2">Read More</button></a></div></div></div></section>