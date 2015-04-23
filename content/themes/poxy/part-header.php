<section ng-class="{ fadeOut : waypoint123s.text.on, fadeIn : waypoint123s.text.off }" class="tx-c"><div zum-waypoint="waypoint123s" up="text.on" down="text.off" offset="100%" class="sw"><div class="cw pt1 pb1"><div class="rel poxya14a_pox poxyb14b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"></div><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h1 class="tx-3d txa-12 txb-12 txc-12 txd-12"><?php the_title(); ?></h1><div class="sub-head txa-3 mb1 mt2 wp2">We are an Advertising and Production Agency that uses excellence to forge bonds with customers and propel businesses.</div></div></div></div></section><?php global $wp_query;
if (!is_archive()) {
  $page_id = $wp_query->get_queried_object();
  $page_id = $page_id->ID;
}


$blog_page_id = of_get_option('poxy_blog_page');
$blog_page = get_page($blog_page_id);

if ($blog_page_id == $page_id) {
  $image = of_get_option('poxy_blog_banner');
  if ($image) {
    $image = of_get_option('poxy_blog_banner');
    $image = 'background-image: url('. $image. ')';
  } else {
    $image = 'background-image: url(http://placehold.it/1900x800)';
  }
  $title = $blog_page->post_title;
  $copywrite_name = 'test';
  $copywrite_url = '#';
  $sub_title = get_post_meta($blog_page_id, "_poxy_page_description", true);
  //- $description = get_post_meta($blog_page_id, "_poxy_page_description", true);
  $description = false;
  
}
else {

  $image = get_poxy_banner();
  if ($image) {
    $image = 'background-image: url('. $image. ')';
  }
  elseif (poxy_catch_first_image()) {
    $image_url = poxy_catch_first_image();
    $image = 'background-image: url('. $image_url. ')';
  }
  else {
    //- $image = 'background-image: url(http://placehold.it/1900x800)';
    $image = false;
  }
  
  $title = get_the_title();
  $description = get_post_meta($page_id, "_poxy_page_description", true);
  $sub_title = get_post_meta($page_id, "_poxy_page_sub_head", true);
  
  $copywrite_name = get_post_meta($page_id, "_poxy_page_image_copywrite_name", true);
  $copywrite_url = get_post_meta($page_id, "_poxy_page_image_copywrite_link", true);
  
  // Link
  $button_url = get_post_meta($post->ID, "_poxy_slide_url", true);
  $button_text = get_post_meta($post->ID, "_poxy_slide_button_text", true);
  
}


 ?><?php if ($image) : ?><section class="bg-black white clear ofh"><?php if ($copywrite_name) : ?><figcaption class="copywrite zeta daxy p4 z6"><?php if ($copywrite_url) : ?><a href="<?php echo $copywrite_url; ?>"><?php echo $copywrite_name; ?></a><?php else : ?><?php echo $copywrite_name; ?><?php endif; ?></figcaption><?php endif; ?><div class="sw"><div class="cw rel a_58 b_34 c_58 d_58 e_p11"><div class="paxy fill shadow-l z2 hd he"></div><div class="rel mb0 qoxya18a_58 qoxyb14b_34 qoxyc14c_58 poxyd11d_12 poxye11e_12"><figure class="br2 rel image qaxya34a_p100 qaxyb34b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-rc"><figure style="<?php echo $image; ?>" class="br2 rel image poxya11a_p100 poxyb34b_p100 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-rc bg-contain"></figure></figure></div><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34 ml0-c"><div class="wrap"><div class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12 ml0-a ml0-b"><div class="rel _oxap11a_p11 z6 _oxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h2 title="" class="txa-9 txb-8 txc-8 txd-8 mt1-d txe-7 mt1-e"><?php echo $title; ?></h2></div><?php if ($sub_title) : ?><div class="rel poxya14a_pox poxyb14b_pox poxyc38c_pox poxyd38d_pox poxye11e_pox"><div class="accent2 txa-5 mt2-a txb-2 mt2-b txc-3 mt2-c txd-2 mt2-d txe-3 mt2-e"><?php echo $sub_title; ?></div></div><?php endif; ?><?php if ($description) : ?><div class="rel poxa14a_14 poxyb14b_pox poxyc14c_pox poxyd11d_pox poxye11e_pox"><p><?php echo $description; ?></p></div><?php endif; ?></div></div></div></div></div></div></section><?php endif; ?>