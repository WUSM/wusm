<nav id="left-col">

    <?php if (isset($post->ID)) : $id = $post->ID; ?>

        <?php if ((in_menu($id) || is_page() || (sizeof($post->ancestors) > 0)) && !(is_search())) {

                $walker = new Razorback_Walker_Page_Selective_Children(); ?>

                <ul id="left-nav">

                <?php
                global $force_menu;
                
                if ( is_page() || $force_menu ) {
                    if ( $post->post_parent ) {
                        // This is a subpage
                        $get_children_of = ( isset( $post->ID ) ) ? (int) $post->ancestors[count($post->ancestors)-1] : 0;
                    } else {
                        // This is not a subpage
                        $get_children_of = ( isset( $post->ID ) ) ? (int) $post->ID : 0;
                    }

                    $ptg = sizeof($post->ancestors) > 0 ? $post->ancestors[sizeof($post->ancestors) - 1 ] : $post;

                    $children = wp_list_pages( array (
                        'sort_column'  => 'menu_order',
                        'title_li'     => '',
                        'child_of'     => $get_children_of,
                        'walker'       => $walker,
                        'echo'         => 0,
                        'meta_key'     => 'hide_in_left_nav',
                        'meta_value'   => '0'
                    ));


                    if( function_exists('get_field') && !get_field('hide_in_left_nav', $ptg) ) {

                        if (function_exists('get_field')) {
                            $nav_title = get_field('left_nav_menu_title', $ptg);
                        }
                        $page_title = ($nav_title == "") ? get_post($ptg)->post_title : $nav_title;

                        if ( sizeof($post->ancestors) == 0 && $children ) {
                            // Top-level page with children
                            $top_level_page = '<li class="current_page_item top_level_page"><a href="' . home_url() . '/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
                        } elseif ( sizeof($post->ancestors) > 0 && $children ) {
                            // Sub-page
                            $top_level_page = '<li class="top_level_page"><a href="' . home_url() . '/' . get_post($ptg)->post_name . '">' . $page_title . '</a></li>';
                        }

                        if ( isset($children)) {
                            echo isset($top_level_page) ? $top_level_page : '';
                        }
                        echo $children;

                    }
                } ?>
                </ul>
            <?php } ?>

    <?php endif; ?>

</nav>