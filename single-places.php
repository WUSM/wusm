<?php get_header(); ?>

<div id="main" class="clearfix">
	<?php
	if (get_the_post_thumbnail() != '') {
		echo '<div id="featured-image">';
		the_post_thumbnail();
		echo '</div>';
	}
	?>
	<div id="page-background"></div>
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php if (have_posts()) :
			while (have_posts()) :
				the_post();
				get_sidebar( 'left' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>

	<?php
	$dir = plugin_dir_path( __FILE__ );
	require_once( $dir . '../../plugins/washu-people-places-items/templates/partials/places-list.php' );
	?>

	<div class="entry-content washu-ppi-body-copy">
		<?php the_content(); ?>

		<?php
		/*
		// Will add maps later.
		$location = get_field( 'washu_ppi_map' );

		if ( !empty($location) ) { ?>

			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>

		<?php } */ ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'chauvenet' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		/*
		// translators: used between list items, there is a space after the comma
		$category_list = get_the_category_list( __( ', ', 'chauvenet' ) );

		// translators: used between list items, there is a space after the comma
		$tag_list = get_the_tag_list( '', __( ', ', 'chauvenet' ) );

		if ( ! chauvenet_categorized_blog() ) {
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was tagged %2$s.', 'chauvenet' );
			} else {
				$meta_text = '';
			}

		} else {
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'chauvenet' );
			} else {
				$meta_text = __( 'This entry was posted in %1$s.', 'chauvenet' );
			}

		} // end check for categories on this blog

		printf(
			$meta_text,
			$category_list,
			$tag_list
		);
		*/
		?>

		<?php
		if ( !is_admin_bar_showing() ) {
			edit_post_link( __( 'Edit', 'chauvenet' ), '<span class="edit-link">', '</span>' );
		}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
				<?php
			endwhile;
		endif;
		?>
	</div>

</div>


<?php get_footer(); ?>