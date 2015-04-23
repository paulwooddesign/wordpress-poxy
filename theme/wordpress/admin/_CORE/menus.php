<?php
/////////////////////////////////
// Navigation Menus
// -Add Menus for the backed-
////////////////////////////////
add_theme_support('menus');
register_nav_menu('header', 'Header');
register_nav_menu('main', 'Main');
register_nav_menu('main_small', 'Main Small');
register_nav_menu('footer', 'Footer');
register_nav_menu('footer_small', 'Footer Small');
register_nav_menu('mobile', 'Mobile');



//////////////////////////////////////////////////////////////
// Navigation
/////////////////////////////////////////////////////////////
function default_nav() {
  echo '<ul class="sf-menu clearfix" >';
    wp_list_pages('sort_column=menu_order&title_li=');
  echo '</ul>';
}

// custom menu example @ http://digwp.com/2011/11/html-formatting-custom-menus/
function poxy_clean_header_nav($position = 'right') {
$facebook_url = of_get_option('poxy_facebook_url');
$twitter_url = of_get_option('poxy_twitter_url');
$tumblr_url = of_get_option('poxy_tumblr_url');
$google_url = of_get_option('poxy_google_url');
$linkedin_url = of_get_option('poxy_linkedin_url');
$youtube_url = of_get_option('poxy_youtube_url');
$pinterest_url = of_get_option('poxy_pinterest_url');
$vimeo_url = of_get_option('poxy_vimeo_url');
$instagram_url = of_get_option('poxy_instagram_url');
$newsletter_url = of_get_option('poxy_newsletter_url');

  $menu_name = 'header'; // specify custom menu slug
  if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<nav>' ."\n";
    $menu_list .= "\t\t\t\t". '<ul class="menu-header-container">' ."\n";
    foreach ((array) $menu_items as $key => $menu_item) {
      $title = $menu_item->title;
      $url = $menu_item->url;
      $menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
    }
    $menu_list .= "\t\t\t\t". '</ul>' ."\n";


    $menu_list2 = "\t\t\t". '</nav>' ."\n";
  } else {
    // $menu_list = '<!-- no list defined -->';
  }
  get_template_part( 'inc/social_plugins/social_icons');
  echo $menu_list;
  echo $menu_list2;
}








function poxy_clean_footer_nav() {
  $menu_name = 'footer'; // specify custom menu slug
  if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<nav class="menu-footer">' ."\n";
    $menu_list .= "\t\t\t\t". '<ul id="menu-footer">' ."\n";
    foreach ((array) $menu_items as $key => $menu_item) {
      $title = $menu_item->title;
      $url = $menu_item->url;
      $menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
    }






    $menu_list .= "\t\t\t\t". '</ul>' ."\n";
    $menu_list .= "\t\t\t". '</nav>' ."\n";
  } else {
    // $menu_list = '<!-- no list defined -->';
  }
  echo $menu_list;
}



// custom menu example @ http://digwp.com/2011/11/html-formatting-custom-menus/
function poxy_clean_small_footer_nav($position = 'right') {
$facebook_url = of_get_option('poxy_facebook_url');
$twitter_url = of_get_option('poxy_twitter_url');
$tumblr_url = of_get_option('poxy_tumblr_url');
$google_url = of_get_option('poxy_google_url');
$linkedin_url = of_get_option('poxy_linkedin_url');
$youtube_url = of_get_option('poxy_youtube_url');
$pinterest_url = of_get_option('poxy_pinterest_url');
$vimeo_url = of_get_option('poxy_vimeo_url');
$instagram_url = of_get_option('poxy_instagram_url');
$newsletter_url = of_get_option('poxy_newsletter_url');

  $menu_name = 'footer_small'; // specify custom menu slug
  if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<nav class="menu-footer-container">' ."\n";
    $menu_list .= "\t\t\t\t". '<ul>' ."\n";
    foreach ((array) $menu_items as $key => $menu_item) {
      $title = $menu_item->title;
      $url = $menu_item->url;
      $menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
    }
    $menu_list .= "\t\t\t\t". '</ul>' ."\n";


    $menu_list2 = "\t\t\t". '</nav>' ."\n";
  } else {
    // $menu_list = '<!-- no list defined -->';
  }
  //get_template_part( 'inc/social_plugins/social_icons');
  
  echo $menu_list;

  echo $menu_list2;
}

?>
