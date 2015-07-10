<?php
    switch (get_field('logo', 'option')) {
        case 'WUPhysicians':
            $brand = array(
                'text'        => 'Washington University Physicians',
                'url'         => 'http://wuphysicians.wustl.edu/',
                'event_label' => 'Washington University Physicians',
                'logo'        => 'wuphysicians-logo',
                'logo-width'  => 294
            );
            break;
        case 'WUSTL':
            $brand = array(
                'text'        => 'Washington University in St. Louis',
                'url'         => 'http://wustl.edu/',
                'event_label' => 'WUSTL',
                'logo'        => 'wustl-logo',
                'logo-width'  => 279
            );
            break;
        default:
            $brand = array(
                'text'        => 'Washington University School of Medicine in St. Louis',
                'url'         => 'http://medicine.wustl.edu/',
                'event_label' => 'School of Medicine',
                'logo'        => 'wusm-logo',
                'logo-width'  => 435
            );
    }
?>

<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php echo is_front_page() ? $brand['text'] : bloginfo('name'); ?></title>

    <meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php echo is_front_page() ? $brand['text'] : bloginfo('name'); ?>">
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

            <div id="header-logo"><a onclick="__gaTracker('send', 'event', 'header-logo', '<?php echo $brand['url']; ?>', '<?php echo $brand['event_label']; ?>');" href="<?php echo $brand['url']; ?>"><img width="<?php echo $brand['logo-width'] ?>" height="23" src="<?php echo get_template_directory_uri(); ?>/_/img/<?php echo $brand['logo']; ?>.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/<?php echo $brand['logo']; ?>.png';this.onerror=null;" alt="<?php echo $brand['text']; ?>"></a></div>

            <?php if (get_field('logo', 'option') != 'WUSTL') : ?>
            <nav id="utility-bar">
                <ul id="utility-nav">
                    <li><a onclick="__gaTracker('send', 'event', 'utility-nav', 'http://wustl.edu', 'WUSTL');" href="http://wustl.edu/">WUSTL</a></li>
                    <li class="last-child"><a onclick="__gaTracker('send', 'event', 'utility-nav', 'http://medicine.wustl.edu/directory', 'Directory');" href="http://medicine.wustl.edu/directory">Directories</a></li>
                </ul>
            </nav>
            <?php endif; ?>

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