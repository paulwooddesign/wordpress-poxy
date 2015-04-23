<?php global $post;
$id = get_the_ID();
$post_type = get_post_type( $id );

// Overide Layouts
if ($post_type == 'project') {
  $template = 4;
} else {
  $template = get_post_meta($id, "_poxy_header_layout", true);
}

// Copywrite
$copywrite_name = get_post_meta($id, "_poxy_page_image_copywrite_name", true);
$copywrite_url = get_post_meta($id, "_poxy_page_image_copywrite_link", true);

// Button
$button_url = get_post_meta($id, "_poxy_button_url", true);
$button_text = get_post_meta($id, "_poxy_button_text", true);

$button_text = $button_text ? $button_text : 'View More';

// Text Align
$text_align = get_post_meta($id, "_poxy_header_text_align", true);
$text_align = $text_align ? 'tx-'.$text_align.' ' : '';

//- if ($button_text) {
//-   $button_text = $button_text;
//- }
//- else {
//-   $button_text = 'View More';
//- }

$template = get_post_meta($id, "_poxy_header_layout", true);
$image_url = get_poxy_banner();
$title = get_the_title();
$sub_title = get_post_meta($id, "_poxy_sub_head", true);
$description = get_post_meta($id, "_poxy_description", true);
$bgp = get_post_meta($id, "_poxy_image_bgp", true);
$bgs = get_post_meta($id, "_poxy_image_bgs", true);

if ($image_url) {
  $image = 'background-image: url('. $image_url. ')';
}
//- elseif (poxy_catch_first_image()) {
//-   $image_url = poxy_catch_first_image();
//-   $image = 'background-image: url('. $image_url. ')';
//- }
else {
  //- $image = 'background-image: url(http://placehold.it/1900x800)';
  $image = false;
}


 ?><?php switch ($template) : case "1" : ?><section ng-class="{ fadeOut : waypointHeader.text.on, fadeIn : waypointHeader.text.off }" class="tx-c b_14"><div zum-waypoint="waypointHeader" up="text.on" down="text.off" offset="100%" class="sw"><div class="cw a12 b12 c12 d11 e11"><h1 class="mb0 bold txa-11 txb-10 txc-10 txd-9 txe-9 tx-gold"><?php echo $title; ?></h1><?php if($sub_title) : ?><div class="sub-head txa-3 mb1 mt2 wp2"><?php echo $sub_title ?></div><?php endif; ?><?php if($description) : ?><div class="description txa-3 txb-3 txc-3 txd-2 txe-2"><?php echo $description ?></div><?php endif; ?></div></div></section><?php break; ?><?php case "2" : ?><section ng-class="{ fadeOut : waypointHeader.text.on, fadeIn : waypointHeader.text.off }" class="tx-c"><div zum-waypoint="waypointHeader" up="text.on" down="text.off" offset="100%" class="sw"><div class="cw pt1 pb1"><div class="rel poxya14a_pox poxyb14b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"></div><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h2 class="txa-11 txb-9 txc-8 txd-8 mt1-d txe-7 mt1-e op0 wp1"><span class="mr2"><?php echo $title; ?></span></h2><?php if($sub_title) : ?><div class="sub-head txa-3 mb1 mt2 wp2"><?php echo $sub_title ?></div><?php endif; ?><?php if($description) : ?><div class="description txa-3 mb1 mt2 wp2"><?php echo $description ?></div><?php endif; ?></div></div></div></section><?php break; ?><?php case "3" : ?><section class="<?php echo $text_align; ?>"><div class="sw"><div class="cw rel a_34 b_34 c_58 d_58 e_p11"><div class="mr2 rel mb0 qoxya18a_34 qoxyb14b_34 qoxyc14c_58 poxyd11d_12 poxye11e_12"><figure class="br2 rel image2 qaxya34a_p100 qaxyb34b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc"><?php if ($bgs) : ?><figure style="<?php echo $image; ?>" class="rel image paxya11a_p100paxyb11b_p100qaxyc11c_p100_oxyd54d_p100_oxye54e_p100 bgp-cc bgs-<?php echo $bgs; ?>"></figure><?php else : ?><figure style="<?php echo $image; ?>" class="ml2 mt4 shadow br2 rel image paxya11a_p100 paxyb11b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc bgs-contain"></figure><?php endif; ?></figure></div><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34 mlc-0"><div class="wrap"><div class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12 ml0-a ml0-b"><div class="rel _oxap11a_p11 z6 _oxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h1 title="" class="txa-11 txb-12 txc-8 txd-8 mt1-d txe-7 mt1-e tx-3d"><?php echo $title; ?></h1><?php if ($sub_title) : ?><div class="sub-title txa-6 mt2-a accent txb-6 mt2-b txc-3 mt2-c txd-2 mt2-d txe-3 mt2-e"><?php echo $sub_title; ?></div><?php endif; ?><?php if($description) : ?><div class="description txa-3 mb1 mt2 wp2"><?php echo $description ?></div><?php endif; ?><?php if($button_url) : ?><div class="rel poxap11a_14 poxbp11b_14 poxcp11c_14 poxdp11d_14 poxep11e_14 mt1"><a href="<?php echo $button_url; ?>" rel="bookmark" class="button mt1 pt2 pr1 pb2 pl1"><?php echo $button_text; ?></a></div><?php endif; ?></div></div></div></div></div></div></div></section><?php break; ?><?php case "4" : ?><section ng-class="{ fadeOut : waypointHeader.text.on, fadeIn : waypointHeader.text.off }" class="tx-c"><div zum-waypoint="waypointHeader" up="text.on" down="text.off" offset="100%" class="sw"><div class="cw pt1 pb1"><div class="rel poxya14a_pox poxyb14b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"></div><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h2 class="txa-11 txb-9 txc-8 txd-8 mt1-d txe-7 mt1-e op0 wp1"><span class="mr2"><?php echo $title; ?></span></h2><?php if($sub_title) : ?><div class="sub-head txa-3 mb1 mt2 wp2"><?php echo $sub_title ?></div><?php endif; ?><?php if($description) : ?><div class="description txa-3 mb1 mt2 wp2"><?php echo $description ?></div><?php endif; ?></div></div></div></section><section><div class="sw"><div class="cw"><?php $next = get_permalink(get_adjacent_post(false,'',false)); ?><?php $prev = get_permalink(get_adjacent_post(false,'',true)); ?><?php if ($prev != get_permalink()) : ?><a style="opacity:1;" href="<?php echo $prev; ?>" class="flex-next">Previous</a><?php else : ?><a style="opacity:1;" href="<?php echo poxy_get_first_post_url($post_type); ?>" class="flex-next">Previous</a><?php endif; ?><?php if ($next != get_permalink()) : ?><a style="opacity:1;" href="<?php echo $next; ?>" class="flex-prev">Next</a><?php else : ?><a style="opacity:1;" href="<?php echo poxy_get_last_post_url($post_type); ?>" class="flex-prev">"
Next</a><?php endif; ?></div></div></section><section><div class="sw"><div class="cw rel a_34 b_34 c_58 d_58 e_p11"><div class="mr2 rel mb0 qoxya18a_34 qoxyb14b_34 qoxyc14c_58 poxyd11d_12 poxye11e_12"><figure class="br2 rel image2 qaxya34a_p100 qaxyb34b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc"><?php if ($bgs) : ?><figure style="<?php echo $image; ?>" class="fill bgp-ct bgs-<?php echo $bgs; ?>"></figure><?php else : ?><figure style="<?php echo $image; ?>" class="ml2 mt4 shadow rel image paxya11a_p100 paxyb11b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-cc bgs-contain"></figure><?php endif; ?></figure></div><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34 mlc-0"><div class="wrap"><div class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12 ml0-a ml0-b"><div class="rel poxap11a_p11 z6 poxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h3 class="mb2 txa-4 txb-4 txc-8 txd-8 mt1-d txe-7 mt1-e">Client</h3><p>Chimera</p><h3 class="mt1 mb2 txa-4 txb-4 txc-8 txd-8 mt1-d txe-7">Studio</h3><p>Paul Wood Design</p><h3 class="mt1 mb2 txa-4 txb-4 txc-8 txd-8 mt1-d txe-7 mt1-e">Techonlogy</h3><p><?php poxy_get_terms_list(); ?></p><?php if($button_url) : ?><div class="rel poxap11a_14 poxbp11b_14 poxcp11c_14 poxdp11d_14 poxep11e_14 mt1"><a href="<?php echo $button_url; ?>" target="_blank" class="button mt1 pt2 pr1 pb2 pl1">View Site</a></div><?php endif; ?></div></div></div></div></div></div></div></section><?php endswitch; ?>