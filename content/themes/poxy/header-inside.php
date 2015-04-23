<?php global $post;
$id = get_the_ID();
$description = get_post_meta($id, "_poxy_description", true); ?><div class="poxy a13a_25 b14 poxc11 poxd11 poxe11 rel"></div><div class="poxy a13a_25 b34 poxc11 poxd11 poxe11 rel"><h2 class="fsb__8 mb4 title txt-0"><?php the_title(); ?></h2><?php if($description) : ?><p class="description b14"><?php echo $description ?></p><?php endif; ?></div>