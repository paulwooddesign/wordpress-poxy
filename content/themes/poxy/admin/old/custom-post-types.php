<?php

//////////////////////////////////////////////////////////////
// Custom Post Types and Custom Taxonamies
/////////////////////////////////////////////////////////////

add_action( 'init', 'create_post_types' );

function create_post_types() {
  
  $labels = array(
    'name' => __( 'Projects' ),
    'singular_name' => __( 'Project' ),
    'add_new' => __( 'Add New' ),
    'add_new_item' => __( 'Add New Project' ),
    'edit' => __( 'Edit' ),
    'edit_item' => __( 'Edit Project' ),
    'new_item' => __( 'New Project' ),
    'view' => __( 'View Project' ),
    'view_item' => __( 'View Project' ),
    'search_items' => __( 'Search Projects' ),
    'not_found' => __( 'No Projects found' ),
    'not_found_in_trash' => __( 'No projects found in Trash' ),
    'parent' => __( 'Parent Project' ),
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,    
    //'rewrite' => true,
    //'rewrite' => array('slug' => 'products'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title', 'thumbnail', 'editor', 'comments', 'revisions', 'excerpt')
  );  
  
  register_post_type( 'project' , $args );
  flush_rewrite_rules( false );






}

  

add_action( 'init', 'create_taxonomies' );
function create_taxonomies() {

   
$labels = array(
      'name' => __( 'Technology' ),
      'singular_name' => __( 'Technology' ),
      'search_items' =>  __( 'Technologies' ),
      'all_items' => __( 'All Technologies' ),
      'parent_item' => __( 'Parent Technology' ),
      'parent_item_colon' => __( 'Parent Technology:' ),
      'edit_item' => __( 'Edit Technology' ),
      'update_item' => __( 'Update Technology' ),
      'add_new_item' => __( 'Add New Technology' ),
      'new_item_name' => __( 'New Technology' )
    );  

    register_taxonomy('technology',array('project'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));

$labels = array(
      'name' => __( 'Studio' ),
      'singular_name' => __( 'Studio' ),
      'search_items' =>  __( 'Studios' ),
      'all_items' => __( 'All Studios' ),
      'parent_item' => __( 'Parent Studio' ),
      'parent_item_colon' => __( 'Parent Studio:' ),
      'edit_item' => __( 'Edit Studio' ),
      'update_item' => __( 'Update Studio' ),
      'add_new_item' => __( 'Add New Studio' ),
      'new_item_name' => __( 'New Studio' )
    );  

    register_taxonomy('studio',array('project'),array(
      'hierarchical' => true,
      'labels' => $labels
    ));



    

  flush_rewrite_rules( false );
}

// List custom post type taxonomies

function ttrust_get_terms( $id = '' ) {
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
          $term_links[] = '<li><span><a href="'.$link.'">' . $term->name . '</a></span></li>';
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

function ttrust_get_terms_list( $id = '' , $echo = true ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $my_terms = ttrust_get_terms( $id );
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
        if(isset($output)) echo $output;
      else
        if(isset($output)) return $output;
    } else {
      return;
    }
  } else {
    return false;
  }
}

















//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////



 
add_action('admin_init', 'add_meta_boxes', 1);
function add_meta_boxes() {
  add_meta_box( 'repeatable-fields', 'Result Bullets', 'repeatable_meta_box_display', 'project', 'normal', 'core');
}

add_action('admin_init', 'add_involvement_meta_boxes', 1);
function add_involvement_meta_boxes() {
  add_meta_box( 'repeatable-fields', 'Bullet Points', 'repeatable_meta_box_display', 'product', 'normal', 'core');
}
 
function repeatable_meta_box_display() {
  global $post;
 
  $repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true);
 
 
  wp_nonce_field( 'repeatable_meta_box_nonce', 'repeatable_meta_box_nonce' );
?>
  <script type="text/javascript">
jQuery(document).ready(function($) {
  $('.metabox_submit').click(function(e) {
    e.preventDefault();
    $('#publish').click();
  });
  $('#add-row').on('click', function() {
    var row = $('.empty-row.screen-reader-text').clone(true);
    row.removeClass('empty-row screen-reader-text');
    row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
    return false;
  });
  $('.remove-row').on('click', function() {
    $(this).parents('tr').remove();
    return false;
  });
 
  $('#repeatable-fieldset-one tbody').sortable({
    opacity: 0.6,
    revert: true,
    cursor: 'move',
    handle: '.sort'
  });
});
  </script>
 
  <table id="repeatable-fieldset-one" width="100%">
  <thead>
    <tr>
      <th width="2%"></th>
      <th width="30%">Name</th>
      <th width="60%">URL</th>
      <th width="2%"></th>
    </tr>
  </thead>
  <tbody>
  <?php
 
  if ( $repeatable_fields ) :
 
    foreach ( $repeatable_fields as $field ) {
?>
  <tr>
    <td><a class="button remove-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" /></td>
 
    <td><input type="text" class="widefat" name="url[]" value="<?php if ($field['url'] != '') echo esc_attr( $field['url'] ); else echo 'http://'; ?>" /></td>
    <td><a class="sort">|||</a></td>
    
  </tr>
  <?php
    }
  else :
    // show a blank one
?>
  <tr>
    <td><a class="button remove-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="name[]" /></td>
 
 
    <td><input type="text" class="widefat" name="url[]" value="http://" /></td>
<td><a class="sort">|||</a></td>
    
  </tr>
  <?php endif; ?>
 
  <!-- empty hidden one for jQuery -->
  <tr class="empty-row screen-reader-text">
    <td><a class="button remove-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="name[]" /></td>
 
 
    <td><input type="text" class="widefat" name="url[]" value="http://" /></td>
<td><a class="sort">|||</a></td>
    
  </tr>
  </tbody>
  </table>
 
  <p><a id="add-row" class="button" href="#">Add another</a>
  <input type="submit" class="metabox_submit" value="Save" />
  </p>
  
  <?php
}
 
add_action('save_post', 'repeatable_meta_box_save');
function repeatable_meta_box_save($post_id) {
  if ( ! isset( $_POST['repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['repeatable_meta_box_nonce'], 'repeatable_meta_box_nonce' ) )
    return;
 
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;
 
  if (!current_user_can('edit_post', $post_id))
    return;
 
  $old = get_post_meta($post_id, 'repeatable_fields', true);
  $new = array();
 
 
  $names = $_POST['name'];
  $urls = $_POST['url'];
 
  $count = count( $names );
 
  for ( $i = 0; $i < $count; $i++ ) {
    if ( $names[$i] != '' ) :
      $new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
 
 
    if ( $urls[$i] == 'http://' )
      $new[$i]['url'] = '';
    else
      $new[$i]['url'] = stripslashes( $urls[$i] ); // and however you want to sanitize
    endif;
  }
 
  if ( !empty( $new ) && $new != $old )
    update_post_meta( $post_id, 'repeatable_fields', $new );
  elseif ( empty($new) && $old )
    delete_post_meta( $post_id, 'repeatable_fields', $old );
}





//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////

$prefix = "_poxy_";
$prefix2 = "_w45_";
$text_alignment = array("center" => "Center", "left" => "Left", "right" => "Right");


function w45_get_client_array(){
// Pull all the pages into an array
  $query = array(
    'post_type' => 'client',
    'posts_per_page' => 99,
    'orderby' => 'title',
    'order' => 'ASC',
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')    
  );
  $options_pages = array();  
  $options_pages_obj = get_posts($query);
  $options_pages[''] = 'Select Client:';
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->post_name] = $page->post_title;
  }
  return $options_pages;
}
$project_client = w45_get_client_array();


function w45_get_author_array(){
// Pull all the pages into an array
  $options_pages = array();  
  $options_pages_obj = get_users('orderby=nicename');
  $options_pages[''] = 'Match Author with Team Member:';
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->ID] = $page->display_name;
  }
  return $options_pages;
}
$author_array = w45_get_author_array();


//$project_client = array("center" => "Center", "left" => "Left", "right" => "Right");







//Project options
$config = array(
    'id' => 'project_options', 
    'title' => 'Project Options',
    'prefix' => $prefix."project_",
    'postType' => array('project'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);
$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'logo', 
  'label' => __('Logo: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'accent_color', 
  'label' => __('Accent Color: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'studio', 
  'label' => __('Studio: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'url_label', 
  'label' => __('URL Label: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'url', 
  'label' => __('URL: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Text',
  'id' => 'client_location', 
  'label' => __('Location: ','poxy')
));

//First Column
$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c1_image_1', 
  'label' => __('First column image 1: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c1_image_2', 
  'label' => __('First column image 2: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c1_image_3', 
  'label' => __('First column image 3: ','poxy'),
  'attachToPost' => false 
));

//Second Column
$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c2_image_1', 
  'label' => __('Second column image 1: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c2_image_2', 
  'label' => __('Second column image 2: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c2_image_3', 
  'label' => __('Second column image 3: ','poxy'),
  'attachToPost' => false 
));

//Third Column
$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c3_image_1', 
  'label' => __('Third column image 1: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c3_image_2', 
  'label' => __('Third column image 2: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'c3_image_3', 
  'label' => __('Third column image 3: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'featured', 
  'label' => __('Feature on Homepage: ','poxy')
));




//work options
$config = array(
    'id' => 'work_options', 
    'title' => 'Work Options',
    'prefix' => $prefix."product_",
    'postType' => array('product'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

// $slide_options_meta_box->addField(array(
//   'type' => 'Textarea',
//   'id' => 'description', 
//   'label' => __('Description: ','poxy')
// ));

$slide_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "client_name", 
  'label' => __('Client: ','poxy'),
  'default' => '', 
  'options' => $project_client
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'facts', 
  'label' => __('Main Image: ','poxy'),
  'attachToPost' => false 
));

// $slide_options_meta_box->addField(array(
//   'type' => 'Image', 
//   'id' => 'background_image', 
//   'label' => __('Background Image: ','poxy'),
//   'attachToPost' => false 
// ));

// $slide_options_meta_box->addField(array(
//   'type' => 'Checkbox', 
//   'id' => 'show_text', 
//   'label' => __('Show Text: ','poxy')
// ));



//Post options
$config = array(
    'id' => 'post_options', 
    'title' => 'Post Options',
    'prefix' => $prefix."post_",
    'postType' => array('post'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "client_name", 
  'label' => __('Client: ','poxy'),
  'default' => '', 
  'options' => $project_client
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'background_image', 
  'label' => __('Background Image: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'show_text', 
  'label' => __('Show Text: ','poxy')
));




//Page options
$config = array(
    'id' => 'post_options', 
    'title' => 'Post Options',
    'prefix' => $prefix."page_",
    'postType' => array('page'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'description', 
  'label' => __('Description: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Textarea',
  'id' => 'banner_text', 
  'label' => __('Banner Text: ','poxy')
));

$slide_options_meta_box->addField(array(
  'type' => 'Image', 
  'id' => 'background_image', 
  'label' => __('Background Image: ','poxy'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type' => 'Checkbox', 
  'id' => 'featured', 
  'label' => __('Feature on Homepage: ','poxy')
));





//Member options
$config = array(
    'id' => 'team_options', 
    'title' => 'Author Options',
    'prefix' => $prefix."team_",
    'postType' => array('team'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);



$slide_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "name", 
  'label' => __('Author Name: ','poxy'),
  'default' => '', 
  'options' => $author_array
));






//work options
$config = array(
    'id' => 'award_options', 
    'title' => 'Award Client',
    'prefix' => $prefix."award_",
    'postType' => array('award'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type' => 'Select', 
  'id' => "client_name", 
  'label' => __('Client: ','poxy'),
  'default' => '', 
  'options' => $project_client
));



$portfolio_options = array( 
    "notes" => array(
      "type" => "textarea",
    "name" => $prefix."page_skills",
      "std" => "",
      "title" => __('Skills','poxy'),
      "description" => __('For use with the Portfolio page template. <br/><br/>Enter the names of the skills (separated by commas) you want shown on this page. If left blank, all skills will be used.','poxy'))
);

$home_feature_options = array(
    "featured" => array(
      "type" => "checkbox",
    "name" => $prefix."featured",
      "std" => "",
      "title" => __('Feature on Home','poxy'),
      "description" => __('Check this box to feature this on the home page.','poxy'))

    
);









?>