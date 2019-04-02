<?php get_header(); ?>

<div id="main" class="clearfix">
	<div id="page-background"></div>
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php get_sidebar( 'left' );
		if ( have_posts() ) : ?>
			<article>
			<h1>Items</h1>
			<?php
			if ( function_exists( 'washu_ppi_loop_controller' ) ) {
				washu_ppi_loop_controller( get_post_type(), true, 'list' ); // Loop and retrieve appropriate template partial(s)
				add_action( 'wp_footer', function() {
					$show_images = true;
					require( WASHU_PPI_PLUGIN_DIR . 'templates/partials/_items-list.php' );
				} );
			}
		endif; ?>
		</article>
	</div>

</div>

<?php get_footer(); ?>
