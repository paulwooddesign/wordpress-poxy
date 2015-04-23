<?php $image_url = get_poxy_thumb();
$image = $image_url ? 'background-image: url('. $image_url. ')' : false;
$sub_title = get_post_meta($post->ID, "_poxy_vip_sub_head", true);
$title = get_the_title();
$id = get_the_ID();
$link = '#';
$background_color = 'background-color: rgba(150,150,150, .9)';
 ?><figure class="a14a_14b14b_14c14c_14d14d_14e12e_12 br2"><img src="<?php echo $image_url; ?>" class="op0"/><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span style="<?php echo $background_color; ?>" class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $image; ?>" class="thumb oxy ofh br2 bg-contain bgp-cc"></span><div class="shadow oxy shadow ofh br2"></div><div class="title txa-2 txb-2 tx-c oxy6 ap100 bp100 cp100 dp100 cp100 z4 mb1"><?php echo $title; ?></div></figure>