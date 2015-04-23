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
}
elseif (poxy_catch_first_image()) {
  $image_url = poxy_catch_first_image();
  $image = 'background-image: url('. $image_url. ')';
} else {
  $image_ph = get_bloginfo('template_url') . '/images/logo-blue.svg';
  $image = 'background-image: url('.$image_ph.')';
}

$title = get_the_title();
 ?><?php $city = poxy_meta('_poxy_event_city'); ?><?php $start_date = poxy_meta('_poxy_event_start_date'); ?><?php $end_date = poxy_meta('_poxy_event_end_date'); ?><figure class="rel poxya12a_14 poxyb12b_14 poxyc12c_14 poxyd11d_38 poxye11e_58"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><figure style="<?php echo $image; ?>" class="rel image poxya14a_14 poxyb14b_14 poxyc18c_14 poxyd12d_38 poxye38e_58"></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc38c_14 poxyd12d_38 poxye58e_58"><div class="m1-a m1-b m1-c m1-d m1-e"><?php if ($start_date) : ?><p class="mt0 mb2 txa-3 txb-2 txc-1 txd-1 txe-1"><?php echo $start_date; ?><?php if ($end_date && $end_date != $start_date) : ?>&nbsp;&mdash;&nbsp;<?php echo $end_date; ?><?php endif; ?></p><?php endif; ?><h3 class="mt0 txa-7 txb-6 txc-2 txd-3 txe-3"><?php echo $title; ?></h3><?php if ($city) : ?><p class="txa-3 txb-2 txc-1 txd-1 txe-1"><?php echo $city; ?></p><?php endif; ?></div></div></a></figure>