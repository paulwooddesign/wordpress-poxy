<?php global $post;
$id = get_the_ID();
$description = get_post_meta($id, "_poxy_description", true); ?><section><div class="sw"><div class="cw b_18 c_16"><h1 class="fs___6 mb4 title txt-0"><?php the_title(); ?></h1><?php if($description) : ?><p class="description"><?php echo $description ?></p><?php endif; ?></div></div></section>