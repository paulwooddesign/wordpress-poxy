<?php // Get the custom fields based on the $presenter term ID


$term_id = $wp_query->queried_object->term_id;
$image = poxy_tax_image($term_id);
$image = 'background-image: url('. $image. ')';
$title = $wp_query->queried_object->name;
$slug = $wp_query->queried_object->slug;
$sub_title = $wp_query->queried_object->name;
$copywrite_name = $wp_query->queried_object->term_id;
$copywrite_url = $wp_query->queried_object->term_id;
$bgp = $wp_query->queried_object->term_id;
$bgs = $wp_query->queried_object->term_id;
$description = $wp_query->queried_object->description;
$button_url = false;





$args = array(
  'orderby'       => 'name',
  'hide_empty'    => true,
  'fields'        => 'all',
  'parent'         => $term_id,
  'hierarchical'  => true,
  'child_of'      => 0,
  'pad_counts'    => false,
  'cache_domain'  => 'core'
);

$taxonomy_name = $wp_query->tax_query->queries[0]['taxonomy'];
$termchildren = get_terms( $taxonomy_name, $args );

//- $image_position = 'cc';
//- if (isset($tax_meta['image_position']) {
//-   $image_position = $tax_meta['image_position'];
//- }

$tax_meta = get_option( "taxonomy_term_$term_id" );
$copywrite_name = $tax_meta['copywrite_name'];
$copywrite_url = $tax_meta['copywrite_url'];


$bgs = $tax_meta['bgs'];


$child_term = get_term( $term_id, $taxonomy_name );
$parent_term = get_term( $child_term->parent, $taxonomy_name );
$parent_name = $parent_term->name;
$parent_slug = $parent_term->slug;



 ?><?php poxy_get_tax_header(); ?><?php if ($termchildren) : ?><?php poxy_get_tax_header(); ?><?php if ($slug == 'speed-rings') : ?><?php get_template_part( 'part-speedring-finder'); ?><?php poxy_get_parents($termchildren, 1, $bgp, $bgs); ?><?php elseif ($slug == 'film-video') : ?><?php get_template_part( 'part-breadcrumbs' ); ?><?php poxy_get_parents($termchildren, 1, $bgp, $bgs); ?><?php else : ?><?php get_template_part( 'part-breadcrumbs' ); ?><?php poxy_get_parents($termchildren, 1, $bgp, $bgs); ?><?php endif; ?><?php else : ?><?php if ($parent_slug == 'speed-rings') : ?><?php get_template_part( 'part-breadcrumbs' ); ?><?php get_template_part( 'part-speedring-finder'); ?><?php $parent_cat = "speed-rings"; ?><?php $i = "2"; ?><?php else : ?><?php get_template_part( 'part-breadcrumbs' ); ?><?php $parent_cat = ""; ?><?php $i = "1"; ?><?php endif; ?><?php poxy_get_children($i); ?><?php endif; ?>