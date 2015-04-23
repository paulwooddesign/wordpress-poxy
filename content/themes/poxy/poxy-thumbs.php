<?php function poxy_3d_thumb($class, $title, $href, $image) {
 ?><figure class="<?php echo $class; ?> br2 rel"><figcaption class="ba-xy"><div class="m4"><?php echo $title; ?></div></figcaption><a href="<?php echo $href; ?>" class="gray-scale2"><span class="oxy inside-bevel br2"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bg-cover bgp-ct"></span><div class="shadow oxy shadow ofh br2"></div></a></figure><?php }






 ?><?php function poxy_img($class, $title, $href, $image) {
 ?><figure style="<?php echo $image; ?>" class="<?php echo $class; ?> rel bgs-contain bgp-ct"><img style="opacity: 0" src="<?php echo $href; ?>"/></figure><?php }







 ?><?php function poxy_flat_thumb($class, $title, $href, $image) {
 ?><figure style="<?php echo $image; ?>" class="<?php echo $class; ?> shadow-r45-dark-small rel bgs-100 bgp-ct"><a href="<?php echo $href; ?>" class="gray-scale2"></a></figure><?php }

 ?><?php function poxy_section_info($title, $description) {
  $description = $description ? $description : 'We are an Advertising and Production Agency that uses excellence to forge bonds with customers and propel businesses.'; ?><h3 class="title mb2"><?php echo $title; ?></h3><p class="description txa-2 txb-2"><?php echo $description; ?></p><?php }


 ?><?php function poxy_section_header($title) { ?><section><div class="sw"></div></section><section class="hide"><div class="sw"><div class="cw"><h3 class="title mt1"><?php echo $title; ?></h3></div></div></section><?php }


 ?><?php function poxy_section_description() { ?><section><div class="sw"><div class="cw"><div class="poxa12 poxb12 poxc12 poxd12 poxe11"><div class="wrap"><div class="poxa14 poxb14 poxc12"><p>Fig. 1</p><p>Duis ut fringilla lacus, eget aliquet lorem. Ut odio sapien, convallis in nulla in, vehicula mattis arcu. Integer ac erat non diam facilisis viverra. Nulla risus leo, auctor sit amet volutpat vitae, dictum id ipsum.</p></div><div class="poxa14 poxb14 poxc12"><p>Fig. 2</p><p>Duis ut fringilla lacus, eget aliquet lorem. Ut odio sapien, convallis in nulla in, vehicula mattis arcu. Integer ac erat non diam facilisis viverra. Nulla risus leo, auctor sit amet volutpat vitae, dictum id ipsum.</p></div></div></div><div class="poxa12 poxb12 poxc12 poxd12 poxe11"><div class="wrap"><div class="poxa14 poxb14 poxc12"><p>Fig. 3</p><p>Duis ut fringilla lacus, eget aliquet lorem. Ut odio sapien, convallis in nulla in, vehicula mattis arcu. Integer ac erat non diam facilisis viverra. Nulla risus leo, auctor sit amet volutpat vitae, dictum id ipsum.</p></div><div class="poxa14 poxb14 poxc12"><p>Fig. 4</p><p>Duis ut fringilla lacus, eget aliquet lorem. Ut odio sapien, convallis in nulla in, vehicula mattis arcu. Integer ac erat non diam facilisis viverra. Nulla risus leo, auctor sit amet volutpat vitae, dictum id ipsum.</p></div></div></div></div></div></section><?php } ?>