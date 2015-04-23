<?php $taxonomy = 'category';
$queried_term = get_query_var($taxonomy);

$args = array(
  'orderby'       => 'name',
  'order'         => 'ASC',
  'hierarchical'  => true,
  'child_of'      => 0
);

$cats = get_terms($taxonomy, $args);

 ?><section class="featured-pages"><div class="sw"><div class="cw"><?php  ?><?php foreach ($cats as $cat) : ?><?php $link = get_term_link( $cat->slug, 'category' ); ?><?php $title = $cat->name; ?><?php $slug = $cat->slug; ?><?php $image = poxy_get_cat_thumb($slug); ?><figure class="rel poxya14a_18 poxyb14b_18 poxyc14c_18 poxyd12d_14 poxye12e_14"><a href="<?php echo $link; ?>" class="tx-c"><figure style="<?php echo $image; ?>" class="rel image poxya14a_18 poxyb14b_18 poxyc14c_18 poxyd12d_14 poxye12e_14 bgp-lc bgs-100"><div class="rel _oxap11a_p11 white bold _oxbp11b_p11 _oxcp11c_p11 _oxdp11d_p11 _oxep11e_p11"><h2 title="<?php echo $title; ?>" class="txa-8 txb-7 txc-4 txd-6 txe-5"><?php echo $title; ?></h2></div></figure></a></figure><?php endforeach; ?></div></div></section>