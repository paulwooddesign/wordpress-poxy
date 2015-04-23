<?php $i = 1; ?><?php if (have_posts()): ?><?php while (have_posts()): ?><?php the_post(); ?><?php //- $image_url = get_poxy_thumb();
$image_url = get_poxy_thumb_650();
if ($image_url) {
  $image = 'background-image: url('. $image_url. ')';
} else {
  $image_ph = get_bloginfo('template_url') . '/images/logo-blue.svg';
  $image = 'background-image: url('.$image_ph.')';
}

 ?><?php $title = get_the_title(); ?><?php $slug = poxy_slug(); ?><?php $description = poxy_meta('_poxy_product_description'); ?><?php $size = poxy_meta('_poxy_product_size'); ?><?php $size = poxy_meta('_poxy_product_size'); ?><?php $height_in = poxy_meta('_poxy_product_height_in'); ?><?php $height_cm = poxy_meta('_poxy_product_height_cm'); ?><?php $diameter_in = poxy_meta('_poxy_product_diameter_in'); ?><?php $diameter_cm = poxy_meta('_poxy_product_diameter_cm'); ?><?php $depth_in = poxy_meta('_poxy_product_depth_in'); ?><?php $depth_cm = poxy_meta('_poxy_product_depth_cm'); ?><?php $length_in = poxy_meta('_poxy_product_length_in'); ?><?php $length_cm = poxy_meta('_poxy_product_length_cm'); ?><?php $width_in = poxy_meta('_poxy_product_width_in'); ?><?php $width_cm = poxy_meta('_poxy_product_width_cm'); ?><?php $weight = poxy_meta('_poxy_product_weight'); ?><?php $pole_length_in = poxy_meta('_poxy_product_pole_length_in'); ?><?php $pole_length_cm = poxy_meta('_poxy_product_pole_length_cm'); ?><?php $fits = poxy_meta('_poxy_product_fits'); ?><?php $voltage = poxy_meta('_poxy_product_voltage'); ?><?php $max_wattage = poxy_meta('_poxy_product_max_wattage'); ?><?php $lights_mounts = poxy_meta('_poxy_product_lights_mounts'); ?><?php $rating = poxy_meta('_poxy_product_rating'); ?><?php $max_wattage = poxy_meta('_poxy_product_max_wattage'); ?><?php if($i == 1) : ?><section class="hc hd he"><div class="sw"><div class="cw"><div class="pox mb0"><div class="wrap"><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Model</div></div><div class="poxya12a_118 poxyb38b_118 poxyc38c_118"><div class="delta">Description</div></div><div class="qoxy"><div class="wrap"><?php if ($size) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Size</div></div><?php endif; ?><?php if ($width_in) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Width</div><div class="zeta">in/cm</div></div><?php endif; ?><?php if ($height_in) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Height</div><div class="zeta">in/cm</div></div><?php endif; ?><?php if ($diameter_in) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Diameter</div><div class="zeta">(in/cm)</div></div><?php endif; ?><?php if ($depth_in) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Depth</div><div class="zeta">in/cm</div></div><?php endif; ?><?php if ($weight) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Weight</div><div class="zeta">lbs</div></div><?php endif; ?><?php if ($lights_mounts) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Light Mounts</div></div><?php endif; ?><?php if ($voltage) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Voltage</div><div class="zeta"></div></div><?php endif; ?><?php if ($rating) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Rating</div><div class="zeta">(wattage)</div></div><?php endif; ?><?php if ($max_wattage) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Wattage</div><div class="zeta">(MAX)</div></div><?php endif; ?><?php if ($pole_length_in) : ?><div class="poxya112a_118 poxyb112b_118 poxyc112c_118"><div class="delta">Pole Length</div><div class="zeta">(in/cm)</div></div><?php endif; ?></div></div></div></div></div></div></section><?php endif; ?><?php $i = 2; ?><section class="clear txa-2 txb-1"><div class="sw"><div class="cw"><div class="pox mb0"><?php poxy_edit(); ?><div class="wrap"><div class="poxa112a_112 poxb112b_112 poxc14c_14 poxd12d_12 poxe12e_12 mt4 mb4 tx-c"><figure style="<?php echo $image; ?>" class="poxya112a_112 poxyb112b_112 poxyc14c_14 poxyd12d_12 poxye12e_12 bg-contain"><img src="<?php echo $image_url; ?>" class="paxy fill"/></figure></div><div class="mb4 poxa38 poxb38 poxyc12c_p11 poxyd12d_p11 poxye12e_p12"><a href="<?php bloginfo("url"); ?>/product/<?php echo $slug; ?>"><h3 class="mt4"><span class="mr2">sku:</span><?php echo $title; ?></h3></a><p class="he"><?php if ($description) : ?><?php echo $description; ?><?php else : ?><?php echo get_the_excerpt(); ?><?php endif; ?></p><a href="<?php //echo $button_url; ?>" rel="bookmark" class="poxy mt1"><button class="p2">Add to Cart</button></a></div><div class="qoxya qoxyb poxyc14 qoxyd12 qoxye12"><div class="wrap"><?php if ($size) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p class="fill"><strong class="mr2 ha hb">Size:</strong><?php echo $size; ?></p></div><?php endif; ?><?php if ($width_in) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Width:</strong><?php echo $width_in . ' / ' . $width_cm; ?></p></div><?php endif; ?><?php if ($height_in) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Height:</strong><?php echo $height_in . ' / ' . $height_cm; ?></p></div><?php endif; ?><?php if ($diameter_in) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Diameter:</strong><?php echo $diameter_in . ' / ' . $diameter_cm; ?></p></div><?php endif; ?><?php if ($depth_in) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Depth:</strong><?php echo $depth_in . ' / ' . $depth_cm; ?></p></div><?php endif; ?><?php if ($weight) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Weight:</strong><?php echo $weight; ?></p></div><?php endif; ?><?php if ($lights_mounts) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Light Mounts:</strong><?php echo $lights_mounts; ?></p></div><?php endif; ?><?php if ($voltage) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Voltage:</strong><?php echo $voltage; ?></p></div><?php endif; ?><?php if ($rating) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Rating:</strong><?php echo $rating; ?></p></div><?php endif; ?><?php if ($max_wattage) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Max Wattage:</strong><?php echo $max_wattage; ?></p></div><?php endif; ?><?php if ($pole_length_in) : ?><div class="mb4 poxya112a_118 poxyb112b_118 poxyc14c_116"><p><strong class="mr2 ha hb">Pole Length:</strong><?php echo $pole_length_in . ' / ' . $pole_length_cm; ?></p></div><?php endif; ?></div></div><p class="poxy mt0 ha hb hc hd"><?php if ($description) : ?><?php echo $description; ?><?php else : ?><?php echo get_the_excerpt(); ?><?php endif; ?></p></div></div></div></div></section><?php endwhile; ?><?php wp_reset_query(); ?><?php endif; ?>