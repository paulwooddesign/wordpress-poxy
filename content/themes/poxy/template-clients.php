<?php global $post;
$id = get_the_ID();
$description = get_post_meta($id, "_poxy_description", true);

$args = array(
 'posts_per_page' => 8,
 'orderby' => 'menu_order',
 'order'	 => 'ASC',
 'meta_key' => '_poxy_client_featured',
 'post_type' => array('client')
);

$sections = new WP_Query( $args );
 ?><section class="___a14a_14b14b_14c13c_13d13d_13e12e_12 hole"><div class="sw"><div class="cw"><div class="qoxy a11a_14 b11b_14 poxc11 poxd11 poxe11 rel"><h2 class="fs___8 light mb4 title txt-0">Work</h2><?php if($description) : ?><div class="b14 description tx-2 fs___3 lh___4"><?php echo $description ?></div><?php endif; ?></div></div><div class="cw thumbs"><?php while ($sections->have_posts()) : $sections->the_post(); ?><?php $link = get_the_permalink(); ?><?php $title = get_the_title(); ?><?php $image_url = get_poxy_featured('full'); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><?php $color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0'; ?><?php $color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0'; ?><?php $color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0'; ?><?php $background_color = 'background-color: rgba('.$color_red.','.$color_green.','.$color_blue.',.6)'; ?><?php $background_color_white = 'background-color: rgba(242,242,242,1)'; ?><figure class="outer-bevel"><a href="<?php echo $link; ?>" rel="bookmark"><div class="inside-bevel oxy"></div><div class="outer-bevel oxy"></div><span style="<?php echo $background_color; ?>" class="accent-border oxy fill-95"></span><span class="highlight-border oxy br2 fill-95"></span><div class="thumb oxy"></div><span style="<?php echo $image; ?>" class="op___50 z3 invert icon oxy a18a_18b16b_16c16c_16d14d_14e14e_14 oxy bg-contain bgp-cc"></span></a></figure><?php endwhile; ?><?php wp_reset_query(); ?></div></div></section><?php $args = array(
 'orderby' => 'menu_order',
 'order'	 => 'ASC',
 'posts_per_page' => 99,
 'meta_key' => '_poxy_client_featured',
 'meta_compare' =>	 'NOT EXISTS',
 'post_type' => array('client')
);

$sections = new WP_Query( $args );
 ?><section class="___a16a_16b16b_16c14c_14d14d_14e14e_14 hole"><div class="sw"><div class="cw thumbs"><?php while ($sections->have_posts()) : $sections->the_post(); ?><?php $link = get_the_permalink(); ?><?php $title = get_the_title(); ?><?php $image_url = get_poxy_featured('full'); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><?php $color_red = get_post_meta($post->ID, "_poxy_client_color_red", true) ? get_post_meta($post->ID, "_poxy_client_color_red", true) : '0'; ?><?php $color_green = get_post_meta($post->ID, "_poxy_client_color_green", true) ? get_post_meta($post->ID, "_poxy_client_color_green", true) : '0'; ?><?php $color_blue = get_post_meta($post->ID, "_poxy_client_color_blue", true) ? get_post_meta($post->ID, "_poxy_client_color_blue", true) : '0'; ?><?php $background_color = 'background-color: rgba(255,255,255,.9)'; ?><figure class="br2"><div><a href="<?php echo $link; ?>" rel="bookmark"><span class="oxy inside-bevel br2"></span><span style="<?php echo $background_color; ?>" class="accent-border oxy br2 fill-95"></span><span class="highlight-border oxy br2 fill-95"></span><span style="<?php echo $background_color_white; ?>" class="thumb oxy ofh br2 bg-contain bgp-cc"></span><span style="<?php echo $image; ?>" class="op___50 z3 invert icon _oxya112a_112 _oxyb18b_18 _oxyc16c_16 _oxyd14d_14 _oxye14e_14 oxy ofh bg-contain bgp-cc"></span><div class="shadow oxy shadow ofh br2"></div></a></div></figure><?php endwhile; ?><?php wp_reset_query(); ?></div></div></section>