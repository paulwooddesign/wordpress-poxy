<?php global $wp_query;
$term_id = $wp_query->queried_object->term_id;
$tax_meta = get_option( "taxonomy_term_$term_id" );


$title = $wp_query->queried_object->name;
$description = $wp_query->queried_object->description ? $wp_query->queried_object->description : 'Description: ';
$button_url = false;

$image = poxy_tax_image($term_id);
$image = 'background-image: url('. $image. ')';

//- $copywrite_name = $tax_meta['copywrite_name'];
//- $copywrite_url = $tax_meta['copywrite_url'];

$sub_title = isset($tax_meta['sub_title']) ? isset($tax_meta['sub_title']) : 'Sub Title: ';
 ?><?php if(isset($tax_meta['cat_color_red']) && isset($tax_meta['cat_color_green']) && isset($tax_meta['cat_color_blue'])) : ?><?php $red = $tax_meta['cat_color_red']; ?><?php $green = $tax_meta['cat_color_green']; ?><?php $blue = $tax_meta['cat_color_blue']; ?><?php $background_color = 'background-color: rgba('.$red.','.$green.','.$blue.', 1)'; ?><?php else : ?><?php $background_color = 'background-color: rgba(0,0,0,1)'; ?><?php endif; ?><section class="white-shadow tx-c"><div class="sw"><div class="cw pt1 pb1 a_14 b_14 c_14 thumbs"><figure class="a14a_14b14b_14c14c_14d14d_14e12e_12 br2"><span class="oxy inside-bevel br2 z1"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span style="<?php echo $background_color; ?>" class="highlight-border oxy br2 fill-95"></span><span class="thumb oxy ofh br2 bg-contain bgp-cc"><span style="<?php echo $image; ?>" class="icon _oxya18a_18 _oxyb16b_16 oxy ofh bg-contain bgp-cc"></span></span><div class="shadow oxy shadow ofh br2"></div><div class="title txa-2 txb-2 tx-c oxy6 ap100 bp100 cp100 dp100 cp100 z4 mb1"><?php echo $title; ?></div></figure><div class="rel poxya12a_pox poxyb12b_pox poxyc12c_pox poxyd11d_pox poxye11e_pox"><h1 class="bold txa-8 txb-8 txc-10 txd-10"><?php echo $title; ?></h1><div class="sub-head txa-3 mb1 mt2 wp2"><?php echo $sub_title ?></div><div class="description txa-3 mb1 mt2 wp2"><?php echo $description ?></div><div class="description txa-3 mb1 mt2 wp2"></div></div></div></div><?php $next = get_permalink(get_adjacent_post(false,'',false)); ?><?php $prev = get_permalink(get_adjacent_post(false,'',true)); ?><div class="paxy"><?php if ($prev != get_permalink()) : ?><a style="opacity:1;" href="<?php echo $prev; ?>" class="flex-next">Previous</a><?php else : ?><a style="opacity:1;" href="<?php echo poxy_get_first_post_url($post_type); ?>" class="flex-next">Previous</a><?php endif; ?></div><div class="qaxy"><?php if ($next != get_permalink()) : ?><a style="opacity:1;" href="<?php echo $next; ?>" class="flex-prev">Next</a><?php else : ?><a style="opacity:1;" href="<?php echo poxy_get_last_post_url($post_type); ?>" class="flex-prev">"
Next</a><?php endif; ?></div></section><?php poxy_get_children(1); ?>