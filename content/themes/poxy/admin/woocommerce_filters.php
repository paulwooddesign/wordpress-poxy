<?php
/////////////////////////////////
// Woocommerce
////////////////////////////////
//add_theme_support( 'woocommerce' );

////////////////////////////////////////////////////////////
//  Woocommerce hooks
////////////////////////////////////////////////////////////

//remove hooks
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


//Product Shop/Archive Page
//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10);





//woocommerce_template_single_sharing

//Add Wrapper Container
//add_action('woocommerce_before_main_content', 'w45_wrapper_start', 10);
//add_action('woocommerce_after_main_content', 'w45_wrapper_end', 10);


// wp_dequeue_script('wc-add-to-cart-variation');
// function fix_woo_var_cart()
// {
//   wp_enqueue_script('add-to-cart-variation', '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.js',array('jquery'),'1.0',true);
// }
// add_action('wp_enqueue_scripts','fix_woo_var_cart');



//Remove Product Tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}



//Add Related Projects after Summary
//add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1);
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 2);
//add_action( 'woocommerce_single_product_summary', 'woocommerce_output_related_products', 50);
//add_action( 'woocommerce_single_product_summary', 'woocommerce_upsell_display', 60 );

add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 1);

//Declare Wordpress Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// //Change number of upsells output
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display');
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 20);
 
if (!function_exists('woocommerce_output_upsells')) {
    function woocommerce_output_upsells() {
        woocommerce_upsell_display(5,5); // Display 3 products in rows of 3
    }
}


add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_list_variations' );
function woocommerce_product_list_variations() { ?>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/add-to-cart-variation.js"></script>

<?php }







add_filter( 'woocommerce_variation_option_name', 'display_price_in_variation_option_name' );

function display_price_in_variation_option_name( $term ) {
    global $wpdb, $product;

    $result = $wpdb->get_col( "SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'" );

    $term_slug = ( !empty( $result ) ) ? $result[0] : $term;


    $query = "SELECT postmeta.post_id AS product_id
                FROM {$wpdb->prefix}postmeta AS postmeta
                    LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
                WHERE postmeta.meta_key LIKE 'attribute_%'
                    AND postmeta.meta_value = '$term_slug'
                    AND products.post_parent = $product->id";

    $variation_id = $wpdb->get_col( $query );

    $parent = wp_get_post_parent_id( $variation_id[0] );

    if ( $parent > 0 ) {
        $_product = new WC_Product_Variation( $variation_id[0] );
        return $term . ' (' . woocommerce_price( $_product->get_price() ) . ')';
    }
    return $term;

}










function get_me_product_sections($atts, $tab, $content = null){ 
global $post;  
//$args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'meta_key' => '_ttrust_toggle_featured_value', 'product_cat' => $atts );
$args = array( 'post_type' => 'product',  'posts_per_page' => 99, 'product_cat' => $atts );
$loop = new WP_Query( $args );
    ?>
    <?php if ( $loop->have_posts() ) : ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <?php global $product; ?>
        <!-- <div class="poxy a11-14"> -->
        <?php //do_action( 'woocommerce_before_shop_loop' ); ?>
            
            <!-- <div class="poy a13-14 mr0"> -->
                
                <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                
                    <?php
                        /**
                         * woocommerce_before_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        //do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                    
                    <!-- <a href="<?php //the_permalink(); ?>"> -->
                    <div class="poxy a_18-18 b18-18 g14-13 d14-12 e12-12 mb0  contain" style="background-image: url(<?php poxy_thumb(); ?>);">
                        <?php poxy_edit(); ?>
                        
                    </div>

                        <div class="poxy a_16-18 b_14-18 g23-18 d34-18 mb0 hide-g hide-d hide-e vert-c">
                            <div>
                                <h4 class="epsilon mb0"><?php the_title(); ?></h4>
                               
                            </div>
                            <h5 class="bix"><a class="zeta mb0" style="line-height:0 !important;" href="#">+ Nutrition Facts</a></h5>
                        </div>
                     <div class="pox ap16 b14-18 d34-18 e12-12 mb0 mr0 hide show-g show-d show-e"><h4 class="gamma mb0"><?php the_title(); ?></h4></div>
                    <!-- </a> -->
                   
                    <?php //* Price / ?>
                    <?php if ( $price_html = $product->get_price_html() ) : ?>
                        <div class="poxy a_18-18  b_16-18 g14-18 d14-18 d34-18 mb0 hide-g hide-d hide-e vert-c">
                            <h4 class="price gamma mb0"><?php echo $price_html; ?></h4>
                        </div>

                        <div class="pox g_14-18 d_34-18 d_34-18 e_12-12 mr0 mb0 hide show-g show-d show-e">
                            <h4 class="price beta mr0"><?php echo $price_html; ?></h4>
                        </div>
                        <?php endif; ?>
                    
                    <?php // Price */ ?>


                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

                

                
                
            <!-- </div> -->
        <!-- </div> -->
        <div class="clearboth"></div>
       
        <div class="half_spacer"></div>
        <div class="clearboth"></div>

        <?php endwhile; ?>
        <div class="spacer"></div>
        <div class="clearboth"></div>
<?php wp_reset_query(); ?>

<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

    <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>
<?php 
}
?>