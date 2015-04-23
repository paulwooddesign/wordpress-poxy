<?php /**
 *
 * Chimera template part for displaying page head
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
global $wp_query;
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
} else {
  $image = get_poxy_banner();
  if ($image) {
    $image = 'background-image: url('. $image. ')';
  } else {
    $image = 'background-image: url(http://placehold.it/1900x800)';
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

 ?><section class="bg-black white clear ofh"><?php if ($copywrite_name) : ?><figcaption class="copywrite zeta daxy p4 z6"><?php if ($copywrite_url) : ?><a href="<?php echo $copywrite_url; ?>"><?php echo $copywrite_name; ?></a><?php else : ?><?php echo $copywrite_name; ?><?php endif; ?></figcaption><?php endif; ?><div class="sw"><div class="cw rela_12 b_12 c_58 d_58 e_p11"><div id="layer-0" class="paxy fill shadow-l z2 hd he"></div><div class="rel mb0 qoxya18a_12 qoxyb14b_12 qoxyc14c_58 poxyd11d_12 poxye11e_12"><figure id="layer-1" style="<?php echo $image; ?>" class="rel image qaxya34a_34 qaxyb11b_58 qaxyc11c_p100 _oxyd54d_p100 _oxye54e_p100 bgp-rc"><div id="layer-3" class="paxy fill shadow-r z2 hd he"></div></figure></div><div class="rel poxa18a_12 mb0 poxb14b_12 poxc14c_58 poxd14d_58 poxe11e_34"><div class="wrap"><div id="layer-4" class="rel paxya12a_12 paxyb12b_12 paxyc12c_58 poxd12d_58 poxe11e_12"><div id="layer-5" class="rel _oxap11a_p11 z6 _oxbp11b_p11 _oxcp11c_p11 poxdp11d_p11 poxep11e_p11"><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h2 title="" class="txa-11 txb-9 txc-8 txd-8 mt1-d txe-7 mt1-e"><?php the_title(); ?></h2></div><?php if ($sub_title) : ?><div class="rel poxya38a_pox poxyb38b_pox poxyc38c_pox poxyd38d_pox poxye11e_pox"><h3 class="txa-3 mt2-a accent light txb-3 mt2-b txc-3 mt2-c txd-2 mt2-d txe-3 mt2-e"><?php echo $sub_title; ?></h3></div><?php endif; ?><?php if ($description) : ?><div class="rel poxa14a_14 poxyb14b_pox poxyc14c_pox poxyd11d_pox poxye11e_pox"><p><?php echo $description; ?></p></div><?php endif; ?><?php if($button_url) : ?><div class="rel poxap11a_14 poxbp11b_14 poxcp11c_14 poxdp11d_14 poxep11e_14"><a href="<?php echo $button_url; ?>"></a><button type="button" class="btn btn-svg"><svg version="1.1" viewbox="0 0 30 20" preserveaspectratio="none" class="btn_svg"><rect width="30" height="40" class="btn_svg_shape"></rect></svg><span>Learn More</span></button></div><?php endif; ?></div></div></div></div></div></div></section>