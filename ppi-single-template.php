<?php get_header(); ?>

<div id="main" class="clearfix">
	<div id="page-background"></div>
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php if (have_posts()) :
			while (have_posts()) :
				the_post();
				get_sidebar( 'left' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>

	<?php
	/* $washu_ppi = WashU_PPI::get_instance();
	$category_list = $washu_ppi->list_categories( get_the_ID() );
	if ( $category_list != '' ) {
		echo '<div class="entry-categories">
			' . $category_list . "
		</div>\n\r";
	} */
	?>
	<?php echo do_shortcode( '[washu_ppi_single post_id="' . get_the_ID() . '" ]' ); ?>

	<div class="entry-content washu-ppi-body-copy">
		<?php the_content(); ?>
		<?php
		/* Will add maps later???
		$location = get_field( 'washu_ppi_map' );
		if ( !empty($location) ) { ?>
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>
		<?php } */ ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( ! is_admin_bar_showing() ) {
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