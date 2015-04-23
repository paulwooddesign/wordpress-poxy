<?php /**
 *
 * Chimera template for displaying About Sections
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
$image = get_poxy_banner();
if ($image) {
  $image = 'background-image: url('. $image. ')';
} elseif (poxy_catch_first_image()) {
    $image_url = poxy_catch_first_image();
} else {
  $image = 'background-image: url(http://placehold.it/400x400)';
}

$title = get_the_title();
$sub_title = 'Sub Title';
$date = 'date';
 ?><figure class="rel poxya34a_14 poxyb34b_38 poxyc11c_38 poxyd11d_38 poxye11e_11"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><figure style="<?php echo $image; ?>" class="rel image qoxya12a_14 qoxyb12b_38 qoxyc58c_38 qoxyd12d_38 poxye11e_12 bgp-cc bgs-cover"></figure><div class="rel poxya14a_14 poxyb14b_38 poxyc38c_38 poxyd12d_38 poxye11e_12"><div class="m1-a m1-b m1-c m1-d m2-e"><p class="txa-1 txb-1 txc-1 txd-1 txe-1"><?php echo $date; ?></p><h3 class="txa-6 mt2-a txb-4 mt2-b txc-4 mt2-c txd-4 mt2-d txe-3 mt2-e"><?php echo $title; ?></h3><p><?php echo $sub_title; ?></p></div></div></a></figure>