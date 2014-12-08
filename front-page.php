<?php get_header(); ?>

    <div id="main" class="homepage clearfix">

        <?php if (have_posts()) :
			while (have_posts()) :
			the_post(); ?>

		<div id="featured-image-home">
			<?php the_post_thumbnail(); ?>
		</div>

		<div class="wrapper">

			<div class="homepage-content">

				<?php the_title('<h1>', '</h1>'); ?>

        		<?php the_content(); ?>

        	</div>

    	</div>

    	<?php endwhile; endif; ?>

    </div>


<?php get_footer(); ?>