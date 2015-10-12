<footer>

    
    <?php if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'site-footer.php' ) ) {
        include_once( trailingslashit( get_stylesheet_directory() ) . '/site-footer.php');
    } else {
        include_once( trailingslashit( get_template_directory() ) . '/site-footer.php');
    } ?>

    <div id="wusm-footer">

        <div class="wrapper clearfix">

            <div id="wusm-footer-left">
                <a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://medicine.wustl.edu', 'School of Medicine');" href="http://medicine.wustl.edu/"><img width="147" height="31" src="<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo-footer.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo-footer.png';this.onerror=null;" alt="Washington University School of Medicine in St. Louis"></a>
                <div id="copyright"><a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://www.wustl.edu/policies/copyright.html', 'Copyright');" href="http://www.wustl.edu/policies/copyright.html">&copy; <?php echo date("Y") ?> Washington University in St. Louis</a></div>
            </div>

            <div id="wusm-footer-right">
                <div id="wusm-social">
                    <a onclick="__gaTracker('send', 'event', 'wusm-footer', 'https://www.facebook.com/WUSTLmedicine.health', 'Facebook');" id="wusm-facebook" title="Facebook" href="https://www.facebook.com/WUSTLmedicine.health"><img src="<?php echo get_template_directory_uri(); ?>/_/img/facebook.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/facebook.png';this.onerror=null;"></a><a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://twitter.com/WUSTLmed', 'Twitter');" id="wusm-twitter" title="Twitter" href="http://twitter.com/WUSTLmed"><img src="<?php echo get_template_directory_uri(); ?>/_/img/twitter.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/twitter.png';this.onerror=null;"></a><a onclick="__gaTracker('send', 'event', 'wusm-footer', 'https://www.flickr.com/photos/wustlmedicine/', 'Flickr');" id="wusm-flickr" title="Flickr" href="https://www.flickr.com/photos/wustlmedicine/"><img src="<?php echo get_template_directory_uri(); ?>/_/img/flickr.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/flickr.png';this.onerror=null;"></a>
                </div>

                <nav>
                    <a class="first-child" onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://emergency.wustl.edu', 'Emergency');" href="http://emergency.wustl.edu">Emergency</a>
                    <a onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://medicine.wustl.edu/policies', 'Policies');" href="http://medicine.wustl.edu/policies">Policies</a>
                    <a class="last-child" onclick="__gaTracker('send', 'event', 'wusm-footer', 'http://medicine.wustl.edu/news/', 'News');" href="http://medicine.wustl.edu/news/">News</a>
                </nav>
            </div>

        </div>

    </div>

</footer>

<?php
   /* Always have wp_footer() just before the closing </body>
	* tag of your theme, or you will break many plugins, which
	* generally use this hook to reference JavaScript files.
	*/
	wp_footer();
?>
</body>
</html>