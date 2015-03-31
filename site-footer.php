<div id="site-footer">
    <div class="wrapper">
    <?php $footer_menu = wp_nav_menu( array(
        'theme_location' => 'footer-menu',
        'container'      => 'nav',
        'items_wrap'     => '<ul>%3$s</ul>',
        'fallback_cb'    => false,
        'echo'           => false,
    ) ); ?>
    <?php if( $footer_menu || get_field('facebook', 'option') || get_field('twitter', 'option') || get_field('linkedin', 'option') || get_field('youtube', 'option') ): ?>
        <div id="site-footer-top" class="clearfix">
        <?php echo $footer_menu; ?>
        <?php if(get_field('facebook', 'option') || get_field('twitter', 'option') || get_field('linkedin', 'option') || get_field('youtube', 'option')): ?>
            <div id="site-social">
            <?php if(get_field('facebook', 'option')): ?>
                <a onclick="__gaTracker('send', 'event', 'site-footer', '', 'Facebook');" id="site-facebook" title="Facebook" href="<?php the_field('facebook', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/facebook.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/facebook.png';this.onerror=null;"></a>
            <?php endif; ?>
            <?php if(get_field('twitter', 'option')): ?>
                <a onclick="__gaTracker('send', 'event', 'site-footer', '', 'Twitter');" id="site-twitter" title="Twitter" href="<?php the_field('twitter', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/twitter.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/twitter.png';this.onerror=null;"></a>
            <?php endif; ?>
            <?php if(get_field('linkedin', 'option')): ?>
                <a onclick="__gaTracker('send', 'event', 'site-footer', '', 'LinkedIn');" id="site-linkedin" title="LinkedIn" href="<?php the_field('linkedin', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/linkedin.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/linkedin.png';this.onerror=null;"></a>
            <?php endif; ?>
            <?php if(get_field('youtube', 'option')): ?>
                <a onclick="__gaTracker('send', 'event', 'site-footer', '', 'YouTube');" id="site-youtube" title="YouTube" href="<?php the_field('youtube', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_/img/youtube.svg" width="23" height="23" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/youtube.png';this.onerror=null;"></a>
            <?php endif; ?>
            </div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if(get_field('contact', 'option') || get_field('list_1', 'option') || get_field('list_2', 'option')): ?>
        <div id="site-footer-bottom" class="clearfix">
        <?php if(get_field('contact', 'option')): ?>
            <div id="col1">
                <?php the_field('contact', 'option'); ?>
            </div>
        <?php endif; ?>
        <?php if(get_field('list1_links', 'option') || get_field('list2_links', 'option')): ?>
            <div id="lists">
                <?php if( have_rows('list1_links', 'option') ): ?>
                <div id="col2">
                    <strong><?php the_field('list1_title', 'option'); ?></strong>
                    <ul>
                        <?php while ( have_rows('list1_links', 'option') ) : the_row(); ?>
                        <li><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('link_text'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if( have_rows('list2_links', 'option') ): ?>
                <div id="col3">
                    <?php if(get_field('list2_title', 'option')): ?><strong><?php the_field('list2_title', 'option'); ?></strong><?php endif; ?>
                    <ul>
                        <?php while ( have_rows('list2_links', 'option') ) : the_row(); ?>
                        <li><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('link_text'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>
</div>