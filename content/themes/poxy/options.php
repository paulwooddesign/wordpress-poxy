<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$theme = wp_get_theme();
	$themename = $theme->Name;
	$themename = preg_replace("/\W/", "", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Home Project Type
	$home_project_type = array("all" => "All projects", "featured" => "Featured");

	$page_head_size = array("tera" => "Tera", "giga" => "Giga", "mega" => "Mega", "alpha" => "Alpha", "beta" => "Beta", "gamma" => "Gamma", "delta" => "Delta", "epsilon" => "Epsilon", "zeta" => "Zeta");
	$background_size = array("cover" => "Cover", "contain" => "Contain", "repeat" => "Repeat", "repeat-x" => "Repeat X", "repeat-y" => "Repeat Y");
	$background_position = array("center" => "Center", "top" => "Top", "right" => "Right", "bottom" => "Bottom", "left" => "Left");
	$background_repeat = array("repeat" => "Repeat", "repeat-x" => "Repeat X", "repeat-y" => "Repeat Y");

	$menu_type = array("block" => "Block", "parallax" => "Parallax");


	$header_position = array(
		"fixed-top" => "Fixed Top",
		"fixed-bottom" => "Fixed Bottom",
		"absolute-top" => "Absolute Top"
	);



	$home_slideshows = array(
		"flexslider-full-screen" => "Flexslider Full Screen",
		"flexslider" => "Flexslider Basic",
		"royal" => "Royal Basic"
		);



	// Thumb Ratios
	$home_page_thumbs_per_row = array("one_half" => "Two", "one_third" => "Three", "one_fourth" => "Four", "one_fifth" => "Five", "one_sixth" => "Six");

	// Post Featured Image Size
	$post_featured_image_size = array("large" => "Large", "small" => "Small");

	// Slideshow Transition Effect
	$slideshow_effect = array("slide" => "Slide", "fade" => "Fade");

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';

	$options = array();




	///////////////////////////////////////
	//  GENERAL
	//////////////////////////////////////

	$options[] = array( "name" => __('General','poxy'),
						"type" => "heading");


	$options[] = array( "name" => __('Logo','poxy'),
				"desc" => __('Upload a custom logo.','poxy'),
				"id" => "logo",
				"type" => "upload");


	$options[] = array( "name" => __('Favicon','poxy'),
					"desc" => __('Upload a custom favicon.','poxy'),
					"id" => "poxy_favicon",
					"type" => "upload");



	$options[] = array( "name" => __('Custom CSS','poxy'),
						"desc" => __('Enter custom CSS here.','poxy'),
						"id" => "poxy_custom_css",
						"std" => "",
						"type" => "textarea");












	///////////////////////////////////////
	//  Posts
	//////////////////////////////////////
	$options[] = array( "name" => __('Blog','poxy'),
						"type" => "heading");

	$options[] = array( "name" => __('Sub Title','poxy'),
					"desc" => __('Enter the blog sub title.','poxy'),
					"id" => "poxy_blog_sub_title",
					"std" => "",
					"type" => "text");

	$options[] = array( "name" => __('Description','poxy'),
					"desc" => __('Enter the blog description.','poxy'),
					"id" => "poxy_blog_description",
					"std" => "",
					"type" => "text");

	$options[] = array( "name" => __('Blog Banner Image','poxy'),
					"desc" => __('Upload a blog page banner image.','poxy'),
					"id" => "poxy_blog_banner",
					"type" => "upload");

	$options[] = array( "name" => "Select a Page",
						"desc" => "Select the page you're using as your blog page. This is used to show the blog title at the top of your posts.",
						"id" => "poxy_blog_page",
						"type" => "select",
						"options" => $options_pages);

	$options[] = array( "name" => __('Show Author','poxy'),
						"desc" => __('Check this box to show the author.','poxy'),
						"id" => "poxy_post_show_author",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show Date','poxy'),
						"desc" => __('Check this box to show the publish date.','poxy'),
						"id" => "poxy_post_show_date",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show Category','poxy'),
						"desc" => __('Check this box to show the category.','poxy'),
						"id" => "poxy_post_show_category",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show Comment Count','poxy'),
						"desc" => __('Check this box to show the comment count.','poxy'),
						"id" => "poxy_post_show_comments",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Featured Image Size','poxy'),
						"desc" => __('Select the size of the post featured image.','poxy'),
						"id" => "poxy_post_featured_img_size",
						"std" => "large",
						"type" => "select",
						"options" => $post_featured_image_size);

	$options[] = array( "name" => __('Show Featured Image on Single Posts','poxy'),
						"desc" => __('Check this box to show the featured image on single post pages.','poxy'),
						"id" => "poxy_post_show_featured_image",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show Featured Image on Home Page','poxy'),
						"desc" => __('Check this box to show the featured image on the home page template.','poxy'),
						"id" => "poxy_post_show_featured_image_on_home",
						"std" => "",
						"type" => "checkbox");

	$options[] = array( "name" => __('Enable Full Width Blog','poxy'),
						"desc" => __('Check this box to make your posts span the width of the page.','poxy'),
						"id" => "poxy_post_full_width",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show Full Posts','poxy'),
						"desc" => __('Check this box to show full posts instead of excerpts on index and archive pages.','poxy'),
						"id" => "poxy_post_show_full",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('Read More Link Title','poxy'),
				"desc" => __('Main Title.','poxy'),
				"id" => "poxy_read_more_title",
				"std" => "Read More",
				"type" => "text");


	$options[] = array( "name" => __('Disqus Shortname','poxy'),
					"desc" => __('Enter your disqus shortname.','poxy'),
					"id" => "poxy_disqus_shortname",
					"std" => "",
					"type" => "text");





	///////////////////////////////////////
	//  Footer
	//////////////////////////////////////
	// $options[] = array( "name" => __('Footer','poxy'),
	// 					"type" => "heading");

	// $options[] = array( "name" => __('Left Footer Text','poxy'),
	// 					"desc" => __('This will appear on the left side of the footer.','poxy'),
	// 					"id" => "poxy_footer_left",
	// 					"std" => "",
	// 					"type" => "textarea");

	// $options[] = array( "name" => __('Right Footer Text','poxy'),
	// 					"desc" => __('This will appear on the right side of the footer.','poxy'),
	// 					"id" => "poxy_footer_right",
	// 					"std" => "",
	// 					"type" => "textarea");

	// $options[] = array( "name" => __('Facebook Likes','poxy'),
	// 					"desc" => __('Check this box to display an Facebook likes.','poxy'),
	// 					"id" => "poxy_show_facebook_likes",
	// 					"std" => "0",
	// 					"type" => "checkbox");




	// $options[] = array( "name" => __('Google Map Address','poxy'),
	// 					"desc" => __('Enter the address to display on your Google Map.','poxy'),
	// 					"id" => "poxy_google_map_address",
	// 					"std" => "",
	// 					"type" => "textarea");

	// $options[] = array( "name" => __('Google Map Height','poxy'),
	// 					"desc" => __('Enter a height in pixels for your Google Map.','poxy'),
	// 					"id" => "poxy_google_map_height",
	// 					"std" => "350",
	// 					"type" => "text");

	// $options[] = array( "name" => __('Google Map Tint Color','poxy'),
	// 					"desc" => __('Select a tint color for your Google Map.','poxy'),
	// 					"id" => "poxy_google_map_tint",
	// 					"std" => "#79d1bb",
	// 					"type" => "color");




	///////////////////////////////////////
	//  Social Networks
	//////////////////////////////////////

	$options[] = array( "name" => __('Social','poxy'),
						"type" => "heading");

	$options[] = array( "name" => __('Facebook Likes (Facebook ID)','poxy'),
					"desc" => __('Enter the facebook page ID. Example (https://www.facebook.com/<stong>FACEBOOK_ID</strong>)','poxy'),
					"id" => "poxy_facebook_page_id",
					"std" => "",
					"type" => "text");

	$options[] = array( "name" => __('Social Network Icons','poxy'),
						"desc" => __('Check this box to show footer widgets.','poxy'),
						"id" => "poxy_social_icons",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Facebook','poxy'),
						"desc" => __('Facebook URL.','poxy'),
						"id" => "poxy_facebook_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Twitter','poxy'),
						"desc" => __('Twitter URL.','poxy'),
						"id" => "poxy_twitter_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Tumblr','poxy'),
						"desc" => __('Tumblr URL.','poxy'),
						"id" => "poxy_tumblr_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Google','poxy'),
						"desc" => __('Google URL.','poxy'),
						"id" => "poxy_google_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Linkedin','poxy'),
						"desc" => __('Linkedin URL.','poxy'),
						"id" => "poxy_linkedin_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Pinterest','poxy'),
						"desc" => __('Pinterest URL.','poxy'),
						"id" => "poxy_pinterest_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Vimeo','poxy'),
						"desc" => __('Vimeo URL.','poxy'),
						"id" => "poxy_vimeo_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('YouTube','poxy'),
						"desc" => __('YouTube URL.','poxy'),
						"id" => "poxy_youtube_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Instagram','poxy'),
						"desc" => __('Instagram URL.','poxy'),
						"id" => "poxy_instagram_url",
						"std" => "",
						"type" => "text");

	///////////////////////////////////////
	//  Typography
	//////////////////////////////////////

	// $options[] = array( "name" => __('Typography','poxy'),
	// 					"type" => "heading");
	//
	//
	// $options[] = array( "name" => __('Paragraph Color','poxy'),
	// 				"desc" => __('Select body text color.','poxy'),
	// 				"id" => "poxy_color_body",
	// 				"std" => "",
	// 				"type" => "color");
	//
	// $options[] = array( "name" => __('Paragraph Font','poxy'),
	// 				"desc" => __('Enter the name of the <a href="http://www.google.com/webfonts" target="_blank">Google Web Font</a> you want to use for the body text.','poxy'),
	// 				"id" => "poxy_body_font",
	// 				"std" => "",
	// 				"type" => "text");
	//
	// $options[] = array( "name" => __('Paragraph Line Height','poxy'),
	// 					"desc" => __('Paragraph Line Height (ems)','poxy'),
	// 					"id" => "poxy_paragraph_line_height",
	// 					"std" => "1.725",
	// 					"type" => "text");
	//
	// $options[] = array( "name" => __('Paragraph Letter Spacing','poxy'),
	// 					"desc" => __('Paragraph letter spacing (ems)','poxy'),
	// 					"id" => "poxy_paragraph_letter_spacing",
	// 					"std" => "0.03",
	// 					"type" => "text");
	//
	// $options[] = array( "name" => __('Heading Text Color','poxy'),
	// 		"desc" => __('Select heading text color. (h1, h2, h3, h4, h5, h6)','poxy'),
	// 		"id" => "poxy_color_heading",
	// 		"std" => "",
	// 		"type" => "color");
	//
	//
	// $options[] = array( "name" => __('Heading Font','poxy'),
	// 					"desc" => __('Enter the name of the <a href="http://www.google.com/webfonts" target="_blank">Google Web Font</a> you want to use for headings.','poxy'),
	// 					"id" => "poxy_heading_font",
	// 					"std" => "",
	// 					"type" => "text");
	//
	//
	// $options[] = array( "name" => __('Heading Line Height','poxy'),
	// 				"desc" => __('Heading Line Height (ems)','poxy'),
	// 				"id" => "poxy_heading_line_height",
	// 				"std" => "",
	// 				"type" => "text");
	//
	// $options[] = array( "name" => __('Heading Letter Spacing','poxy'),
	// 					"desc" => __('Heading letter spacing (ems)','poxy'),
	// 					"id" => "poxy_heading_letter_spacing",
	// 					"std" => "",
	// 					"type" => "text");
	//
	//
	//
	//
	// $options[] = array( "name" => __('Heading Weight','poxy'),
	// 				"desc" => __('Heading Font Weight (300, 500, 800, bold, light, normal)','poxy'),
	// 				"id" => "poxy_heading_weight",
	// 				"std" => "",
	// 				"type" => "text");
	//
	// $options[] = array( "name" => __('Font for Sub Headings','poxy'),
	// 					"desc" => __('Enter the name of the <a href="http://www.google.com/webfonts" target="_blank">Google Web Font</a> you want to use for sub headings.','poxy'),
	// 					"id" => "poxy_sub_heading_font",
	// 					"std" => "",
	// 					"type" => "text");
	//
	//
	//
	// $options[] = array( "name" => __('Font for Main Menu','poxy'),
	// 					"desc" => __('Enter the name of the <a href="http://www.google.com/webfonts" target="_blank">Google Web Font</a> you want to use for the main menu.','poxy'),
	// 					"id" => "poxy_menu_font",
	// 					"std" => "",
	// 					"type" => "text");




	///////////////////////////////////////
	//  Development
	//////////////////////////////////////
	$options[] = array( "name" => __('DEV','poxy'),
						"type" => "heading");

	$options[] = array( "name" => __('Wordpress Admin Bar.','poxy'),
						"desc" => __('Hide admin bar.','poxy'),
						"id" => "poxy_hide_admin_bar",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('DEV Styles.','poxy'),
						"desc" => __('Show DEV Styles.','poxy'),
						"id" => "poxy_dev_styles",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('Option Styles.','poxy'),
					"desc" => __('Hide Options Styles.','poxy'),
					"id" => "poxy_option_styles",
					"std" => "0",
					"type" => "checkbox");

	$options[] = array( "name" => __('Placeholder Text Color','poxy'),
			"desc" => __('','poxy'),
			"id" => "poxy_placeholder_text_color",
			"std" => "#666",
			"type" => "color");

	$options[] = array( "name" => __('Placeholder Background Color','poxy'),
			"desc" => __('','poxy'),
			"id" => "poxy_placeholder_background_color",
			"std" => "#ccc",
			"type" => "color");

	$options[] = array( "name" => __('Placeholder Text','poxy'),
						"desc" => __('Enter Placeholder Text.','poxy'),
						"id" => "poxy_placeholder_text",
						"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae mi gravida, imperdiet nisi non, egestas elit. Vivamus quis dapibus lectus. Aliquam in ornare urna. Donec aliquam eu neque eu facilisis. Fusce venenatis, ipsum at sagittis tincidunt, tellus arcu elementum ipsum, non tincidunt lorem velit ut nisl. Curabitur vulputate metus tortor. Fusce volutpat rutrum nunc, vel luctus lorem egestas eu. Etiam viverra quam in sapien mollis, quis egestas quam gravida. Morbi nec orci vulputate, volutpat magna in, placerat nisl. Vivamus luctus dui id gravida fermentum. Etiam aliquam urna dolor, eget ornare turpis tempus in. Nam id eros eget mi suscipit rutrum.
Ut rutrum posuere mauris. Nulla auctor ac leo at rutrum. Ut ultrices, mauris vitae faucibus lacinia, magna magna condimentum felis, non aliquet lorem purus eget leo. Nam id augue quis tortor tristique porttitor in ac turpis. Aliquam ullamcorper nulla id volutpat accumsan. Fusce interdum at magna at condimentum. Etiam vitae dolor faucibus, venenatis dui vitae, vulputate ipsum. Ut at tincidunt felis, at consectetur diam. Nulla consequat sodales fringilla.
Phasellus tristique enim lorem, id vehicula risus egestas id. Quisque suscipit non nunc vitae vestibulum. Morbi porttitor turpis vehicula sollicitudin suscipit. Duis feugiat dapibus risus vel posuere. In placerat mi vel dapibus dictum. Nulla vitae sem lacinia, volutpat orci eget, dapibus dui. Cras sed rhoncus odio. Fusce luctus rutrum est sit amet tristique. Pellentesque tincidunt quam eget condimentum ornare. Vivamus odio sapien, lacinia vitae fermentum vitae, dictum et felis. Morbi vitae urna ultrices, imperdiet quam et, imperdiet augue. Quisque imperdiet elementum diam, a vestibulum nulla rhoncus eget. Ut et interdum turpis, vel euismod justo.
Maecenas molestie sapien at ipsum blandit ultrices nec in dui. Morbi pellentesque pretium felis, at blandit justo lacinia nec. Suspendisse ultrices bibendum tristique. Curabitur adipiscing laoreet risus. Fusce convallis tempor mi quis consequat. In rutrum ligula at augue dictum, nec ultricies massa pretium. Donec molestie condimentum sagittis. Proin auctor laoreet nisi, eu cursus lorem vestibulum eu. Fusce vestibulum arcu a nibh cursus, nec congue mi convallis.
						",
						"type" => "textarea",
						"validate" => "none");






	return $options;
}
