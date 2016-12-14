<?php get_header(); ?>

<div id="main" class="clearfix">
	<?php if (get_the_post_thumbnail() != '') {
		echo '<div id="featured-image">';
		the_post_thumbnail();
		echo '</div>';
	} ?>
	<div id="page-background"></div>

	<div class="wrapper">

		<div id="page-background-inner"></div>

		<?php 
		get_sidebar( 'left' );
		wp_reset_query();
		?>

		<article>
			<?php 
				global $post;
				$post = get_post( get_option('page_for_posts', true) );
				setup_postdata( $post );

				echo '<h1 class="page-title">' . get_the_title() . '</h1>';
				if ( is_category() ) {
					echo "<h2>Category: " . single_cat_title( '', false) . "</h2>";
				}
				if ( is_tax( 'news-category' ) ) {
					echo "<h2>Category: " . single_term_title( '', false) . "</h2>";
				}
				echo '<p>' . get_the_content( ) . '</p>';

				wp_reset_postdata();

			?>
			
			<?php
			add_filter( 'excerpt_more', function( $more ) { return ''; } );
			//add_filter( 'wp_trim_words', array( 'wusm_news_plugin', 'wusm_news_excerpt_more' ), 99, 4  );
		
			if (have_posts()) {
				
				while (have_posts()) {
					
					the_post();

					 ?>
					 <div class="entry news-entry">
						
					 	<time><?php echo get_the_date(); ?></time>
						<h2><a href="<?php echo get_permalink(); ?>">
						<?php if ( get_the_post_thumbnail() != '' ) {
							the_post_thumbnail( array( 500, 999 ));
						} ?>
						<?php the_title(); ?></a></h2>
						<?php
						the_excerpt(); 
						?>
					</div>
			
			<?php }

			}
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$total_posts = $wp_query->found_posts;
			$base_url = get_permalink( get_option('page_for_posts', true) );
			$last_set_of_posts = $total_posts / $posts_per_page; 

			the_posts_pagination( 
				array(
					'mid_size'  => 2,
					'prev_text' => '&lsaquo;&nbsp;Prev',
					'next_text' => 'Next&nbsp;&rsaquo;', 
				)
			); 
			?>

			
		</article>
	</div>

</div>

<?php get_footer(); ?>