<?php get_header();
if ( is_post_type_archive() ) {
	$page_title = post_type_archive_title( '', false );
} else {
	$page_title = single_term_title( '', false );
}
?>

<div id="main" class="clearfix">
	<div id="page-background"></div>
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php
		get_sidebar( 'left' );
		if ( have_posts() ) :
		?>
			<article>
			<header class="page-header">
			<h1 class="page-title"><?php echo $page_title; ?></h1>
			<?php
				the_archive_description( '<div class="taxonomy-description">', '</div>' );

				$cats_people = get_query_var( 'washu_ppi_people_types' );
				$cats_places = get_query_var( 'washu_ppi_places_types' );
				$cats_items = get_query_var( 'washu_ppi_items_types' );
			?>
		</header><!-- .page-header -->
		<?php $post_type = get_post_type(); ?>
		<?php echo do_shortcode( "[washu_ppi_archive cats_people='$cats_people' cats_places='$cats_places' cats_items='$cats_items' type='$post_type' posts_per_page=-1 filter='false' show_alpha='false' ]" ); ?>
		<?php
		endif;
		?>
		</article>
	</div>

</div>

<?php get_footer(); ?>
