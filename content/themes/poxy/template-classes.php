<?php get_template_part( 'part-header' );


$taxonomy = 'class_cat';
$queried_term = get_query_var($taxonomy);

$args = array(
  'orderby'       =>  'term_order',
  'hide_empty'    => false,
  'parent'        => 0
);

$cats = get_terms($taxonomy, $args);
 ?><?php foreach ($cats as $cat) : ?><?php $link = get_term_link( $cat->slug, 'class_cat' ); ?><?php $title = $cat->name; ?><?php $description = $cat->description; ?><?php $slug = $cat->slug; ?><?php $term_id = $cat->slug; ?><?php $image = poxy_tax_image($term_id); ?><?php $image = 'background-image: url('. $image. ')'; ?><section><div class="sw"><div class="cw"><div class="poxy a14b14"><h1 class="bold fs___6"><?php echo $cat->name; ?></h1><p class="fs___2 poxy a15b15"><?php echo $cat->description; ?></p></div><div class="poxy a34b34"><div class="wrap"><?php $taxonomy = 'class_cat';
$queried_term = get_query_var($taxonomy);

$args = array(
  'hide_empty'    => false,
  'parent'        => $cat->term_id
);

$cats = get_terms($taxonomy, $args);
 ?><?php foreach ($cats as $cat) : ?><?php switch ($cat->name) : case "Fixed" : ?><div class="poxy a14b14"><h2 class="poxy p100 fs___5 bold mb2"><?php echo $cat->name; ?></h2><?php $args = array( 'post_type' => 'class',  'posts_per_page' => 99, 'class_cat' => $cat->slug ); ?><?php $loop = new WP_Query( $args ); ?><?php while ( $loop->have_posts() ) : $loop->the_post(); ?><?php global $post; ?><?php $id = $post->ID; ?><?php $example = get_post_meta($id, 'poxy_example', true); ?><?php $example = $example ? $example : false; ?><?php if ($example) : ?><div class="poxy p100 fs___4"><?php echo $example; ?></div><?php endif; ?><?php endwhile; ?><?php wp_reset_query(); ?></div><div class="poxy rel a12a_14b12b_14 bgc__dark__10"><div class="oxy">Hover to show</div></div><?php break; ?><?php default; ?><div class="poxy a14b14"><h2 class="poxy p100 fs___5 bold"><?php echo $cat->name; ?></h2><p class="fs___3 poxy mb2"><?php echo $cat->description; ?></p><?php $args = array( 'post_type' => 'class',  'posts_per_page' => 99, 'class_cat' => $cat->slug ); ?><?php $loop = new WP_Query( $args ); ?><?php while ( $loop->have_posts() ) : $loop->the_post(); ?><?php global $post; ?><?php $id = $post->ID; ?><?php $example = get_post_meta($id, 'poxy_example', true); ?><?php $example = $example ? $example : false; ?><?php $important = get_post_meta($id, 'poxy_important', true); ?><?php $important = $important ? $important : false; ?><?php $options = get_post_meta($id, 'poxy_options', true); ?><?php $options = $options ? $options : false; ?><?php $var_type = get_post_meta($id, 'poxy_var_type', true); ?><?php $var_type = $var_type ? $var_type : false; ?><?php $default_val = get_post_meta($id, 'poxy_default_val', true); ?><?php $default_val = $default_val ? $default_val : false; ?><?php if ($example) : ?><div class="poxy p100 fs___4"><span>.</span><?php echo $example; ?></div><?php endif; ?><?php endwhile; ?><?php wp_reset_query(); ?></div><div class="poxy rel a13a_14b12b_14 bgc__dark__10"><?php $args = array( 'post_type' => 'class',  'posts_per_page' => 99, 'class_cat' => $cat->slug ); ?><?php $loop = new WP_Query( $args ); ?><?php while ( $loop->have_posts() ) : $loop->the_post(); ?><?php global $post; ?><?php $id = $post->ID; ?><?php $example = get_post_meta($id, 'poxy_example', true); ?><?php $example = $example ? $example : false; ?><?php $important = get_post_meta($id, 'poxy_important', true); ?><?php $important = $important ? $important : false; ?><?php $options = get_post_meta($id, 'poxy_options', true); ?><?php $options = $options ? $options : false; ?><?php $var_type = get_post_meta($id, 'poxy_var_type', true); ?><?php $var_type = $var_type ? $var_type : false; ?><?php $default_val = get_post_meta($id, 'poxy_default_val', true); ?><?php $default_val = $default_val ? $default_val : false; ?><?php $title = get_the_title(); ?><div class="<?php echo $title; ?> a18a_18b18b_18 bgc__accent z10"><div class="rel a18a_18b18b_18"><div class="oxy"><span>.</span><?php the_title(); ?></div></div></div><?php endwhile; ?><?php wp_reset_query(); ?></div><?php break; ?><?php endswitch; ?><div class="poxy p100 mb1"><div class="divider bgc__dark__10 poxy a34b34"></div></div><?php endforeach; ?></div></div></div></div></section><?php endforeach; ?>