<?php // This file handles the admin area and functions.




///////////////////////////////////
// Dashboard Custom Admin Footer Text
///////////////////////////////////
function poxy_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://paulwooddesign.com" target="_blank">Paul Wood Design</a></span>.', 'poxy');
}

add_filter('admin_footer_text', 'poxy_custom_admin_footer');





//////////////////////////////////////////////////////////////
// Underconsruction Notice - Not pretty need better solution
/////////////////////////////////////////////////////////////

function poxy_under_construction_mode() {
    if ( current_user_can( 'level_10' ) || !is_user_logged_in() ) {
        wp_die('Site is currently under construction please come back soon.');
        wp_enqueue_style( 'poxy_login_styles', get_template_directory_uri() . '/login.css', true );
    }
}

//add_action('get_header', 'poxy_under_construction_mode');



//////////////////////////////////////////////////////////////
// Remove Dashboard Widgets
/////////////////////////////////////////////////////////////

function poxy_remove_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal'); // Yoast's SEO Plugin Widget
}

add_action('wp_dashboard_setup', 'poxy_remove_dashboard_widgets' );




//////////////////////////////////////////////////////////////
// Remove  Widgets
/////////////////////////////////////////////////////////////
function remove_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
 }

//add_action('widgets_init', 'remove_default_widgets', 11);


// WPSnippy to Remove WordPress Admin Bar Menu Items
function wpsnippy_admin_bar() {
    global $wp_admin_bar;

// To remove WordPress logo and related submenu items
   $wp_admin_bar->remove_menu(' wp-logo ');
   $wp_admin_bar->remove_menu(' about ');
   $wp_admin_bar->remove_menu(' wporg ');
   $wp_admin_bar->remove_menu(' documentation ');
   $wp_admin_bar->remove_menu(' support-forums ');
   $wp_admin_bar->remove_menu(' feedback ');

// To remove Site name/View Site submenu and Edit menu from front end
   $wp_admin_bar->remove_menu(' site-name ');
   $wp_admin_bar->remove_menu(' view-site ');
   $wp_admin_bar->remove_menu(' edit ');

// To remove Update Icon/Menu
   $wp_admin_bar->remove_menu(' updates ');

// To remove Comments Icon/Menu
   $wp_admin_bar->remove_menu(' comments ');

// To remove ' New ' Menu
   $wp_admin_bar->remove_menu(' new-content ');

// To remove ' Howdy,user ' Menu completely and Search field from front end
   $wp_admin_bar->remove_menu(' top-secondary ');
   $wp_admin_bar->remove_menu(' search ');

// To remove ' Howdy,user ' subMenus
   $wp_admin_bar->remove_menu(' user-actions ');
   $wp_admin_bar->remove_menu(' user-info ');
   $wp_admin_bar->remove_menu(' edit-profile ');
   $wp_admin_bar->remove_menu(' logout ');

}
add_action( ' wp_before_admin_bar_render ', ' wpsnippy_admin_bar ' );

//////////////////////////////////////////////////////////////
// Admin Bar Options Link
// 1.1
/////////////////////////////////////////////////////////////
add_action( 'admin_bar_menu', 'poxy_admin_bar_theme_options_button', 100 );

function poxy_admin_bar_theme_options_button( $wp_admin_bar ) {

	$args = array(
		'id'    => 'theme_options',
		'title' => 'Theme Options',
		'href'  => site_url().'/wp-admin/themes.php?page=options-framework',
		'meta'  => array( 'class' => 'theme-options' )
	);
	$wp_admin_bar->add_node( $args );
}

//Edit Menu
//add_action( 'admin_bar_menu', 'poxy_admin_bar_menu_options_button', 110 );

function poxy_admin_bar_menu_options_button( $wp_admin_bar ) {

	$args = array(
		'id'    => 'menu_options',
		'title' => 'Menu',
		'href'  => site_url().'/wp-admin/nav-menus.php',
		'meta'  => array( 'class' => 'menu-options' )
	);
	$wp_admin_bar->add_node( $args );
}





//////////////////////////////////////////////////////////////
// Sets the HTML Editor as default
/////////////////////////////////////////////////////////////
add_filter( 'wp_default_editor', create_function('', 'return "html";') );
//add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );





//////////////////////////////////////////////////////////////
// Dashboard Custom Alert Message
/////////////////////////////////////////////////////////////
function poxy_show_admin_message($message, $errormsg = false) {
	if ($errormsg) {
		echo '<div id="message" class="error">';
	} else {
		echo '<div id="message" class="updated fade">';
	}
	echo "<p><strong>$message</strong></p></div>";
}

function poxy_admin_message() {
    poxy_show_admin_message("This Is a custom alert message. -Paul", true);
}

//add_action('admin_notices', 'poxy_admin_message');




//////////////////////////////////////////////////////////////
// Remove Lost Password Notice
/////////////////////////////////////////////////////////////

// Change Login Page - .htaccess
// RewriteRule ^login$ http://YOUR_SITE.com/wp-login.php [NC,L]

function poxy_remove_lost_password_text ( $text ) {
    if ($text == 'Lost your password?'){$text = '';}
	return $text;
}

//add_filter( 'gettext', 'poxy_remove_lost_password_text' );




//////////////////////////////////////////////////////////////
// Remove Login Errors
//////////////////////////////////////////////////////////////

add_filter('login_errors',create_function('$a', "return null;"));
function poxy_login_head() {
	remove_action('login_head', 'wp_shake_js', 12);
}

add_action('login_head', 'poxy_login_head');




//////////////////////////////////////////////////////////////
// Custom Register Message
//////////////////////////////////////////////////////////////
add_action('register_form', 'login_form_message');
function login_form_message() {
    echo '<p>Custom Login Form Message</p>';
}


//////////////////////////////////////////////////////////////
// Always Remember me - Always remember login
//////////////////////////////////////////////////////////////

function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}
function poxy_login_remember_me_checked() {
	add_filter( 'login_footer', 'rememberme_checked' );
}

//add_action( 'init', 'poxy_login_remember_me_checked' );








//////////////////////////////////////////////////////////////
// Hide Core Plugins
/////////////////////////////////////////////////////////////

function poxy_hide_plugins($plugins) {
	// Hide disqus plugin
	// if(is_plugin_active('disqus-comment-system/disqus.php')) {
	// 	unset( $plugins['disqus-comment-system/disqus.php'] );
	// }
	return $plugins;
}

//add_filter( 'all_plugins', 'poxy_hide_plugins');









//////////////////////////////////////////////////////////////
// Disable changing the theme for anyone a part from the admin user
//////////////////////////////////////////////////////////////

function poxy_disable_changing_theme_for_non_admin() {
	global $submenu, $userdata;
	get_currentuserinfo();
	if ($userdata->ID != 1) {
		unset($submenu['themes.php'][5]);
	}
}

//add_action('admin_init', 'poxy_disable_changing_theme_for_non_admin');







//////////////////////////////////////////////////////////////
// Hide Wordpress update notice
//////////////////////////////////////////////////////////////
function poxy_hide_update_nag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','poxy_hide_update_nag');






//////////////////////////////////////////////////////////////
// Disable Admin Bar for everyone
/////////////////////////////////////////////////////////////

function poxy_disable_admin_bar() {

		// for the admin page
		remove_action('admin_footer', 'wp_admin_bar_render', 1000);
		// for the front-end
		remove_action('wp_footer', 'wp_admin_bar_render', 1000);

		// css override for the admin page
		function poxy_remove_admin_bar_style_backend() {
			echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
		}
		add_filter('admin_head','poxy_remove_admin_bar_style_backend');

		// css override for the frontend
		function poxy_remove_admin_bar_style_frontend() {
			echo '<style type="text/css" media="screen">
			html { margin-top: 0px !important; }
			* html body { margin-top: 0px !important; }
			</style>';
		}
		add_filter('wp_head','poxy_remove_admin_bar_style_frontend', 99);
  	}

$hide_admin_bar = of_get_option('poxy_hide_admin_bar');
if($hide_admin_bar == true) {
add_action('init','poxy_disable_admin_bar');
}






//////////////////////////////////////////////////////////////
// Style Admin Bar
/////////////////////////////////////////////////////////////
//  http://halfelf.org/2011/customize-wp-admin-bar/

function poxy_custom_admin_bar_styles() {
	if ( is_user_logged_in() ) {
        ?>
        <style type="text/css">
        #wp-admin-bar-wp-logo{display:none;}
        header#header {top:28px !important;}
        #wpadminbar .quicklinks li#wp-admin-bar-ipstenu-account-with-avatar>a{border-left:none;background:url(http://ipstenu.org/wp-includes/images/admin-bar-sprite.png?d=11122010) top left no-repeat;}
        #wpadminbar .quicklinks li#wp-admin-bar-ipstenu-account-with-avatar>a img{width:16px;height:16px;display:inline;border:1px solid #999;vertical-align:middle;margin:-2px 23px 0 -5px;padding:0;background:#eee;float:none;}
        #wpadminbar .quicklinks li#wp-admin-bar-ipstenu-account-with-avatar ul{left:30px;}
        #wpadminbar .quicklinks li#wp-admin-bar-ipstenu-account-with-avatar ul ul{left:0;}
        #wpadminbar .quicklinks .menupop li a img.blavatar{vertical-align:middle;margin:0 8px 0 0;padding:0;}
        </style>
    <?php }
?>
<?php
}

//add_action('wp_head', 'poxy_custom_admin_bar_styles');




//////////////////////////////////////////////////////////////
// Remove Dashboard Menu Sections for lower level users
/////////////////////////////////////////////////////////////
if (!current_user_can('manage_options')) {

	function poxy_remove_menu_options() {
		//remove_menu_page('edit.php');
		remove_menu_page('link-manager.php');
		//remove_menu_page('themes.php');
		remove_menu_page('tools.php');
		remove_menu_page('upload.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('plugins.php');
		remove_submenu_page( 'index.php', 'update-core.php');
		remove_submenu_page( 'options-general.php', 'options-media.php' );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
		remove_submenu_page('themes.php', 'theme-install.php' );
	}

	add_action( 'admin_menu', 'poxy_remove_menu_options' );
}

//////////////////////////////////////////////////////////////
// Check Wordpress Version
//////////////////////////////////////////////////////////////

if ( ! function_exists( 'poxy_is_version' ) ) {
	function poxy_is_version( $version = '8.0' ) {
		global $wp_version;
		if ( version_compare( $wp_version, $version, '>=' ) ) {

			return false;
		}
		return true;
	}
}


//////////////////////////////////////////////////////////////
// Custom Dashboard Styles
//////////////////////////////////////////////////////////////

// function poxy_admin_styles() {
//     wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/admin.css' );
// }
//
// if ( $wp_version >= 3.8 ) {
//      add_action('admin_enqueue_scripts', 'poxy_admin_styles');
// }


//////////////////////////////////////////////////////////////
// force one-column dashboard
//////////////////////////////////////////////////////////////
function shapeSpace_screen_layout_columns($columns) {
	$columns['dashboard'] = 1;
	return $columns;
}
add_filter('screen_layout_columns', 'shapeSpace_screen_layout_columns');

function shapeSpace_screen_layout_dashboard() { return 1; }
add_filter('get_user_option_screen_layout_dashboard', 'shapeSpace_screen_layout_dashboard');


//////////////////////////////////////////////////////////////
// Custom Login Page
//////////////////////////////////////////////////////////////

// function poxy_login_styles() {
// 	wp_enqueue_style( 'poxy_login_styles', get_template_directory_uri() . '/assets/login.css', true );
// }
//
// // changing login logo url to home
// function poxy_login_url() {  return home_url(); }
//
// // change the alt text on login logo
// function poxy_login_title() { return get_option('blogname'); }
//
// // calling it only on the login page
// add_action( 'login_enqueue_scripts', 'poxy_login_styles', 10 );
// add_filter('login_headerurl', 'poxy_login_url');
// add_filter('login_headertitle', 'poxy_login_title');
