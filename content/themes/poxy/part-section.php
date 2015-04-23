<?php $image = get_poxy_banner();
if ($image) {
  $image = 'background-image: url('. $image. ')';
} else {
  $image = 'background-image: url()';
}

$title = get_the_title();
 ?><section class="shadow-right-inset"><?php poxy_edit(); ?><div class="sw"><div class="cw"><div class="poxy a18b18c18"></div><div class="poxy a25b25c34"><h3 class="mb2 fs___5"><?php echo $title; ?></h3><?php the_content(); ?></div></div></div></section>