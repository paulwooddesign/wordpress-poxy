<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function gallery_add_meta_box() {

  $screens = array( 'post', 'page' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'gallery_section_id',
      __( 'Gallery', 'gallery_textdomain' ),
      'gallery_meta_box_callback',
      $screen
    );
  }
}
add_action( 'add_meta_boxes', 'gallery_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function gallery_meta_box_callback( $post ) {

   global $post;
 
  $gallery_fields = get_post_meta($post->ID, 'gallery_fields', true);
 
 
  wp_nonce_field( 'gallery_meta_box_nonce', 'gallery_meta_box_nonce' );
?>
  <script type="text/javascript">
jQuery(document).ready(function($) {
  $('.gallery_metabox_submit').click(function(e) {
    e.preventDefault();
    $('#publish').click();
  });
  $('#add-gallery-row').on('click', function() {
    var row = $('.empty-gallery-row.screen-reader-text').clone(true);
    row.removeClass('empty-gallery-row screen-reader-text');
    row.insertBefore('#gallery-fieldset-two tbody>tr:last');
    return false;
  });
  $('.remove-gallery-row').on('click', function() {
    $(this).parents('tr').remove();
    return false;
  });
 
  $('#gallery-fieldset-two tbody').sortable({
    opacity: 0.6,
    revert: true,
    cursor: 'move',
    handle: '.sort'
  });
});
  </script>
 
  <table id="gallery-fieldset-two" width="100%">
  <thead>
    <tr>
      <th width="2%"></th>
      <th width="50%">Name</th>
      <th width="50%">URL</th>
      <th width="2%"></th>
    </tr>
  </thead>
  <tbody>
  <?php
 
  if ( $gallery_fields ) :
 
    foreach ( $gallery_fields as $field ) {
?>
  <tr>
    <td><a class="button remove-gallery-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="gallery_name[]" value="<?php if($field['gallery_name'] != '') echo esc_attr( $field['gallery_name'] ); ?>" /></td>
 
    <td><input type="text" class="widefat" name="gallery_url[]" value="<?php if ($field['gallery_url'] != '') echo esc_attr( $field['gallery_url'] ); else echo 'http://'; ?>" /></td>
    <td><a class="sort">|||</a></td>
    
  </tr>
  <?php
    }
  else :
    // show a blank one
?>
  <tr>
    <td><a class="button remove-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="gallery_name[]" /></td>
 
 
    <td><input type="text" class="widefat" name="gallery_url[]" value="http://" /></td>
<td><a class="sort">|||</a></td>
    
  </tr>
  <?php endif; ?>
 
  <!-- empty hidden one for jQuery -->
  <tr class="empty-gallery-row screen-reader-text">
    <td><a class="button remove-row" href="#">-</a></td>
    <td><input type="text" class="widefat" name="gallery_name[]" /></td>
 
 
    <td><input type="text" class="widefat" name="gallery_url[]" value="http://" /></td>
<td><a class="sort">|||</a></td>
    
  </tr>
  </tbody>
  </table>
 
  <p><a id="add-gallery-row" class="button" href="#">Add another</a>
  <input type="submit" class="gallery_metabox_submit" value="Save" />
  </p>
  
  <?php
}






/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function gallery_save_meta_box_data( $post_id ) {

   if ( ! isset( $_POST['gallery_meta_box_nonce'] ) ||
    !wp_verify_nonce( $_POST['gallery_meta_box_nonce'], 'gallery_meta_box_nonce' ) )
    return;
 
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;
 
  if (!current_user_can('edit_post', $post_id))
    return;
 
  $old = get_post_meta($post_id, 'gallery_fields', true);
  $new = array();
 
 
  $names = $_POST['gallery_name'];
  $urls = $_POST['gallery_url'];
 
  $count = count( $names );
 
  for ( $i = 0; $i < $count; $i++ ) {
    if ( $names[$i] != '' ) :
      $new[$i]['gallery_name'] = stripslashes( strip_tags( $names[$i] ) );
 
 
    if ( $urls[$i] == 'http://' )
      $new[$i]['gallery_url'] = '';
    else
      $new[$i]['gallery_url'] = stripslashes( $urls[$i] ); // and however you want to sanitize
    endif;
  }
 
  if ( !empty( $new ) && $new != $old )
    update_post_meta( $post_id, 'gallery_fields', $new );
  elseif ( empty($new) && $old )
    delete_post_meta( $post_id, 'gallery_fields', $old );
}
add_action( 'save_post', 'gallery_save_meta_box_data' );