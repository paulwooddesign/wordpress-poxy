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
 } else {
   $image = 'background-image: url(http://placehold.it/800x400)';
 }
 
 $title = get_the_title();
  ?><section><div class="sw"><div class="cw"><figure style="<?php echo $image; ?>" class="rel image poxya34a_38 poxyb34b_12 poxyc12c_12 poxyd11d_12 poxye11e_12 bgp-cc bgs-cover"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="paxy fill"></a></figure><div class="rel poxya14a_14 poxyb14b_14 poxyc12c_12 11dpoxd_11 11epoxe_11"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><h3 class="txa-6 mb2-a txb-4 mb2-b txc-4 mb2-c txd-5 mb2-d txe-3 mb2-e"><?php echo $title; ?></h3></a><?php the_excerpt(); ?><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="poxy mt1"><button>Read More</button></a></div></div></div></section>