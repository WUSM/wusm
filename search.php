<?php
    get_header();
    $search_terms = get_search_query();
    //query_posts("$query_string . '&posts_per_page=-1'");
?>


<div id="main" class="clearfix">

    <div id="page-background"></div>

    <div class="wrapper clearfix">

        <div id="page-background-inner"></div>

        <?php get_sidebar( 'left' ); ?>

        <article class="search-results">
            <h1>Your Search: <em><?php echo $search_terms; ?></em></h1>

            <?php if ( have_posts() ) :
                while (have_posts()): the_post(); ?>
                    <h2 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if(get_the_excerpt()) { ?><p><?php echo get_the_excerpt(); ?></p><?php } ?>
                    <p class="result-url"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
                <?php endwhile;
            else : ?>
                <h2>No Results Found</h2>
            <?php endif; ?>

            <nav id="paginate-results">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>
            </nav>
        </article>

    </div>

</div>


<?php get_footer(); ?>