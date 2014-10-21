<?php

if(!defined('WP_LOCAL_INSTALL')) {
	require_once( get_template_directory() . '/_/php/acf_fields.php' );
}

require_once( get_template_directory() . '/_/php/custom_post_types.php' );
require_once( get_template_directory() . '/_/php/load_js.php' );
require_once( get_template_directory() . '/_/php/left-nav.php' );


// Customize the footer in admin area
function wpfme_footer_admin () {
	echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');


// Intialize all the theme options
function theme_init() {
	// Create Header Menu theme location
	register_nav_menus(
		array( 'header-menu' => 'Header Menu' )
	);

	register_sidebar();

	// Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Manual excerpts for pages as well as posts
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'theme_init' );


/**
 * Enqueue scripts and styles.
 */
function wusm_scripts() {
	/**
	 * The admin bar enqueues these two when a user is logged in, we need manually include
	 * them if they aren't logged in.  Actually, need to check if dashicons is enqueued
	 * because even if a user is logged in it won't enqueue if the admin bar isn't displayed
	 */
	if ( !wp_style_is( 'dashicons-css' ) ) {
		wp_enqueue_style( 'open-sans-css', '//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext' );
		wp_enqueue_style( 'dashicons-css', '/wp-includes/css/dashicons.min.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'wusm_scripts' );


function create_default_wusm_settings() {

	// Create default homepage on theme activation
	function the_slug_exists($post_name) {
		global $wpdb;
		if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
			return true;
		} else {
			return false;
		}
	}
	if (isset($_GET['activated']) && is_admin()){
	    $home_page_title = 'Headline capturing the value or service you provide';
	    $home_page_content = 'Briefly explain who you are, what you do, and – if it isn\'t clear – who you serve. Prepare your website\'s visitors to click on the button that follows. It should link to the most important action or information on your website. (273 characters max) <div class="call-to-action"><p><a href="#">Important Link</a></p></div>';
	    $home_page_check = get_page_by_title($home_page_title);
	    $home_page = array(
		    'post_type' => 'page',
		    'post_title' => $home_page_title,
		    'post_content' => $home_page_content,
		    'post_status' => 'publish',
		    'post_name' => 'home'
	    );
	    if(!isset($home_page_check->ID) && !the_slug_exists('home')){
	        $home_page_id = wp_insert_post($home_page);
	    }
	}
	if (isset($_GET['activated']) && is_admin()){
		// Use a static front page
		$homepage = get_page_by_title($home_page_title);
		if ( $homepage )
		{
		    update_option( 'page_on_front', $homepage->ID );
		    update_option( 'show_on_front', 'page' );
		}
	}

	// Add Featured Image to Post
	$image_url  = 'http://mpaweb1.wustl.edu/~medschool/tierone-default.jpg';
	$upload_dir = wp_upload_dir();
	$image_data = file_get_contents($image_url);
	$filename   = basename($image_url);

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
	    $file = $upload_dir['path'] . '/' . $filename;
	} else {
	    $file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
	    'post_mime_type' => $wp_filetype['type'],
	    'post_title'     => sanitize_file_name( $filename ),
	    'post_content'   => '',
	    'post_status'    => 'inherit'
	);

	$post_id = get_page_by_title($home_page_title);
	
	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );


	if ( !is_nav_menu( 'Header' )) {
		// Create Header menu, if it doesn't already exist
		$menu_id = wp_create_nav_menu( 'Header', array( 'slug' => 'header' ) );

		// Add Home to the Header menu
		$menu_item = array(
			'menu-item-object-id' => get_option('page_on_front'),
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-title'	  => 'Home'
		);
		wp_update_nav_menu_item( $menu_id, 0, $menu_item );

		// Add Sample Page to the Header menu
		$page = get_page_by_title('Sample Page');
		$menu_item = array(
			'menu-item-object-id' => $page->ID,
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish'
		);
		wp_update_nav_menu_item( $menu_id, 0, $menu_item );

		// Assign Header menu to the Header Menu theme location
		$locations = get_theme_mod('nav_menu_locations');
		$locations['header-menu'] = $menu_id;
		set_theme_mod('nav_menu_locations', $locations);
	}
}
add_action( 'after_switch_theme', 'create_default_wusm_settings');


// Set default timezone
function set_timezone() {
	update_option( 'timezone_string', 'America/Chicago' );
}
add_action( 'init', 'set_timezone' );


function enable_editor_styles() {
	add_editor_style( '_/css/editor-style.css' );
}
add_action( 'init', 'enable_editor_styles' );


/*********************
WP_HEAD GOODNESS
The default WordPress head is a mess. Let's clean it up by
removing all the junk we don't need.
*********************/
function head_cleanup() {
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );
} /* end bones head cleanup */
add_action('init', 'head_cleanup');


// Remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}


// Remove WP version from RSS
function strip_rss_version() { return ''; }
add_filter('the_generator', 'strip_rss_version');


// Hide admin bar for subscribers. Probably won't be needed, but just in case.
function cc_hide_admin_bar() {
	if (!current_user_can('edit_posts')) {
		show_admin_bar(false);
	}
}
add_action('set_current_user', 'cc_hide_admin_bar');


// Remove height and width attributes from images so that we can make them responsive
function remove_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_dimensions', 10 );
add_filter( 'the_content', 'remove_dimensions', 10 );


// Remove extra 10px from width of wp-caption div
// http://troychaplin.ca/2012/fix-automatically-generated-inline-style-on-wordpress-image-captions/
function fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;
	extract(shortcode_atts(array(
		'id'    => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	if ( 1 > (int) $width || empty($caption) )
		return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// Add style selector drop down on the second row of the Visual editor
function wusm_mce_buttons_2( $buttons ) {
	// First, check to see if the style selector is already there
	if ( ( $key = array_search('styleselect',$buttons) ) === false ) {
		array_unshift( $buttons, 'styleselect' );
	}
	return $buttons;
}
add_filter( 'mce_buttons_2', 'wusm_mce_buttons_2' );

// Customize the MCE editor
function customize_mce( $settings ) {

	$new_styles = array(
		array(
			'title' => 'Custom Styles',
			'items' => array(
				array(
					'title'		=> 'Disclaimer',
					'block'		=> 'div',
					'classes'	=> 'disclaimer',
					'wrapper'	=> 'true'
				),
				array(
					'title'		=> 'Call to Action',
					'block'		=> 'div',
					'classes'	=> 'call-to-action',
					'wrapper'	=> 'true'
				)
			)
		)
	);

	// Merge old & new styles
	$settings['style_formats_merge'] = false;

	// Add new styles
	if( ! isset( $settings['style_formats'] ) ) {
		$settings['style_formats'] = json_encode( $new_styles );
	} else {
		$settings['style_formats'] = json_encode( array_merge( json_decode( $settings['style_formats'] ), $new_styles ) );
	}

	// Return New Settings
	return $settings;

}
add_filter('tiny_mce_before_init', 'customize_mce' );


// Image sizes (Settings / Media)
update_option('medium_size_w', 225);
update_option('medium_size_h', NULL);
update_option('large_size_w', 450);
update_option('large_size_h', NULL);
update_option('embed_size_w', 450);

add_image_size( 'right-sidebar', 238, NULL );



// Set default values for Attachment Display Settings
function attachment_display_settings() {
	update_option('image_default_align', 'center' );
	update_option('image_default_link_type', 'none' );
	update_option('image_default_size', 'large' );
}
add_action('after_setup_theme', 'attachment_display_settings');
