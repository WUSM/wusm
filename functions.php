<?php

if( WP_DEBUG ) { add_filter( 'http_request_host_is_external',  function() { return true; } ); }

if( !WP_DEBUG ) {
	add_action( 'admin_menu', 'acf_remove_menu_page' );
}

if ( ! isset( $content_width ) ) $content_width = 645;

add_filter( 'acf/settings/load_json', function( $paths ) { $paths[] = get_template_directory() . '/acf-json'; return $paths; } );

function acf_remove_menu_page() {
	remove_menu_page( 'edit.php?post_type=acf-field-group' );
}

add_action('acf/include_field_types', function() { include_once( get_template_directory() . '/_/php/acf_fields.php' ); }, 20);
include_once( get_template_directory() . '/_/php/left-nav.php' );

// Customize the footer in admin area
function wpfme_footer_admin () {
	echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');

// Intialize all the theme options
function theme_init() {
	// Create Header and Footer Menu theme locations
	register_nav_menus(
		array( 'header-menu' => 'Header Menu', 'footer-menu' => 'Footer Menu', )
	);

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
	$theme = wp_get_theme();
	wp_enqueue_style( 'wusm', get_stylesheet_uri(), false, $theme->get( 'Version' ) );
	wp_deregister_style( 'open-sans' ); // De-register open-sans so we can add the 700 (bold) weight
	wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C700italic%2C300%2C400%2C600%2C700&subset=latin%2Clatin-ext' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script('wusm_functions', get_template_directory_uri() . '/_/js/functions.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'wusm_scripts' );

function create_default_wusm_settings() {

	if ( get_option( 'wusm_theme_setup_done', false ) ) {
		return;
	}

	if ( ! ( get_option( 'show_on_front' ) === 'page' ) ) {

		$home_page_title   = 'Headline capturing the value or service your group provides';
		$home_page_content = '<p>Briefly explain who you are, what you do, and – if it isn\'t clear – who you serve. Prepare your website\'s visitors to click on the button that follows. The button should link to the most important action or information on your website. (273 characters max)</p><p><a href="#" class="wusm-button">Important Link</a></p>';
		$home_page         = array(
			'post_type'    => 'page',
			'post_title'   => $home_page_title,
			'post_content' => $home_page_content,
			'post_status'  => 'publish',
			'post_name'    => 'home',
		);
		$home_page_id      = wp_insert_post( $home_page );

		// Add Featured Image to Post
		$image_url  = 'https://medicine.wustl.edu/wp-content/uploads/tierone-default.jpg';
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents( $image_url );
		$filename   = basename( $image_url );

		// Check folder permission and define file location
		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
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
			'post_status'    => 'inherit',
		);

		$post_id = get_page_by_title( $home_page_title );

		// Create the attachment
		$attach_id = wp_insert_attachment( $attachment, $file, 0 );

		require_once ABSPATH . 'wp-admin/includes/image.php';

		// Define attachment metadata
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

		// Assign metadata to attachment
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// Assign featured image to post
		set_post_thumbnail( $post_id, $attach_id );

		update_option( 'page_on_front', $home_page_id );
		update_option( 'show_on_front', 'page' );
	}

	if ( ! is_nav_menu( 'Header' ) ) {
		// Create Header menu, if it doesn't already exist
		$menu_id = wp_create_nav_menu( 'Header', array( 'slug' => 'header' ) );

		// Add Home to the Header menu
		$menu_item = array(
			'menu-item-object-id' => get_option( 'page_on_front' ),
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-title'     => 'Home',
		);
		wp_update_nav_menu_item( $menu_id, 0, $menu_item );

		// If Sample Page exists, add to the Header menu
		if ( get_page_by_title( 'Sample Page' ) ) {
			$page      = get_page_by_title( 'Sample Page' );
			$menu_item = array(
				'menu-item-object-id' => $page->ID,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item );
		}
	}

	if ( ! is_nav_menu( 'Footer' ) ) {
		// Create Footer menu, if it doesn't already exist
		wp_create_nav_menu( 'Footer', array( 'slug' => 'footer' ) );
	}

	// Assign Header and Footer menus to their appropriate theme locations
	$menu_id        = wp_get_nav_menu_object( 'Header' );
	$header_id      = $menu_id->term_id;
	$footer_menu_id = wp_get_nav_menu_object( 'Footer' );
	$footer_id      = $footer_menu_id->term_id;
	set_theme_mod(
		'nav_menu_locations',
		array(
			'header-menu' => $header_id,
			'footer-menu' => $footer_id,
		)
	);
	update_option( 'wusm_theme_setup_done', true );

}
add_action( 'after_switch_theme', 'create_default_wusm_settings');

// Set default timezone
function set_timezone() {
	update_option( 'timezone_string', 'America/Chicago' );
}
add_action( 'init', 'set_timezone' );

function enable_editor_styles() {
	add_editor_style( 'editor-style.css' );
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

// Remove Customize from admin menu
function remove_customize_page(){
	global $submenu;
	unset($submenu['themes.php'][6]);
}
add_action( 'admin_menu', 'remove_customize_page');

// Remove Customize from toolbar
function remove_customize() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remove_customize' );

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
			'title'	=> 'WUSM Accordion Styles',
			'items'	=> array(
				array(
					'title'    => 'Accordion Header',
					'block' => 'div',
					'classes'  => 'accordion-header',
					'wrapper' => true
				),
				array(
					'title'   => 'Accordion Body Text',
					'block'   => 'div',
					'classes' => 'accordion-body-text',
					'wrapper' => true
				)
			),
		),
		array(
			'title' => 'Signature',
			'items' => array(
				array(
					'title'		=> 'Name',
					'block'		=> 'p',
					'classes'	=> 'signature-name',
					'wrapper'	=> false
				),
				array(
					'title'		=> 'Title(s)',
					'block'		=> 'p',
					'classes'	=> 'signature-title',
					'wrapper'	=> false
				)
			)
		),
		array(
			'title' => 'Custom Styles',
			'items' => array(
				array(
					'title'		=> 'Intro Text',
					'block'		=> 'p',
					'classes'	=> 'intro-text',
					'wrapper'	=> false
				),
				array(
					'title'	   => 'Callout',
					'block'	   => 'div',
					'classes'  => 'callout',
					'wrapper'  => true
				),
				array(
					'title'		=> 'Disclaimer',
					'block'		=> 'div',
					'classes'	=> 'disclaimer',
					'wrapper'	=> true
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

function accordion_shortcode( $atts, $content = null ) {
	return "<p class='expand-all'>Expand all</p>";
}
add_shortcode( 'wusm_expand_all', 'accordion_shortcode' );

// Remove h1 option from dropdown in editor
function wusm_remove_h1($arr){
	$arr['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
	return $arr;
  }
add_filter('tiny_mce_before_init', 'wusm_remove_h1');

// Image sizes (Settings / Media)
function wusm_image_settings() {
	update_option('medium_size_w', 300);
	update_option('medium_size_h', NULL);
	update_option('large_size_w', 645);
	update_option('large_size_h', NULL);
	update_option('embed_size_w', 645);
}
add_filter( 'after_switch_theme', 'wusm_image_settings' );

add_image_size('headshot', 145, 200, true);

function wusm_image_size_choose( $sizes ) {
	$custom_sizes = array(
		'headshot' => 'Headshot',
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter( 'image_size_names_choose', 'wusm_image_size_choose' );

// Set default values for Attachment Display Settings
function attachment_display_settings() {
	update_option('image_default_align', 'none' );
	update_option('image_default_link_type', 'none' );
	update_option('image_default_size', 'large' );
}
add_action( 'after_setup_theme', 'attachment_display_settings' );

function wusm_button() {
	add_filter( 'mce_external_plugins', 'wusm_add_button' );
	add_filter( 'mce_buttons', 'wusm_register_button' );
}
function wusm_add_button( $plugin_array ) {
	$plugin_array['wusmbutton'] = get_template_directory_uri() . '/_/js/wusmbutton.js';
	$plugin_array['wusm_columns'] = get_template_directory_uri() . '/_/js/wusm-columns.js';
	return $plugin_array;
}
function wusm_register_button( $buttons ) {
	if( ! in_array( 'wusmbutton', $buttons) ) {
		array_push( $buttons, 'wusmbutton' );
	}
	if( ! in_array( 'wusm_columns', $buttons) ) {
		array_push( $buttons, 'wusm_columns' );
	}
	return $buttons;
}
add_action( 'admin_head', 'wusm_button' );



function wusm_media_file_size($column_name, $post_ID) {
	if ($column_name == 'size') {
		echo human_filesize( filesize( get_attached_file( $post_ID ) ) );
	}
}
add_action('manage_media_custom_column', 'wusm_media_file_size', 10, 2);

if (!function_exists('human_filesize')) {
    function human_filesize($bytes, $decimals = 2) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}

function wusm_add_media_file_size( $posts_columns ) {
	$posts_columns['size'] = 'File Size';
	return $posts_columns;
}
add_filter( 'manage_media_columns', 'wusm_add_media_file_size', 10, 1 );

add_action( 'customize_register', 'prefix_remove_css_section', 15 );
/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * @param $wp_customize WP_Customize_Manager
 */
function prefix_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
