<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php echo is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?></title>

    <meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?>">
    <meta name="author" content="Washington University School of Medicine in St. Louis">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">

    <?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
    ?>
</head>

<!--[if IE 7 ]>  <body <?php body_class('ie ie7 ie-lt10 ie-lt9 ie-lt8'); ?>> <![endif]-->
<!--[if IE 8 ]>  <body <?php body_class('ie ie8 ie-lt10 ie-lt9'); ?>> <![endif]-->
<!--[if IE 9 ]>  <body <?php body_class('ie ie9 ie-lt10'); ?>> <![endif]-->
<!--[if gt IE 9]><!--><body <?php body_class(); ?>><!--<![endif]-->

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

    <?php
        wp_nav_menu( array(
            'theme_location' => 'header-menu',
            'container'      => 'nav',
            'container_id'   => 'main-nav',
            'items_wrap'     => '<div class="wrapper"><ul>%3$s</ul></div>',
        ) );

        include 'mobile-nav.php'
    ?>

</header>