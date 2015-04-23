<?php
//////////////////////////////////////////////////////////////
// Ajax Project
/////////////////////////////////////////////////////////////

add_action( 'wp_ajax_nopriv_myajax-submit', 'ajax_project_load' );
add_action( 'wp_ajax_myajax-submit', 'ajax_project_load' );
 
function ajax_project_load() {
  
  $the_slug = $_POST['slug'];
  $args=array(
    'name' => $the_slug,
    'post_type' => 'product',
    'post_status' => 'publish',
    'showposts' => 1,
    'ignore_sticky_posts' => 1
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


<?php
  //Get Product options
  $sub_head = get_post_meta($post->ID, "_poxy_product_sub_head", true); 
  if($sub_head){
    $sub_head = $sub_head;
    }else{
    $sub_head = '';
  }

  $ingredients = get_post_meta($post->ID, "_poxy_product_ingredients", true); 

  $nutrition_icons = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_product_nutrition_icons", true), 'full');
  $nutrition_icons = $nutrition_icons[0];

  $nutrition_facts = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_product_background_image", true), 'full');
  $nutrition_facts = $nutrition_facts[0];

  $mobile_img = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_product_mobile_image", true), 'full');
  $mobile_img = $mobile_img[0];

  $box_image = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_product_image_2", true), 'full');
  $box_image = $box_image[0];

  $product_front_img = wp_get_attachment_image_src(get_post_meta($post->ID, "_poxy_product_front_image", true), 'full');
  $product_front_img = $product_front_img[0];

  $usda_organic = get_post_meta($post->ID, "_poxy_product_usda_organic", true);
  $gluten_free = get_post_meta($post->ID, "_poxy_product_gluten_free", true);
  $star_kosher = get_post_meta($post->ID, "_poxy_product_star_kosher", true);
  $scroll_kosher = get_post_meta($post->ID, "_poxy_product_scroll_kosher", true);
  $non_gmo = get_post_meta($post->ID, "_poxy_product_non_gmo", true);

  if($nutrition_icons){

    $nutrition_icons = $nutrition_icons;

    }else{

    $nutrition_icons = poxy_placeholder(400, 100);

  }       
    




  $front_img = "";
  if($product_front_img){
    $front_img = "background-image: url(".$product_front_img.");";  
    $front_img .= "background-repeat: no-repeat;";
    $front_img .= "background-position: center center;";
    $front_img .= "background-size: contain;";  
    $front_img .= "z-index: 999;";  

  }
?>  

<section id="ajax-project-<?php the_ID(); ?>" <?php post_class('project main ajax clearfix'); ?> >
  <div class="site-width">
   <?php
    $prev_post = get_previous_post();
    if($prev_post) $prev_slug = $prev_post->post_name;
    $next_post = get_next_post();
    if($next_post) $next_slug = $next_post->post_name;
    ?>   
    <ul class="flex-direction-nav hide-e">       
      <li class="next <?php if(!$next_slug) echo 'inactive';?>"> 
        <?php if(isset($next_slug)) : ?>
          <a class="flex-next" href="#<?php echo $next_slug;?>" onClick="nextPrevProject('<?php echo $next_slug;?>');">Next</a>
        <?php endif; ?>
      </li>
      <li class="previous <?php if(!$prev_slug) echo 'inactive';?>"> 
        <?php if(isset($prev_slug)) : ?>
          <a class="flex-prev" href="#<?php echo $prev_slug;?>" onClick="nextPrevProject('<?php echo $prev_slug;?>');">Previous</a>
        <?php endif; ?>
      </li>
    </ul>
      <div class="copy-width">
        <?php //poxy_content(); ?>
       
      

<div class="hide show-e">
 <div class="poy a_11-23 b_11-11 g_12-12 d_11-11 e_11-11 mr0 mb0" style="height:auto;">

      <div class="pox e_11-11">
        <div class="spacer"></div>
        <h2 class="closeBtn"><?php poxy_edit(); ?><a href="#index">X</a></h2> 
        <div class="spacer"></div>
        <?php //* Heading / ?>
        <?php if($sub_head) : ?>
        <h4 class="sub-head mb0"><span><?php echo $sub_head; ?></span></h4> 
        <?php endif; ?>
        <h3 class="title beta relative"><span><?php the_title(); ?></span></h3>
        <?php //* Heading / ?>
      </div>



         

       <?php //* Featured Image / ?>
      <?php if(has_post_thumbnail()) : ?>
      <figure class="poxy a_13-23 b_13-11 g_13-12 d_11-11 e_11-11 mr0 contain" style="background-image:url(<?php echo poxy_full_image_url($post->ID); ?>);"></figure>
      <?php else : ?>
      <figure class="poxy a_13-12 b_13-11 g_13-12 d_11-11 e_11-11 mr0 contain" style="background-image:url(<?php echo poxy_placeholder(360, 550); ?>);"></figure>
      <?php endif; ?>


      <?php //* Bullets / ?>
      <div class="pox a_13-13 b_13-13 g_12-12 d_11-11 e_11-11 mr0 contain">
        <?php //* Ingredients / ?>
        <div class="ingredients pox a_13-13 b_13-13 g_12-12 d_11-11 e_11-11 mr0 mb0">
          <h3>INGREDIENTS:</h3>
          <p><?php poxy_text($ingredients); ?></p>
        </div>
        <?php // Ingredients */ ?>
         <h3>And in case you're wondering....</h3>
         <div class="custom-bullets">
        <?php $repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true); ?>
        <?php if ( $repeatable_fields ) : ?>
        <div class='pox a_16-16 b_16-16 e_12-12'>
          <ul>
          <?php foreach ( $repeatable_fields as $field ) {        
            if($field['name'] != '') {
              $name = esc_attr( $field['name'] );
              $a = '<li class="mb0">';
              $a .= $name;
              $a .= '</li>';
              echo $a;
              echo "\n";
            }     
          }?>
          </ul>
        </div>
        <div class='pox a_16-16 b_16-16 e_12-12 mr0'>
        <ul class="zeta2">
        <?php foreach ( $repeatable_fields as $field ) {        
          if($field['url'] != '') {
            $name = esc_attr( $field['url'] );
              $a = '<li class="mb0">';
              $a .= $name;
              $a .= '</li>';
              echo $a;
              echo "\n";
          }     
        }?>
        </ul>
        </div>
        
      </div>
        <div class="clearboth"></div>
        <?php endif; ?>
        <?php // Bullets */ ?>


        <?php //* Statement Image / ?>
        <?php if ($nutrition_facts) : ?>
        <div  class="pox a_13-23 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain">
        <img src="<?php echo $box_image; ?>" />
        </div>
        <?php else : ?>
        <div  class="poxy a_13-12 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain">
          <img src="<?php echo poxy_placeholder(600, 450); ?>" />
        </div>
        <?php endif; ?>
        <?php // Statement Image */ ?>

        




        <?php //* Statement Image / ?>
        <?php if ($nutrition_facts) : ?>
        <div  class="pox a_13-23 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain">
        <img src="<?php echo $nutrition_facts; ?>" />
        </div>
        <?php else : ?>
        <div  class="poxy a_13-12 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain">
          <img src="<?php echo poxy_placeholder(600, 450); ?>" />

        </div>
        <?php endif; ?>
        <?php // Statement Image */ ?>

  </div>
  <p><a href="<?php echo home_url(); ?>/shop" class="button">Buy Now</a></p>
</div>
</div>







<?php // Desktop -------------------------- */ ?>


<div class="hide-e">
  <div class="">
    <article class="pox a_13-23 b_13-11 g_12-12 d_11-11 e_12-12 mb0  relative">
        <div class="spacer"></div>
         <h2 class="closeBtn"> 
              <?php poxy_edit(); ?> 
                <a href="#index">X</a>
              </h2> 
          <div class="spacer"></div>


          
      <?php //* Heading / ?>
      <?php if($sub_head) : ?>
      <h5 class="sub-head mb0"><span><?php echo $sub_head; ?></span></h5> 
      <?php endif; ?>
      <h3 class="title beta relative"><span><?php the_title(); ?></span>
        
      </h3>
      <?php //* Heading / ?>
          
      <?php //* Ingredients / ?>
      <div class="ingredients pox a_13-13 b_13-13 g_12-12 d_11-11 e_11-11 mr0 mb0">
        <p><strong>INGREDIENTS: </strong><?php poxy_text($ingredients); ?></p>
      </div>
      <?php // Ingredients */ ?>
      

      <?php //* Bullets / ?>
      <div class="pox a_13-13 b_13-13 g_12-12 d_11-11 e_11-11 mr0 contain">
         <h4>And in case you're wondering....</h4>
         <div class="custom-bullets">
        <?php $repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true); ?>
        <?php if ( $repeatable_fields ) : ?>
        <div class='pox a16 b16 e12'>
          <ul>
          <?php foreach ( $repeatable_fields as $field ) {        
            if($field['name'] != '') {
              $name = esc_attr( $field['name'] );
              $a = '<li class="mb0">';
              $a .= $name;
              $a .= '</li>';
              echo $a;
              echo "\n";
            }     
          }?>
          </ul>
        </div>
        <div class='pox a_16-16 b_16-16 e_12-12 mr0'>
        <ul class="zeta2">
        <?php foreach ( $repeatable_fields as $field ) {        
          if($field['url'] != '') {
            $name = esc_attr( $field['url'] );
              $a = '<li class="mb0">';
              $a .= $name;
              $a .= '</li>';
              echo $a;
              echo "\n";
          }     
        }?>
        </ul>
        </div>
        <p><a id="nutrition-button" class="button">Nutrition Facts</a></p>
        <p><a href="<?php echo home_url(); ?>/shop" class="button">Buy Now</a></p>
      </div>
      <div class="clearboth"></div>
        <?php endif; ?>
        <?php // Bullets */ ?>


        <?php /* Nutrition Icons / ?>
        <div class="nutrition-icons pox a13 b13 g12 d11 e11 mr0 contain">
          <img src="<?php echo $nutrition_icons; ?>" />
        </div>
        <?php // Nutrition Icons */ ?>
        
    </div>
   
  </article>     



        <?php //* Featured Image / ?>
        <?php if(has_post_thumbnail()) : ?>
        <figure class="poxy a_13-23 b_13-11 g_13-12 d_11-11 e_11-11 cbp-so-side cbp-so-side-left contain" style="background-image:url(<?php echo poxy_full_image_url($post->ID); ?>);"></figure>
        <?php else : ?>
        <figure class="poxy a_13-12 b_13-11 g_13-12 d_11-11 e_11-11 cbp-so-side cbp-so-side-left contain" style="background-image:url(<?php echo poxy_placeholder(360, 550); ?>);"></figure>
        <?php endif; ?>
        <?php // Featured Image */ ?>
        
       



      <?php //* Statement Image / ?>
      <div class="poxy a_13-23 b_13-23 g_12-12 d_11-11 e_11-11 mb0 mr0">


   
          

           <?php //* Nutrition Facts / ?>
          <div id="nutrition-toggle" class="">
            <!-- <img src="<?php //echo $nutrition_icons; ?><?php //echo poxy_placeholder(600, 100); ?>" /> -->
         
          <?php // Nutrition Facts */ ?>

          <?php //* Statement Image / ?>
          <?php if ($nutrition_facts) : ?>
          <div id="facts" class="pixy a_13-23 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain"  style="background-position:center center; background-image:url(<?php echo $nutrition_facts; ?>);"></div>
          <?php else : ?>
          <div id="facts" class="pixy a_13-12 b_13-11 g_12 d_11-11 e_11-11 mr0 contain" style="background-position:center center; background-image:url(<?php echo poxy_placeholder(600, 450); ?>);"></div>
          <?php endif; ?>
          <?php // Statement Image */ ?>

          <?php if ($box_image) : ?>
          <div id="box-image" class="pixy a_13-23 b_13-11 g_12 d_11 e_11-11 mr0 contain"  style="background-position:center center; background-image:url(<?php echo $box_image; ?>);">
          
          </div>
          <?php else : ?>
          <div id="box-image" class="pixy a_13-12 b_13-11 g_12-12 d_11-11 e_11-11 mr0 contain" style="background-position:center center; background-image:url(<?php echo poxy_placeholder(600, 450); ?>);">

          </div>
          <?php endif; ?>

          </div>
          <?php // Statement Image */ ?>
          </div>


        </div>
        <div class="spacer"> </div>
        <em>*Contains Wheat</em>
        <div class="spacer"></div>
      </div>





          <?/*/?>
                                              
          <div class="visuals clearfix">                
            <?php echo wpautop(do_shortcode(add_video_containers($post->post_content))); ?>   
          </div>
      
          <div class="details">             
            <?php $project_notes = get_post_meta($post->ID, "_ttrust_notes_value", true); ?>
            <?php echo wpautop(do_shortcode($project_notes)); ?>
        
            <?php $project_url = get_post_meta($post->ID, "_ttrust_url_value", true); ?>
            <?php $project_url_label = get_post_meta($post->ID, "_ttrust_url_label_value", true); ?>
            <?php $project_url_label = ($project_url_label!="") ? $project_url_label : __('Visit Site', 'themetrust'); ?>
            <?php if ($project_url) : ?>
              <p><a class="action" href="<?php echo $project_url; ?>"><?php echo $project_url_label; ?></a></p>
            <?php endif; ?>       
          </div> 
          <?//*/?>



       
      </div>
    </div>
  </div>
</section>
    <?php $slideshow_delay = of_get_option('ttrust_slideshow_delay'); ?>
    <?php $slideshow_delay = ($slideshow_delay != "") ? $slideshow_delay : '6'; ?>    
    <script type="text/javascript">
    //<![CDATA[
      waitForMedia("<?php echo $the_slug; ?>", <?php echo $slideshow_delay; ?>);
      lightboxInit();
      jQuery('#nutrition-toggle').click(function(){
  jQuery(this).toggleClass('active');
});

jQuery('#nutrition-button').click(function(){
  jQuery('#nutrition-toggle').toggleClass('active');
});
      //]]>
    </script>     
    
  <?php endif; ?> 
    
<?php    
    exit;
}


?>