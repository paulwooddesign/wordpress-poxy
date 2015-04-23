<div style="height: {{height - mainNavHeight}}px" class="poxy rel fill ofh"><div id="workScroller" style="overflow-y:hide;" class="z9 paxy fill"><div><?php $args = array(
  'posts_per_page' => 50,
  //- 'meta_key' => '_poxy_client_featured',
  'post_type' => array('client')
);

$sections = new WP_Query( $args );
 ?><div><ul class="thumbs"><?php while ($sections->have_posts()) : $sections->the_post(); ?><?php $link = get_the_permalink(); ?><?php $title = get_the_title(); ?><?php $slug = poxy_slug(); ?><?php $image_url = get_poxy_featured('full'); ?><?php $image = $image_url ? 'background-image: url('. $image_url. ')' : 'background-image: url('.get_bloginfo('template_url').'/images/placeholder-logo-white.svg)'; ?><li class="ap100a_15 bp100b_15cp100c_14d14d_14e12e_12 thumb rel z1_45 br2 bs0 m0"><button class="poxy fill"><a href="<?php echo $link; ?>" rel="bookmark"><span class="oxy inside-bevel br2"></span><span class="highlight-border oxy br2 fill-95"></span><div class="poxy ap25a_14 bp25b_14 cp25c_14"><span style="<?php echo $image; ?>" class="invert icon ofh bg-contain bgp-cc poxy m2 a16a_16 b18b_18 c16c_16"></span></div><div class="poxy ap75a_14 bp75b_14 cp75c_14 tx-l"><div class="ml1"><p class="oxy tx-2"><?php echo $title; ?></p></div></div></a></button></li><?php endwhile; ?><?php wp_reset_query(); ?></ul></div></div></div></div>