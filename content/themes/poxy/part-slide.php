<?php /**
 *
 * Chimera template part for displaying page head
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
// Background Image
$slide_background_img = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_slide_background_image", true), 'full');
$slide_background_img = $slide_background_img[0];
if ($slide_background_img) {
  $slide_background_img = "background-image: url(".$slide_background_img.");";
}

// Sub Title
$sub_title = get_post_meta($post->ID, "_poxy_slide_sub_head", true);

// Copywrite
$copywrite_name = get_post_meta($post->ID, "_poxy_slide_image_copywrite_name", true);
$copywrite_link = get_post_meta($post->ID, "_poxy_slide_image_copywrite_link", true);

// Link
$button_url = get_post_meta($post->ID, "_poxy_slide_url", true);
$button_text = get_post_meta($post->ID, "_poxy_slide_button_text", true);

// bgs
$bgs = get_post_meta($post->ID, "_poxy_slide_image_copywrite_name", true);

 ?><div><section class="ofh hide"><div class="sw"><div class="cw rel"><div class="mr2 rel mb0 qoxya18a_34 qoxyb14b_11 qoxyc14c_58 poxyd11d_12 poxye11e_12"><div class="br2 rel image2 qaxya34a_p100 qaxyb34b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc"><?php if ($bgs) : ?><figure style="<?php echo $slide_background_img; ?>" class="rel image hole paxya11a_p100paxyb11b_p100qaxyc11c_p100_oxyd54d_p100_oxye54e_p100 bgp-cc bgs-<?php echo $bgs; ?>"></figure><?php else : ?><figure style="<?php echo $slide_background_img; ?>" class="ml2 mt4 hole br2 rel image paxya11a_p100 paxyb11b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc bgs-contain"></figure><?php endif; ?></div></div><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34 mlc-0 hide"><div class="wrap"><div class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12 ml0-a ml0-b"><div class="tx-c rel _oxap11a_p11 z6 _oxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h1 title="" class="txa-11 txb-12 txc-8 txd-8 mt1-d txe-7 mt1-e tx-gold"><?php the_title(); ?></h1></div><?php if ($sub_title) : ?><div class="txa-6 mt2-a accent txb-6 mt2-b txc-3 mt2-c txd-2 mt2-d txe-3 mt2-e"><?php echo $sub_title; ?></div><?php endif; ?><p class="mb1"><?php the_content(); ?></p><?php if($button_url) : ?><div class="rel poxap11a_14 poxbp11b_14 poxcp11c_14 poxdp11d_14 poxep11e_14 mt1"><figure class="_oxya18_oxyb14 p2"><a href="<?php echo $button_url; ?>" rel="bookmark" class="mt1">Download PDF</a></figure></div><?php endif; ?></div></div></div></div></div></div></section><?php poxy_section(1); ?></div>