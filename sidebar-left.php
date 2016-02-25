<nav id="left-col">

	<?php 
    global $force_menu;
    
    if ( isset( $post->ID ) ) {

        $id = $post->ID;

        if( is_home() ) {

            $id = get_option( 'page_for_posts' );
            $post = get_post( $id );
        }

		if ( ( in_menu( $id ) || is_page() || ( count( $post->ancestors ) > 0 ) || $force_menu ) && ! is_search() ) {

				$walker = new Razorback_Walker_Page_Selective_Children(); ?>

				<ul id="left-nav">

				<?php
				if ( is_page() || $force_menu ) {
					if ( $post->post_parent ) {
						// This is a subpage.
						$get_children_of = ( isset( $post->ID ) ) ? (int) $post->ancestors[ count( $post->ancestors ) -1 ] : 0;
					} else {
						// This is not a subpage.
						$get_children_of = ( isset( $post->ID ) ) ? (int) $post->ID : 0;
					}

					$ptg = count( $post->ancestors ) > 0 ? $post->ancestors[ count( $post->ancestors ) - 1 ] : $post;

					$children = wp_list_pages( array(
						'sort_column'  => 'menu_order',
						'title_li'     => '',
						'child_of'     => $get_children_of,
						'walker'       => $walker,
						'echo'         => 0,
						'meta_query'   => array(
							array(
								'key'   => 'hide_in_left_nav',
								'meta_compare' => '!=',
								'value' => 1,
							)
						)
					));


					if ( function_exists( 'get_field' ) && ! get_field( 'hide_in_left_nav', $ptg ) ) {

						if ( function_exists( 'get_field' ) ) {
							$nav_title = get_field( 'left_nav_menu_title', $ptg );
						}
						$page_title = ( '' == $nav_title ) ? get_post( $ptg )->post_title : $nav_title;

						if ( 0 == count( $post->ancestors ) && $children ) {
							// Top-level page with children.
							$top_level_page = '<li class="current_page_item top_level_page"><a href="' . home_url() . '/' . get_post( $ptg )->post_name . '">' . $page_title . '</a></li>';
						} elseif ( count( $post->ancestors ) > 0 && $children ) {
							// Sub-page.
							$top_level_page = '<li class="top_level_page"><a href="' . home_url() . '/' . get_post( $ptg )->post_name . '">' . $page_title . '</a></li>';
						}

						if ( isset( $children ) ) {
							echo isset( $top_level_page ) ? $top_level_page : '';
						}
						echo $children;

					}
				} ?>
				</ul>
		<?php } 
    } ?>

</nav>
