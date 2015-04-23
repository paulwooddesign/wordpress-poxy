<?php /**
 *
 * Chimera template for displaying About Sections
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
 
$image = get_poxy_thumb();
if ($image) {
  $image = 'background-image: url('. $image. ')';
} else {
  $image = 'background-image: url(http://placehold.it/800x400)';
}

$sub_title = get_post_meta($post->ID, "_poxy_vip_sub_head", true);
$title = get_the_title();
$id = get_the_ID();
 ?><figure ng-class="{ fadeOut : waypoint<?php echo $id; ?>s.flags.on, fadeIn : waypoint<?php echo $id; ?>s.flags.off }" class="rel poxya14a_38 poxyb14b_38 poxyc12c_14 poxyd12d_34 poxye12e_34"><?php poxy_edit(); ?><div zum-waypoint="waypoint<?php echo $id; ?>s" up="flags.on" down="flags.off" offset="95%"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="gray-scale"><figure style="<?php echo $image; ?>" class="rel image poxya14a_14 poxyb14b_14 poxyc14c_14 poxyd12d_12 poxye12e_12 bgp-cc bgs-cover"></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc12c_12 11dpoxd_11 11epoxe_11"><div class="m1-a m1-b m1-c m1-d m2-e"><h3 class="txa-5 txb-3 txc-3 txd-4 txe-1"><?php echo $title; ?></h3><?php if ($sub_title) : ?><p class="txa-2 mt2-a txb-2 mt2-b txc-2 mt2-c txd-1 mt1-d txe-1 mt2-e"><?php echo $sub_title; ?></p><?php endif; ?></div></div></a></div></figure>