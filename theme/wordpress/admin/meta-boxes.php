<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'poxy_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function poxy_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'poxy_';


	function poxy_get_project_array(){
		$options_pages = array();
		$options_pages_obj = get_posts('post_type=project&posts_per_page=99');
		$options_pages[''] = 'Select a project:';
		foreach ($options_pages_obj as $page) {
				$options_pages[$page->ID] = $page->post_title;
		}
		return $options_pages;
	}

	$project_array = poxy_get_project_array();

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'standard',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Standard Fields', 'poxy' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page', 'project', 'recipe' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(

			// SWEET FACTS IMAGE UPLOAD
			array(
				'name' => __( 'Banner Slideshow Images', 'poxy' ),
				'id'   => "{$prefix}banner_slideshow_images",
				'type' => 'image',
			),


			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'Ingredient List', 'poxy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}ingredient_list",
				// Field description (optional)
				//'desc'  => __( 'Text description', 'poxy' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => __( '', 'poxy' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => true,
			),
			// CHECKBOX
			array(
				'name' => __( 'Home Featured', 'poxy' ),
				'id'   => "{$prefix}home_featured",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),

			// CHECKBOX
			array(
				'name' => __( 'Hide Sub Page Heading', 'poxy' ),
				'id'   => "{$prefix}hide_subpage_head",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),

			// COLOR
			array(
				'name' => __( 'Color picker', 'poxy' ),
				'id'   => "{$prefix}color",
				'type' => 'color',
			),

			// TEXTAREA
			array(
				'name' => __( 'Description', 'poxy' ),
				'desc' => __( 'Page Description', 'poxy' ),
				'id'   => "{$prefix}description",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),

			// TEXTAREA
			array(
				'name' => __( 'Ingredients', 'poxy' ),
				'desc' => __( '', 'poxy' ),
				'id'   => "{$prefix}ingredients",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
			// TEXTAREA
			array(
				'name' => __( 'Nutrition Facts', 'poxy' ),
				'desc' => __( 'DO NOT USE "p" tags. It will throw off the accordion', 'poxy' ),
				'id'   => "{$prefix}nutrition_facts",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),

			// Sizes Available
			array(
				'name' => __( 'Sizes Available', 'poxy' ),
				'desc' => __( '', 'poxy' ),
				'id'   => "{$prefix}sizes",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),

			array(
				'name' => __( 'Certifications', 'poxy' ),
				'desc' => __( '', 'poxy' ),
				'id'   => "{$prefix}certifications",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),

			array(
				'name' => __( 'Recipes', 'poxy' ),
				'desc' => __( '', 'poxy' ),
				'id'   => "{$prefix}recipes",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),

			// WYSIWYG/RICH TEXT EDITOR
				// array(
				// 	'name' => __( 'Recipes', 'poxy' ),
				// 	'id'   => "{$prefix}recipes",
				// 	'type' => 'wysiwyg',
				// 	// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				// 	'raw'  => false,
				// 	'std'  => __( 'Recipes', 'poxy' ),
				//
				// 	// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				// 	'options' => array(
				// 		'textarea_rows' => 4,
				// 		'teeny'         => true,
				// 		'media_buttons' => false,
				// 	),
				// ),


			// Sweet List
			array(
				// Field name - Will be used as label
				'name'  => __( 'Sweet List', 'poxy' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}sweet_list",
				// Field description (optional)
				//'desc'  => __( 'Text description', 'poxy' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => __( '', 'poxy' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => true,
			),

			// IMAGE UPLOAD
					array(
						'name' => __( 'Tab Icon Upload', 'poxy' ),
						'id'   => "{$prefix}icon_url",
						'type' => 'image',
					),


			// SELECT BOX
			array(
				'name'     => __( 'Related project 1', 'poxy' ),
				'id'       => "{$prefix}related_1",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => $project_array,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '0'
				//'placeholder' => __( 'Select an Item', 'poxy' ),
			),

			// SELECT BOX
			array(
				'name'     => __( 'Related project 2', 'poxy' ),
				'id'       => "{$prefix}related_2",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => $project_array,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '0'
				//'placeholder' => __( 'Select an Item', 'poxy' ),
			),

			// SELECT BOX
			array(
				'name'     => __( 'Related project 3', 'poxy' ),
				'id'       => "{$prefix}related_3",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => $project_array,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '0'
				//'placeholder' => __( 'Select an Item', 'poxy' ),
			),

			// SELECT BOX
			array(
				'name'     => __( 'Related project 4', 'poxy' ),
				'id'       => "{$prefix}related_4",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => $project_array,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '0'
				//'placeholder' => __( 'Select an Item', 'poxy' ),
			),

			// SWEET FACTS IMAGE UPLOAD
			array(
				'name' => __( 'Sweet Facts Image', 'poxy' ),
				'id'   => "{$prefix}sweet_facts_url",
				'type' => 'image',
			),


			// SWEET FACTS IMAGE UPLOAD
			array(
				'name' => __( 'Sweet Stuff Underline Image', 'poxy' ),
				'id'   => "{$prefix}sweet_stuff_underline",
				'type' => 'image',
			),

			// SWEET FACTS IMAGE UPLOAD
			array(
				'name' => __( 'Sweet Stuff Button', 'poxy' ),
				'id'   => "{$prefix}sweet_stuff_button",
				'type' => 'image',
			),


			// SELECT BOX
			// array(
			// 	'name'     => __( 'Related project 5', 'poxy' ),
			// 	'id'       => "{$prefix}related_5",
			// 	'type'     => 'select',
			// 	// Array of 'value' => 'Label' pairs for select box
			// 	'options'  => $project_array,
			// 	// Select multiple values, optional. Default is false.
			// 	'multiple'    => false,
			// 	'std'         => '0'
			// 	//'placeholder' => __( 'Select an Item', 'poxy' ),
			// ),


		// 	// RADIO BUTTONS
		// 	array(
		// 		'name'    => __( 'Radio', 'poxy' ),
		// 		'id'      => "{$prefix}radio",
		// 		'type'    => 'radio',
		// 		// Array of 'value' => 'Label' pairs for radio options.
		// 		// Note: the 'value' is stored in meta field, not the 'Label'
		// 		'options' => array(
		// 			'value1' => __( 'Label1', 'poxy' ),
		// 			'value2' => __( 'Label2', 'poxy' ),
		// 		),
		// 	),
		// 	// SELECT BOX
		// 	array(
		// 		'name'     => __( 'Select', 'poxy' ),
		// 		'id'       => "{$prefix}select",
		// 		'type'     => 'select',
		// 		// Array of 'value' => 'Label' pairs for select box
		// 		'options'  => array(
		// 			'value1' => __( 'Label1', 'poxy' ),
		// 			'value2' => __( 'Label2', 'poxy' ),
		// 		),
		// 		// Select multiple values, optional. Default is false.
		// 		'multiple'    => false,
		// 		'std'         => 'value2',
		// 		'placeholder' => __( 'Select an Item', 'poxy' ),
		// 	),
		// 	// HIDDEN
		// 	array(
		// 		'id'   => "{$prefix}hidden",
		// 		'type' => 'hidden',
		// 		// Hidden field must have predefined value
		// 		'std'  => __( 'Hidden value', 'poxy' ),
		// 	),
		// 	// PASSWORD
		// 	array(
		// 		'name' => __( 'Password', 'poxy' ),
		// 		'id'   => "{$prefix}password",
		// 		'type' => 'password',
		// 	),
		// 	// TEXTAREA
		// 	array(
		// 		'name' => __( 'Textarea', 'poxy' ),
		// 		'desc' => __( 'Textarea description', 'poxy' ),
		// 		'id'   => "{$prefix}textarea",
		// 		'type' => 'textarea',
		// 		'cols' => 20,
		// 		'rows' => 3,
		// 	),
		// ),
		// 'validation' => array(
		// 	'rules' => array(
		// 		"{$prefix}password" => array(
		// 			'required'  => true,
		// 			'minlength' => 7,
		// 		),
		// 	),
		// 	// optional override of default jquery.validate messages
		// 	'messages' => array(
		// 		"{$prefix}password" => array(
		// 			'required'  => __( 'Password is required', 'poxy' ),
		// 			'minlength' => __( 'Password must be at least 7 characters', 'poxy' ),
		// 		),
		// 	)
		)
	);

	// 2nd meta box
	$meta_boxes[] = array(
		'title' => __( 'Advanced Fields', 'poxy' ),

		'fields' => array(
			// HEADING
			array(
				'type' => 'heading',
				'name' => __( 'Heading', 'poxy' ),
				'id'   => 'fake_id', // Not used but needed for plugin
			),
			// SLIDER
			array(
				'name' => __( 'Slider', 'poxy' ),
				'id'   => "{$prefix}slider",
				'type' => 'slider',

				// Text labels displayed before and after value
				'prefix' => __( '$', 'poxy' ),
				'suffix' => __( ' USD', 'poxy' ),

				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
				'js_options' => array(
					'min'   => 10,
					'max'   => 255,
					'step'  => 5,
				),
			),
			// NUMBER
			array(
				'name' => __( 'Number', 'poxy' ),
				'id'   => "{$prefix}number",
				'type' => 'number',

				'min'  => 0,
				'step' => 5,
			),
			// DATE
			array(
				'name' => __( 'Date picker', 'poxy' ),
				'id'   => "{$prefix}date",
				'type' => 'date',

				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'poxy' ),
					'dateFormat'      => __( 'yy-mm-dd', 'poxy' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			// DATETIME
			array(
				'name' => __( 'Datetime picker', 'poxy' ),
				'id'   => $prefix . 'datetime',
				'type' => 'datetime',

				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute'     => 15,
					'showTimepicker' => true,
				),
			),
			// TIME
			array(
				'name' => __( 'Time picker', 'poxy' ),
				'id'   => $prefix . 'time',
				'type' => 'time',

				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute' => 5,
					'showSecond' => true,
					'stepSecond' => 10,
				),
			),
			// COLOR
			array(
				'name' => __( 'Color picker', 'poxy' ),
				'id'   => "{$prefix}color",
				'type' => 'color',
			),
			// CHECKBOX LIST
			array(
				'name' => __( 'Checkbox list', 'poxy' ),
				'id'   => "{$prefix}checkbox_list",
				'type' => 'checkbox_list',
				// Options of checkboxes, in format 'value' => 'Label'
				'options' => array(
					'value1' => __( 'Label1', 'poxy' ),
					'value2' => __( 'Label2', 'poxy' ),
				),
			),
			// EMAIL
			array(
				'name'  => __( 'Email', 'poxy' ),
				'id'    => "{$prefix}email",
				'desc'  => __( 'Email description', 'poxy' ),
				'type'  => 'email',
				'std'   => 'name@email.com',
			),
			// RANGE
			array(
				'name'  => __( 'Range', 'poxy' ),
				'id'    => "{$prefix}range",
				'desc'  => __( 'Range description', 'poxy' ),
				'type'  => 'range',
				'min'   => 0,
				'max'   => 100,
				'step'  => 5,
				'std'   => 0,
			),
			// URL
			array(
				'name'  => __( 'URL', 'poxy' ),
				'id'    => "{$prefix}url",
				'desc'  => __( 'URL description', 'poxy' ),
				'type'  => 'url',
				'std'   => 'http://google.com',
			),
			// OEMBED
			array(
				'name'  => __( 'oEmbed', 'poxy' ),
				'id'    => "{$prefix}oembed",
				'desc'  => __( 'oEmbed description', 'poxy' ),
				'type'  => 'oembed',
			),
			// SELECT ADVANCED BOX
			array(
				'name'     => __( 'Select', 'poxy' ),
				'id'       => "{$prefix}select_advanced",
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'value1' => __( 'Label1', 'poxy' ),
					'value2' => __( 'Label2', 'poxy' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				// 'std'         => 'value2', // Default value, optional
				'placeholder' => __( 'Select an Item', 'poxy' ),
			),
			// TAXONOMY
			array(
				'name'    => __( 'Taxonomy', 'poxy' ),
				'id'      => "{$prefix}taxonomy",
				'type'    => 'taxonomy',
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'category',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
					'type' => 'checkbox_list',
					// Additional arguments for get_terms() function. Optional
					'args' => array()
				),
			),
			// POST
			array(
				'name'    => __( 'Posts (Pages)', 'poxy' ),
				'id'      => "{$prefix}pages",
				'type'    => 'post',

				// Post type
				'post_type' => 'page',
				// Field type, either 'select' or 'select_advanced' (default)
				'field_type' => 'select_advanced',
				// Query arguments (optional). No settings means get all published posts
				'query_args' => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				)
			),
			// WYSIWYG/RICH TEXT EDITOR
			array(
				'name' => __( 'WYSIWYG / Rich Text Editor', 'poxy' ),
				'id'   => "{$prefix}wysiwyg",
				'type' => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'  => false,
				'std'  => __( 'WYSIWYG default value', 'poxy' ),

				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			// DIVIDER
			array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
			// FILE UPLOAD
			array(
				'name' => __( 'File Upload', 'poxy' ),
				'id'   => "{$prefix}file",
				'type' => 'file',
			),
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => __( 'File Advanced Upload', 'poxy' ),
				'id'   => "{$prefix}file_advanced",
				'type' => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type' => 'application,audio,video', // Leave blank for all file types
			),
			// IMAGE UPLOAD
			array(
				'name' => __( 'Image Upload', 'poxy' ),
				'id'   => "{$prefix}image",
				'type' => 'image',
			),
			// THICKBOX IMAGE UPLOAD (WP 3.3+)
			array(
				'name' => __( 'Thickbox Image Upload', 'poxy' ),
				'id'   => "{$prefix}thickbox",
				'type' => 'thickbox_image',
			),
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
			array(
				'name'             => __( 'Plupload Image Upload', 'poxy' ),
				'id'               => "{$prefix}plupload",
				'type'             => 'plupload_image',
				'max_file_uploads' => 4,
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => __( 'Image Advanced Upload', 'poxy' ),
				'id'               => "{$prefix}imgadv",
				'type'             => 'image_advanced',
				'max_file_uploads' => 4,
			),
			// BUTTON
			array(
				'id'   => "{$prefix}button",
				'type' => 'button',
				'name' => ' ', // Empty name will "align" the button to all field inputs
			),

		)
	);

	return $meta_boxes;
}
