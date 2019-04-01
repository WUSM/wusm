<div class="mobile-container">
	<form method="get" id="mobile-search-form" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" name="s" id="mobile-search-box" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="<?php esc_attr_e( 'Search' ); ?>">
	</form>

	<nav id="mobile-nav">
		<ul>
			<li class="page_item<?php echo is_front_page() ? ' current_page_item' : ''; ?>"><a href="<?php echo home_url() . '">' . __( 'Home', 'wusm' ); ?></a></li>

	<?php
	$frontpage_id = get_option( 'page_on_front' );
	wp_list_pages(
		array(
			'sort_column' => 'menu_order',
			'title_li'    => '',
			'exclude'     => $frontpage_id,
			'meta_key'    => 'hide_in_left_nav',
			'meta_value'  => '0',
		)
	);

	/**
	 * Detect plugin. For use on Front End only.
	 */
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	// check for plugin using plugin name
	if ( is_plugin_active( 'washu-people-places-items/washu-people-places-items.php' ) ) {
		// Determine which CPTs are active
		$which_types = get_option( 'options_washu_ppi_use_post_types' );

		// functions specifically for "People" post type
		if ( $which_types && in_array( 'people', $which_types ) ) {
			?>
					<li class="page_item"><a href="/people">People</a></li>
			<?php
		}
		if ( $which_types && in_array( 'places', $which_types ) ) {
			?>

					<li class="page_item"><a href="/places">Places</a></li>
			<?php
		}
		if ( $which_types && in_array( 'items', $which_types ) ) {
			?>
					<li class="page_item"><a href="/items">Items</a></li>
			<?php
		}
	}
	?>

			<li class="page_item"><a onclick="__gaTracker('send', 'event', 'mobile-utility-nav', 'http://wustl.edu', 'WUSTL');" href="http://wustl.edu/">WUSTL</a></li>
			<li class="page_item"><a onclick="__gaTracker('send', 'event', 'mobile-utility-nav', 'http://medicine.wustl.edu/directory', 'Directories');" href="http://medicine.wustl.edu/directory">Directories</a></li>
		</ul>
	</nav>
</div>
