<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>	 <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>	 <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>	 <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine (even in intranet) -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php echo is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?></title>

    <meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?>">
    <meta name="author" content="Washington University School of Medicine in St. Louis">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

    <?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<header>

    <div id="header-logo-row" class="clearfix">

        <div class="wrapper clearfix">

            <div id="header-logo"><a onclick="__gaTracker('send', 'event', 'header-logo', 'http://medicine.wustl.edu', 'School of Medicine');" href="http://medicine.wustl.edu/"><img width="435" height="23" src="<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/wusm-logo.png';this.onerror=null;" alt="Washington University School of Medicine in St. Louis"></a></div>

            <nav id="utility-bar">
                <ul id="utility-nav">
                    <li><a onclick="__gaTracker('send', 'event', 'utility-nav', 'http://wustl.edu', 'WUSTL');" href="http://wustl.edu/">WUSTL</a></li>
                    <li class="last-child"><a onclick="__gaTracker('send', 'event', 'utility-nav', 'http://medicine.wustl.edu/directory', 'Directory');" href="http://medicine.wustl.edu/directory">Directories</a></li>
                </ul>
            </nav>

        </div>

    </div>

    <div id="header-site-row" class="clearfix">
        <div class="wrapper clearfix">
            <div id="mobile-search-icon"><div class="dashicons dashicons-search"></div></div>
            <div id="mobile-menu-icon"><div class="dashicons dashicons-menu"></div></div>
            <?php get_search_form(); ?>
            <div id="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></div>
        </div>
    </div>


    <?php wp_nav_menu( array(
        'theme_location' => 'header-menu',
        'container'      => 'nav',
        'container_id'   => 'main-nav',
        'items_wrap'     => '<div class="wrapper"><ul>%3$s</ul></div>',
    ) ); ?>

    <div class="mobile-container">
        <form method="get" id="mobile-search-form" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" name="s" id="mobile-search-box" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="<?php esc_attr_e( 'Search' ); ?>">
            <!-- <input type="submit" class="submit" name="submit" value="GO" id="mobile-search-btn"> -->
        </form>

        <nav id="mobile-nav">
            <ul>
                <li class="page_item<?php echo is_front_page() ? ' current_page_item' : '' ?>"><a href="<?php echo home_url(); ?>">Home</a></li>

                <?php
                $frontpage_id = get_option('page_on_front');
                wp_list_pages( array(
                    'sort_column' => 'menu_order',
                    'title_li'    => '',
                    'exclude'     => $frontpage_id,
                    'meta_key'    => 'hide_in_left_nav',
                    'meta_value'  => '0'
                ) );
                ?>

                <li class="page_item"><a onclick="__gaTracker('send', 'event', 'mobile-utility-nav', 'http://wustl.edu', 'WUSTL');" href="http://wustl.edu/">WUSTL</a></li>
                <li class="page_item"><a onclick="__gaTracker('send', 'event', 'mobile-utility-nav', 'http://medicine.wustl.edu/directory', 'Directories');" href="http://medicine.wustl.edu/directory">Directories</a></li>
            </ul>
        </nav>
    </div>

</header>

<?php
// Required for mobile nav on Event Organiser search results page.
// I'd prefer to have this in the WUSM Event Organiser Skin plugin.
if (isset($_GET['post_type']) && $_GET['post_type'] == 'event' && is_search()) {
?>
<div id="main" class="clearfix">
    <div id="page-background"></div>
    <div class="wrapper">
        <?php get_sidebar( 'left' ); ?>
<?php
}
?>