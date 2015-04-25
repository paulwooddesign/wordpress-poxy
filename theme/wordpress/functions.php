<?php
////////////////////////////////////////////
// Options Framework
////////////////////////////////////////////
// Load main options panel file
if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

// Load Mr MetaBox
if(!class_exists('mrMetaBox')) {
    define('MRMETABOX_URL', TEMPLATEPATH . '/admin/mr-meta-box/');
    require_once(MRMETABOX_URL . 'mr-meta-box.php');
}

//require_once("admin/Tax-meta-class/Tax-meta-class.php");

// Multiple Featured Images
require_once ('admin/multiple_featured_images.php');

// Load Poxy Functions
require_once('poxy-functions.php'); // Get Pfunks
require_once('mixin-header.php'); // Get Pfunks
require_once('poxy-section-function.php'); // Get Pfunks
require_once('poxy-thumbs.php'); // Get Pfunks


// Load Core
require_once('admin/_CORE/bones.php'); // Clean up code output
require_once('admin/_CORE/admin.php'); // Dashboard admin stuff
require_once('admin/_CORE/menus.php'); // Menus
require_once('admin/_CORE/images.php'); // Images
// require_once('admin/_CORE/header.php'); // Head scripts
//require_once('admin/meta-boxes.php'); // Images



////////////////////////////////////////////
// Load Theme Core
////////////////////////////////////////////
require_once('admin/short-codes.php');
//require_once('admin/custom-post-types.php');
require_once('admin/pagination.php');
// require_once('admin/plugins/breadcrumbs.php');
// require_once('admin/plugins/product_ajax_loader.php');
// require_once('admin/woocommerce_filters.php');



// Load Custom Post Type Custom Meta Classes
require_once('admin/Tax-meta-class/Tax-meta-class.php');

require_once('admin/post-types/post-type-settings.php');
require_once('admin/post-types/post-type-classes.php');
require_once('admin/post-types/post-type-projects.php');
require_once('admin/post-types/post-type-links.php');
// require_once('admin/plugins/post-type-slideshow.php');

// require_once('admin/plugins/post-type-faq.php');


// Common Meta Boxes
require_once('admin/plugins/repeatable_fields.php');
require_once('admin/post-types/page_meta.php');


// Widgets
require_once ('admin/widgets.php');





////////////////////////////////////////////
// Load Scripts
////////////////////////////////////////////
// add_action('wp_enqueue_scripts', 'poxy_load_scripts');

function poxy_load_scripts() {
	// wp_enqueue_script('jquery');
    // wp_deregister_script('jquery');
    // wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, '1.9.1');
    // wp_register_script('jquery', '//code.jquery.com/jquery-2.0.0.min.js', false, '2.0.0');
    // wp_enqueue_script('poxy_js', get_bloginfo('stylesheet_directory').'/assets/scripts-ck.js', array('jquery'), '1.0', true);
		wp_localize_script( 'theme_trust_js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

// Speed Ring Finder
// require_once('project-loader.php');


////////////////////////////////////////////
// Load Footer Scripts Scripts
////////////////////////////////////////////

//add_action('wp_footer','poxy_footer');
function poxy_footer() {
    wp_reset_query();
    global $wp_query;
    global $post;

     if (!is_page('home')) return;
    include(TEMPLATEPATH . '/assets/js/php/slideshow.php');
}




////////////////////////////////////////////
// Show Future Posts
////////////////////////////////////////////
add_filter('the_posts', 'show_all_future_posts');

function show_all_future_posts($posts)
{
   global $wp_query, $wpdb;

   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }

   return $posts;
}


////////////////////////////////////////////
// POXY Functions
////////////////////////////////////////////
function poxy_meta($meta_value){
  global $post;
  $meta_value = get_post_meta($post->ID, $meta_value, true);
  if($meta_value != ''){
    return $meta_value;
    }else{
    return false;
  }
}

function get_poxy_featured_inside($image_id, $size) {
	global $post;
	// $image_id = get_post_thumbnail_id();
	if ($image_id) {
		$image_url = wp_get_attachment_image_src($image_id, $size, false);
		$image_url = $image_url[0];
	} else {
		$image_url = false;
	}
	return $image_url;
}


function get_poxy_featured($size) {
	global $post;
	$image_id = get_post_thumbnail_id();
	if ($image_id) {
		$image_url = wp_get_attachment_image_src($image_id, $size, false);
		$image_url = $image_url[0];
	} else {
		$image_url = false;
	}
	return $image_url;
}
function get_poxy_thumb_300x400() {
	global $post;
	$image_id = get_post_thumbnail_id();
	if ($image_id) {
		$image_url = wp_get_attachment_image_src($image_id, 'poxy_thumb_300x400', false);
		$image_url = $image_url[0];
	} else {
		$image_url = false;
	}
	return $image_url;
}
function get_poxy_thumb() {
	global $post;
	$image_id = get_post_thumbnail_id();
	if ($image_id) {
		$image_url = wp_get_attachment_image_src($image_id, 'poxy_square_thumb_350', false);
		$image_url = $image_url[0];
	} else {
		$image_url = false;
	}
	return $image_url;
}

function get_poxy_thumb_650() {
	global $post;
	$image_id = get_post_thumbnail_id();
	if ($image_id) {
		$image_url = wp_get_attachment_image_src($image_id, 'poxy_thumb_650x650', false);
		$image_url = $image_url[0];
	} else {
		$image_url = false;
	}
	return $image_url;
}


function poxy_slug(){
	global $post;
	$slug = get_post( $post )->post_name;
	return $slug;
}


function poxy_meta_value($meta_value){
  global $post;
  $meta_value = get_post_meta($post->ID, $meta_value, true);
  if($meta_value != ''){
    return $meta_value;
    }else{
    return "X";
  }
}


function poxy_tax_image($id, $x = 350, $y = 350, $size = 'full'){
	$taxonomy = 'project_client';
	$queried_term = get_query_var($taxonomy);

	if(is_int($id)) {
		$terms = get_terms($taxonomy, 'include='.$id  );
	} else {
		$terms = get_terms($taxonomy, 'slug='.$id  );
	}
	foreach ($terms as $term) {
	  $image = poxy_get_taxonomy_image_src( $term, $size );
	  if ( ! $image ) return poxy_placeholder($x, $y);
	  return poxy_get_taxonomy_image_url($term, 'full');
	}
	  // $image = poxy_get_taxonomy_image_src( $term, $size );
	  // if ( ! $image ) return poxy_placeholder($x, $y);
}


function poxy_get_tax_cat_image($id, $x = 350, $y = 350, $size = 'full'){
	$taxonomy = 'project_cat';
	$queried_term = get_query_var($taxonomy);

	if(is_int($id)) {
		$terms = get_terms($taxonomy, 'include='.$id  );
	} else {
		$terms = get_terms($taxonomy, 'slug='.$id  );
	}
	foreach ($terms as $term) {
		$image = poxy_get_taxonomy_image_src( $term, $size );
		if ( ! $image ) return poxy_placeholder($x, $y);
		return poxy_get_taxonomy_image_url($term, 'full');
	}
		// $image = poxy_get_taxonomy_image_src( $term, $size );
		// if ( ! $image ) return poxy_placeholder($x, $y);
}




// function poxy_tax_image($id, $taxonomy, $size = 'full', $x = 350, $y = 350 ) {
// 	$queried_term = get_query_var($taxonomy);
//
// 	if(is_int($id)) {
// 		$terms = get_terms($taxonomy, 'include='.$id  );
// 	} else {
// 		$terms = get_terms($taxonomy, 'slug='.$id  );
// 	}
//
// 	foreach ($terms as $term) {
// 		$image = poxy_get_taxonomy_image_src( $term, $size );
// 		if ( ! $image ) return poxy_placeholder($x, $y);
// 		return poxy_get_taxonomy_image_url($term, 'full');
// 	}
// 		// $image = poxy_get_taxonomy_image_src( $term, $size );
// 		// if ( ! $image ) return poxy_placeholder($x, $y);
// }

function get_poxy_banner() {
	global $post;
	$image_id = get_post_thumbnail_id();

  if ($image_id) {
    $image_url = wp_get_attachment_image_src($image_id, 'full', false);
    $image_url = $image_url[0];
  } else {
    $image_url = false;
  }
  return $image_url;
}


// Admin Edit menu Button
function poxy_edit() {
    $a = '<div class="rel">';
    $b = '</div>';
    echo $a;
    edit_post_link();
    echo $b;
    echo "\n";
}

function poxy_id(){
	global $post;
	$id = get_post( $post )->ID;
	return $id;
}

function poxy_placeholder($x = 350, $y = 350, $bg = '', $color = '') {

  if ($bg == '') {
    $bg = of_get_option('poxy_placeholder_background_color');
    $bg= ltrim ($bg,'#');
  }

  if ($color == '') {
    $color = of_get_option('poxy_placeholder_text_color');
    $color= ltrim ($color,'#');
  }

  $placeholder_image = "http://placehold.it/". $x ."x".$y."/".$bg."/".$color;
  // $placeholder_image = get_bloginfo( 'template_directory' ) . '/assets/images/core/placeholder.png';
	// $placeholder_image = get_bloginfo('template_url') . '/images/logo-blue.svg';
	$placeholder_image = "";
  return $placeholder_image;

}

function poxy_get_cat_thumb($slug) {

	$args = array(
		'category_name' => $slug,
		'posts_per_page' => 1,
		'post_type' => array('post')
	);

	$query = new WP_Query( $args );

	while ($query->have_posts()) : $query->the_post();
		$image = get_poxy_thumb();
		if ($image) {
			$image = 'background-image: url('. $image. ')';
		}
		elseif (poxy_catch_first_image()) {
			$image_url = poxy_catch_first_image();
			$image = 'background-image: url('. $image_url. ')';
		}
		else {
			// $image = 'background-image: url(http://placehold.it/800x400)';
			$image_ph = get_bloginfo('template_url') . '/images/logo-blue.svg';
			$image = 'background-image: url('.$image_ph.')';
		}
	endwhile;
	wp_reset_query();

	return $image;

}

// Auto Set First Image as Featured
function poxy_catch_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	if (isset($matches[1][0])){
		$first_img = $matches[1][0];
		if(empty($first_img)) {
			return false;
		} else {
		return $first_img;
		}
	}
}




function drfw_postID_by_url($url) {
	global $wpdb;
	$id = url_to_postid($url);
	if($id==0) {
		$fileupload_url = get_option('fileupload_url',null).'/';
		if (strpos($url,$fileupload_url)!== false) {
			$url = str_replace($fileupload_url,'',$url);
			$id = $wpdb->get_var("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '$url' AND wposts.post_type = 'attachment'");
		}
	}
	return $id;
}



// List custom post type taxonomies
function poxy_get_terms( $id = '' ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $post_taxonomies = array();
    $post_type = get_post_type( $id );
    $taxonomies = get_object_taxonomies( $post_type , 'names' );

    foreach ( $taxonomies as $taxonomy ) {
      $term_links = array();
      $terms = get_the_terms( $id, $taxonomy );

      if ( is_wp_error( $terms ) )
        return $terms;

      if ( $terms ) {
        foreach ( $terms as $term ) {
          $link = get_term_link( $term, $taxonomy );
          if ( is_wp_error( $link ) )
            return $link;
          $term_links[] = '<li class="mb4"><span><a href="'.$link.'">' . $term->name . '</a></span></li>';
        }
      }

      $term_links = apply_filters( "term_links-$taxonomy" , $term_links );
      $post_terms[$taxonomy] = $term_links;
    }
    return $post_terms;
  } else {
    return false;
  }
}

function poxy_get_terms_list( $id = '' , $echo = true ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $my_terms = poxy_get_terms( $id );
    if ( $my_terms ) {
      $my_taxonomies = array();
      foreach ( $my_terms as $taxonomy => $terms ) {
        $my_taxonomy = get_taxonomy( $taxonomy );
        if ( !empty( $terms ) ) $my_taxonomies[] = implode( $terms);
      }

      if ( !empty( $my_taxonomies ) ) {
	    $output = "";
        foreach ( $my_taxonomies as $my_taxonomy ) {
          $output .= $my_taxonomy . "\n";
        }
      }

      if ( $echo )
        echo $output;
      else
        return $output;
    } else {
      return;
    }
  } else {
    return false;
  }
}



function poxy_get_last_post_url($post_type){
    $args = array('post_type'=>$post_type, 'posts_per_page' => -1);
    $posts = get_posts($args);
    $last_id = end($posts);
    $last_post = get_permalink($last_id);

return $last_post;
}

function poxy_get_first_post_url($post_type){
    $args = array('post_type'=>$post_type, 'posts_per_page' => -1);
    $posts = get_posts($args);
    $first_id = $posts[0]->ID; // To get ID of first post in custom post type
    $first_post = get_permalink($first_id);

return $first_post;

}
////////////////////////////////////////////
// Custom Taxonomy Fields
////////////////////////////////////////////
add_action( 'pre_get_posts', 'project_posts_per_page' );
/**
 * Change Posts Per Page for Event Archive
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function project_posts_per_page( $query ) {

	if( $query->is_main_query() && !is_admin() && $query->is_tax('project_cat') ) {
		$query->set( 'posts_per_page', '200' );
	}

}

////////////////////////////////////////////
// Custom Taxonomy Fields
////////////////////////////////////////////
// A callback function to add a custom field to our "presenters" taxonomy
function presenters_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="featured"><?php _e('Featured'); ?></label>
	</th>
	<td>
		<select name="term_meta[featured_cat]" id="term_meta[featured_cat]" >
			<option selected="selected" value="
				<?php
					if ($term_meta['featured_cat']) {
					echo $term_meta['featured_cat'] ? $term_meta['featured_cat'] : '';
					} else {
						echo 'false';
					}
					?>
					">
					<?php
						if ($term_meta['featured_cat']) {
						echo $term_meta['featured_cat'] ? $term_meta['featured_cat'] : '';
						} else {
							echo 'false';
						}
						?>
			</option>
			<option value="true">True</option>
			<option value="false">false</option>
		</select>
		<br />
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="cat_color_red"><?php _e('Cat Color RED'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[cat_color_red]" id="term_meta[cat_color_red]" size="25" style="width:10%;" value="<?php if(isset($term_meta['cat_color_red'])) { echo $term_meta['cat_color_red'] ? $term_meta['cat_color_red'] : ''; } ?>"><br />
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="cat_color_green"><?php _e('Cat Color GREEN'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[cat_color_green]" id="term_meta[cat_color_green]" size="25" style="width:10%;" value="<?php if(isset($term_meta['cat_color_green'])) { echo $term_meta['cat_color_green'] ? $term_meta['cat_color_green'] : ''; } ?>"><br />
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="cat_color_blue"><?php _e('Cat Color BLUE'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[cat_color_blue]" id="term_meta[cat_color_blue]" size="25" style="width:10%;" value="<?php if(isset($term_meta['cat_color_blue'])) { echo $term_meta['cat_color_blue'] ? $term_meta['cat_color_blue'] : ''; } ?>"><br />
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="sub_title"><?php _e('sub_title'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[sub_title]" id="term_meta[sub_title]" size="25" style="width:60%;" value="<?php echo $term_meta['sub_title'] ? $term_meta['sub_title'] : ''; ?>"><br />
		<span class="description"><?php _e('sub_title'); ?></span>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="image_position"><?php _e('Child Image Positions'); ?></label>
	</th>
	<td>
		<select name="term_meta[image_position]" id="term_meta[image_position]" >
			<option selected="selected" value="<?php echo $term_meta['image_position'] ? $term_meta['image_position'] : ''; ?>"><?php echo $term_meta['image_position'] ? $term_meta['image_position'] : ''; ?></option>
			<option value="cc">Center</option>
			<option value="rc">Right</option>
			<option value="lc">Left</option>
			<option value="ct">Top</option>
			<option value="cb">Bottm</option>
			<option value="rt">Top Right</option>
			<option value="lt">Top Left</option>
			<option value="rb">Bottom Right</option>
			<option value="lb">Bottom Left</option>
		</select>
		<br />
		<span class="description"><?php _e('Child background position. Example: ct = Center Top'); ?></span>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="bgs"><?php _e('Child Image Sizes.'); ?></label>
	</th>
	<td>
		<select name="term_meta[bgs]" id="term_meta[bgs]" >
		  <option selected="selected" value="<?php echo $term_meta['bgs'] ? $term_meta['bgs'] : ''; ?>"><?php echo $term_meta['bgs'] ? $term_meta['bgs'] : ''; ?></option>
		 	<option value="cover">cover</option>
			<option value="contain">contain</option>
			<option value="100">100</option>
			<option value="50">50</option>
		</select>
		<br />
		<span class="description"><?php _e('children background CSS size.'); ?></span>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="featured_image_position"><?php _e('Featured Image Position'); ?></label>
	</th>
	<td>
		<select name="term_meta[featured_image_position]" id="term_meta[featured_image_position]" >
			<option selected="selected" value="<?php echo $term_meta['featured_image_position'] ? $term_meta['featured_image_position'] : ''; ?>"><?php echo $term_meta['featured_image_position'] ? $term_meta['featured_image_position'] : ''; ?></option>
			<option value="cc">Center</option>
			<option value="rc">Right</option>
			<option value="lc">Left</option>
			<option value="ct">Top</option>
			<option value="cb">Bottm</option>
			<option value="rt">Top Right</option>
			<option value="lt">Top Left</option>
			<option value="rb">Bottom Right</option>
			<option value="lb">Bottom Left</option>
		</select>
		<br />
		<span class="description"><?php _e('Featured/Banner Image position.'); ?></span>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="featured_image_bgs"><?php _e('Featured Image Size'); ?></label>
	</th>
	<td>
		<select name="term_meta[featured_image_bgs]" id="term_meta[featured_image_bgs]" >
			<option selected="selected" value="<?php echo $term_meta['featured_image_bgs'] ? $term_meta['featured_image_bgs'] : ''; ?>"><?php echo $term_meta['featured_image_bgs'] ? $term_meta['featured_image_bgs'] : ''; ?></option>
			<option value="cover">cover</option>
			<option value="contain">contain</option>
			<option value="100">100</option>
			<option value="50">50</option>
		</select>
		<br />
		<span class="description"><?php _e('Banner/Featured image CSS size.'); ?></span>
	</td>
</tr>
<?php
}

// A callback function to save our extra taxonomy field(s)
function save_taxonomy_custom_fields( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_term_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
						foreach ( $cat_keys as $key ){
						if ( isset( $_POST['term_meta'][$key] ) ){
								$term_meta[$key] = $_POST['term_meta'][$key];
						}
				}
				//save the option array
				update_option( "taxonomy_term_$t_id", $term_meta );
		}
}

// Add the fields to the "presenters" taxonomy, using our callback function
add_action( 'project_cat_edit_form_fields', 'presenters_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_project_cat', 'save_taxonomy_custom_fields', 10, 2 );


// Add the fields to the "presenters" taxonomy, using our callback function
add_action( 'project_studio_edit_form_fields', 'presenters_taxonomy_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_project_studio', 'save_taxonomy_custom_fields', 10, 2 );


add_action( 'project_client_edit_form_fields', 'presenters_taxonomy_custom_fields', 10, 2 );

add_action( 'edited_project_client', 'save_taxonomy_custom_fields', 10, 2 );
