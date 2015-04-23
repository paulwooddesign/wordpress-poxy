<?php

include('speed-ring-db.php');


add_action('wp_enqueue_scripts', 'finder_load_scripts');

function finder_load_scripts() {
	// embed the javascript file that makes the AJAX request
	wp_enqueue_script( 'my-ajax-request', get_bloginfo('stylesheet_directory') . '/admin/ajax/ajax.js', array( 'jquery' ), '1.0', true );

	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
	// wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'my-ajax-request', 'MyAjax', array(
    // URL to wp-admin/admin-ajax.php to process the request
    'ajaxurl'          => admin_url( 'admin-ajax.php' ),

    // generate a nonce with a unique ID "myajax-post-comment-nonce"
    // so that you can check it later when an AJAX request is sent
    'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' ),
    )
);
}







function get_brand_values($mid) {

	function getMakeByMakeIdAjax($makeId){
		global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix ."model where makeId = '" . (int)$makeId . "'";
		return $wpdb->get_results($sql);
	}

	$sHtml = "<option value='-1'>Fixture Brand Test</option>";
	$sHtml2 = "<option value='-1'>Fixture Model</option>";

	$results = getMakeByMakeIdAjax($mid);
	foreach($results as $result){
		$sHtml = $sHtml."<option value='".$result->modelId."'>" . $result->ModelName . "</option>";
	}

	echo $sHtml;

}

function get_fixture_values($mid) {
if(isset($_GET['model_id']) && isset($_GET['make_id']) && $_GET['make_id'] != '' && $_GET['model_id'] != ''){
	$results = getYearByMakeidAndModelidAjax($_GET['make_id'],$_GET['model_id']);
	foreach($results as $result){
		$sHtml2 = $sHtml2."<option value='".$result->yearId."'>" . $result->Year . "</option>";
	}
	echo $sHtml2;
}

function getYearByMakeidAndModelidAjax($makeId,$modelId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."year where makeId = '" . (int)$makeId . "' AND modelId = '" . (int)$modelId . "' order by Year ASC";
	return $wpdb->get_results($sql);
}
}


add_action( 'wp_ajax_nopriv_myajax-submit', 'ajax_speed_ring_finder_load' );
add_action( 'wp_ajax_myajax-submit', 'ajax_speed_ring_finder_load' );

function ajax_speed_ring_finder_load() {

	// get the submitted parameters
	$nonce = $_POST['postCommentNonce'];
	// check to see if the submitted nonce matches with the
  // generated nonce we created earlier
  if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) ) {
    die ( 'Busted!');
	}

  // generate the response
  $response = json_encode( "Success" );

  // response output
  header( "Content-Type: application/json" );

	$sHtml = "<option value='-1'>Fixture Brand</option>";
	$sHtml2 = "<option value='-1'>Fixture Model</option>";

	function getMakeByMakeIdAjax($makeId){
		global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix ."model where makeId = '" . (int)$makeId . "'";
		return $wpdb->get_results($sql);
	}

	if(isset($_POST['mId']) && $_POST['mId'] > 0)
	{
		$results = getMakeByMakeIdAjax($_POST['mId']);
		foreach($results as $result){
			$sHtml = $sHtml."<option value='".$result->modelId."'>" . $result->ModelName . "</option>";
		}
		echo $sHtml;
	}

	function getYearByMakeidAndModelidAjax($makeId,$modelId){
		global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix ."year where makeId = '" . (int)$makeId . "' AND modelId = '" . (int)$modelId . "' order by Year ASC";
		return $wpdb->get_results($sql);
	}

	if(isset($_POST['model_id']) && isset($_POST['make_id']) && $_POST['make_id'] != '' && $_POST['model_id'] != ''){
		$results = getYearByMakeidAndModelidAjax($_POST['make_id'],$_POST['model_id']);
		foreach($results as $result){
			$sHtml2 = $sHtml2."<option value='".$result->yearId."'>" . $result->Year . "</option>";
		}
		echo $sHtml2;
	}

	// Set Vals
	global $wpdb;
	$make_id = '';
	$model_id = '';
	$year = '';
	$array_filter_pro = array();


	// Get Values
	if(isset($_POST['fixture_type']) && $_POST['fixture_type'] != '' && (int)$_POST['fixture_type'] > 0){
		$make_id = $_POST['fixture_type'];
	}
	if(isset($_POST['fixture_brand']) && $_POST['fixture_brand'] != '' && (int)$_POST['fixture_brand'] > 0){
		$model_id = $_POST['fixture_brand'];
	}
	if(isset($_POST['fixture_model']) && $_POST['fixture_model'] != ''){
		$year = $_POST['fixture_model'];
	}

	function getPostMetaValue($post_id, $metakey) {
		$meta_value = get_post_meta( $post_id, $metakey);
		if(count($meta_value) > 0){
			return $meta_value[0];
		}
		else{
			return '';
		}
	}

	// Build
	if($make_id != '' && $model_id != '' && $year != '') {
		$sql="SELECT distinct productId FROM ".$wpdb->prefix ."filter where makeId = '" . (int)$make_id . "' and modelId = '" . (int)$model_id . "' and yearId = '" . (int)$year . "' order by productId ASC";
		$results = $wpdb->get_results($sql);

		if(count($results) > 0) {

			$post_ids = '';

			foreach($results as $result) {
				$post_ids .= $result->productId . ',';
			}

		if(count(explode(',',trim($post_ids,','))) > 0) {

			$post_id_coll = trim($post_ids,',');
			$sql = '';

			if($post_id_coll != ''){
				$sql="SELECT * FROM ".$wpdb->prefix ."posts where ID in(".$post_id_coll.") and post_status = 'publish' order by post_title ASC";
			}

			$results_pro = $wpdb->get_results($sql);

			if(count($results_pro) > 0) {
				foreach($results_pro as $presult) {
					$objData = new stdClass();
					$objData->product_id = $presult->ID;
					$objData->name = $presult->post_title;
					$objData->post_name = $presult->post_name;
					$objData->guid = $presult->guid;
					// $objData->regular_price = getPostMetaValue( $presult->ID, '_regular_price') != '' ? get_woocommerce_currency_symbol() . getPostMetaValue( $presult->ID, '_regular_price') : '';
					// $objData->sale_price = getPostMetaValue( $presult->ID, '_sale_price') != '' ? get_woocommerce_currency_symbol() . getPostMetaValue( $presult->ID, '_sale_price') : '';
					// $objData->price = getPostMetaValue( $presult->ID, '_price') != '' ? get_woocommerce_currency_symbol() . getPostMetaValue( $presult->ID, '_price') : '';
					$objData->image_id = getPostMetaValue( $presult->ID, '_thumbnail_id');
					$objData->href = get_permalink( $presult->ID );
					// $objData->objadd = get_Add_Cart_Link($presult->ID);
					$array_filter_pro[] = $objData;

				}
			}
		}

		foreach($array_filter_pro as $filter_product) { ?>
			<section class="clear txa-2 txb-1 bg10">
				<div class="sw">
					<div class="cw">
						<div class="pox mb0">
							<div class="wrap">
								<div class="poxa112a_112 poxb112b_112 poxc14c_14 poxd14d_14 poxe14e_14 mt4 mb4 tx-c">
									<figure style="" class="poxya112a_112 poxyb112b_112 poxyc14c_14 poxyd14d_14 poxe14e_14 bg-contain">
										<a href="<?php bloginfo("url"); ?>/product/<?php echo $filter_product->post_name; ?>" class="paxy fill">
											<?php echo wp_get_attachment_image( $filter_product->image_id, 'poxy_square_thumb_350')?>
										</a>
									</figure>
								</div>
								<div class="mb4 poxa38 poxb38 poxyc12c_p11 poxyd12d_p11 poxye34d_p11">
									<a href="<?php bloginfo("url"); ?>/product/<?php echo $filter_product->post_name; ?>">
										<h3 class="mt4">
											<span class="mr2">sku:</span>
											<?php echo $filter_product->name; ?>
										</h3>
									</a>
									<p><?php echo get_post_field('post_excerpt', $filter_product->product_id); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php
		}
	}

}


  exit;
}


//
// // if both logged in and not logged in users can send this AJAX request,
// // add both of these actions, otherwise add only the appropriate one
// add_action( 'wp_ajax_nopriv_myajax-submit', 'myajax_submit' );
// add_action( 'wp_ajax_myajax-submit', 'myajax_submit' );
//
// function myajax_submit() {
//
//     $nonce = $_POST['postCommentNonce'];
//
//     // check to see if the submitted nonce matches with the
//     // generated nonce we created earlier
//     if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) ) {
//       die ( 'Busted!');
// 		}
//
//     // ignore the request if the current user doesn't have
//     // sufficient permissions
//     if ( current_user_can( 'edit_posts' ) ) {
//         // get the submitted parameters
//         $postID = $_POST['postID'];
//
//         // generate the response
//         $response = json_encode( array( 'success' => true ) );
//
//         // response output
//         header( "Content-Type: application/json" );
//         echo $response;
//     }
//
//     // IMPORTANT: don't forget to "exit"
//     exit;
// }
