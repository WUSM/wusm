<?php get_header(); ?>

    <div id="main" class="homepage clearfix">

        <?php if (have_posts()) :
			while (have_posts()) :
			the_post(); ?>

        <?php if ( get_field( 'banner_selection' ) == 'condensed' ) { ?>
            <div id="featured-image-home">
                <?php the_post_thumbnail(); ?>
                <?php if ( get_field( 'light_or_dark' ) == 'light' ) {?>
                    <div class="featured-banner light">
                <?php } else { ?>
                    <div class="featured-banner dark">
                <?php } ?>
                    <div class="wrap">
                        <div class="featured-text">
            				<?php the_title('<h1>', '</h1>'); ?>
                            <?php the_content(); ?>
                        </div>
                        <div class="featured-button">
                            <a class="wusm-button" href="<?php echo the_field( 'button_link' ); ?>"><?php echo the_field( 'button_text' ); ?></a>
                        </div>
                    </div>
                </div>
    		</div>
        <?php } else { ?>
    		<div id="featured-image-home">
    			<?php the_post_thumbnail(); ?>
    		</div>
    		<div class="wrapper">
    			<div class="homepage-content">
                    <?php the_title('<h1>', '</h1>'); ?>
            		<?php the_content(); ?>
            	</div>
        	</div>
        <?php } ?>

    	<?php endwhile; endif;
    	do_action( 'wusm_front_page_additional_sections' );?>

    </div>


<?php get_footer(); ?>
