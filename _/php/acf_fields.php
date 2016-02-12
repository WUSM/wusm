<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'    => 'Front Page',
		'menu_title'    => 'Front Page',
		'menu_slug'     => 'front-page',
		'capability'    => 'edit_posts',
		'redirect'      => false,
		'parent'        => 'themes.php',
	));

	acf_add_options_page(array(
		'page_title'    => 'Header',
		'menu_title'    => 'Header',
		'menu_slug'     => 'header',
		'capability'    => 'edit_posts',
		'redirect'      => false,
		'parent'        => 'themes.php',
	));

	acf_add_options_page(array(
		'page_title'    => 'Footer',
		'menu_title'    => 'Footer',
		'menu_slug'     => 'footer',
		'capability'    => 'edit_posts',
		'redirect'      => false,
		'parent'        => 'themes.php',
	));

	function wusm_acf_admin_head() { ?>
		<style type="text/css">
			.acf-field-56170aad6e798 .acf-label,
			.acf-field-56170de365aba .acf-label { display: none; }
			.acf-field-56170aad6e798 .acf-input p,
			.acf-field-56170de365aba .acf-input p { margin-top: 0; }
			.acf-field-56170aad6e798 .acf-input p:last-child,
			.acf-field-56170de365aba .acf-input p:last-child { margin-bottom: 0; }
		</style>
	<?php }
	add_action('acf/input/admin_head', 'wusm_acf_admin_head');
	
}