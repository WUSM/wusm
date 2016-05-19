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
				<article>
					<?php
						the_title('<h1>', '</h1>');
						the_content();
					?>
				</article>
				<?php
			endwhile;
		endif;
		?>
	</div>

</div>


<?php get_footer(); ?>