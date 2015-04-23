<?php global $post;
$id = get_the_ID();
$post_type = get_post_type( $id );


$title = get_the_title();
$sub_title = get_post_meta($id, "_poxy_sub_head", true);
$description = get_post_meta($id, "_poxy_description", true);
$header_layout = get_post_meta($id, "_poxy_header_layout", true);

$image_url = get_poxy_banner();
$image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url(http://placehold.it/1200x600)';


 ?><?php switch ($header_layout) : case 'auto' : ?><section class="z8 bg___svg"><div class="paxy fill bg-black"></div><div class="paxy fill shadow-r45-inset--dark bg___svg"></div><div class="sw"><div class="cw rel"><figure class="poxa11 poxb11 poxc11 poxd11 poxye11"><img src="<?php echo $image_url; ?>"/></figure></div></div></section><section class="ofh rel bgp-ct bgs-100 z8"><div class="paxy fill bg-black"></div><div class="paxy fill shadow-r45-inset--dark bg___svg"></div><div class="sw"><div class="cw"><figure style="<?php echo $image; ?>" class="shadow-r45-dark-small rel mb0 qoxya11a_12 qoxyb11b_35 poxyc11c_35 poxyd11d_58 poxye11e_58 bgp-ct bg-100"></figure></div></div></section><?php break; ?><?php case 'video' : ?><?php $video_sd = get_post_meta($id, "_poxy_video_sd", true); ?><?php $video_hd = get_post_meta($id, "_poxy_video_hd", true); ?><?php $video_cover = get_post_meta($id, "_poxy_video_cover", true); ?><section style="background-color:#222;" class="rel clear"><div class="flex-video"><?php if($video_sd): ?><video controls="controls" src="<?php echo $video_sd; ?>" type="video/mp4" id="vid"></video><?php endif; ?></div></section><section><div class="sw"><div class="cw"><div class="tx-6"><?php the_title(); ?></div></div></div></section><?php break; ?><?php default: ?><section class="z8 bg___svg"><div class="paxy fill bg-black"></div><div class="paxy fill shadow-r45-inset--dark bg___svg"></div><div class="sw"><div class="cw rel"><figure style="<?php echo $image; ?>" class="mb0 poxya11a_35 poxyb11b_35 poxyc11c_34 poxyd11d_58 poxye11e_58 bgp-ct bg-100"></figure></div></div></section><?php endswitch; ?>