<?php
add_action('wp_enqueue_scripts', 'finder_load_scripts');

function finder_load_scripts() {
	wp_enqueue_script( 'my-ajax-request', get_bloginfo('stylesheet_directory') . '/admin/ajax/ajax.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'my-ajax-request', 'MyAjax', array(
    'ajaxurl'          => admin_url( 'admin-ajax.php' ),
    'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' ),
    )
	);
}

add_action( 'wp_ajax_nopriv_myajax-submit', 'ajax_project_load' );
add_action( 'wp_ajax_myajax-submit', 'ajax_project_load' );

function ajax_project_load() {

	$the_slug = $_POST['slug'];


	$args=array(
		'post_type' => 'project',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		// 'posts_per_page' => 10,
		'showposts' => 4,
		'project_cat' => $the_slug
	);
	$my_posts = get_posts($args);
	if( $my_posts ) :

		global $post;
		$post = $my_posts[0];

			// generate the response
			$response = json_encode( "Success" );

			// response output
			header( "Content-Type: application/json" );
		?>
		<?php the_title(); ?>

	<?php endif; ?>

<?php
		exit;
}
