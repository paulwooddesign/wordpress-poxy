<?php // Image
$image_url = get_poxy_banner();
if ($image_url) {
  $image = 'background-image: url('. $image_url. ')';
}
else {
  //- $image = 'background-image: url(http://placehold.it/1900x800)';
  $image = false;
}


//- // Background Image
//- $slide_background_img = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_slide_background_image", true), 'full');
//- $slide_background_img = $slide_background_img[0];
//- if ($slide_background_img) {
//-   $slide_background_img = "background-image: url(".$slide_background_img.");";
//- }

// Sub Title
$sub_title = get_post_meta($post->ID, "_poxy_slide_sub_head", true);

// Copywrite
//- $copywrite_name = get_post_meta($post->ID, "_poxy_slide_image_copywrite_name", true);
//- $copywrite_link = get_post_meta($post->ID, "_poxy_slide_image_copywrite_link", true);

$copywrite_name = get_post_meta($post->ID, "_poxy_image_copywrite_name", true);
$copywrite_link = get_post_meta($post->ID, "_poxy_image_copywrite_link", true);

$sub_title = get_post_meta($id, "_poxy_sub_head", true);
$description = get_post_meta($id, "_poxy_description", true);
$bgp = get_post_meta($id, "_poxy_image_bgp", true);
$bgs = get_post_meta($id, "_poxy_image_bgs", true);


// BGS
$bgs = get_post_meta($id, "_poxy_image_bgs", true);
$bgs = $bgs ? $bgs : 'cover';

// BGP
$bgp = get_post_meta($id, "_poxy_image_bgp", true);
$bgp = $bgp ? $bgp : 'cc';

// Button
$button_url = get_post_meta($id, "_poxy_button_url", true);
$button_text = get_post_meta($id, "_poxy_button_text", true);
$button_text = $button_text ? $button_text : 'Read More';

 ?><?php if($image) : ?><div><section style="<?php echo $image; ?>" class="bg-black2 white clear ofh bgs-<?php echo $bgs; ?> bgp-<?php echo $bgp; ?>"><?php if ($copywrite_name) : ?><figcaption class="copywrite zeta daxy p4 z6"><?php echo $copywrite_name; ?></figcaption><?php endif; ?><div><div class="cw rel a_11 b_11 c_11 d_11 e_p11"><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34 mlc-0"><div class="wrap"><div class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12 ml0-a ml0-b"><div class="rel _oxap11a_p11 z6 _oxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11 hide"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h2 class="black txa-11 txb-9 txc-8 txd-8 mt1-d txe-7 mt1-e"><?php the_title(); ?></h2></div><?php if ($sub_title) : ?><div class="rel poxya38a_pox poxyb38b_pox poxyc38c_pox poxyd38d_pox poxye11e_pox"><div class="txa-6 mt2-a accent txb-3 mt2-b txc-3 mt2-c txd-2 mt2-d txe-3 mt2-e"><?php echo $sub_title; ?></div></div><?php endif; ?><?php if ($description) : ?><div class="rel poxa14a_14 poxyb14b_pox poxyc14c_pox poxyd11d_pox poxye11e_pox"><?php echo $description; ?></div><?php endif; ?><?php if($button_url) : ?><div class="rel poxap11a_14 poxbp11b_14 poxcp11c_14 poxdp11d_14 poxep11e_14"><a href="<?php echo $button_url; ?>" rel="bookmark" class="poxy mt1"><button class="p2">Read More</button></a></div><?php endif; ?></div></div></div></div></div></div></section></div><?php endif; ?>