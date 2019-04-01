<?php
switch ( get_field( 'logo', 'option' ) ) {
	case 'WUPhysicians':
		$brand = array(
			'text'        => 'Washington University Physicians',
			'url'         => 'http://wuphysicians.wustl.edu/',
			'event_label' => 'Washington University Physicians',
			'logo'        => 'wuphysicians-logo',
			'logo-width'  => 294,
		);
		break;
	case 'WUSTL':
		$brand = array(
			'text'        => 'Washington University in St. Louis',
			'url'         => 'http://wustl.edu/',
			'event_label' => 'WUSTL',
			'logo'        => 'wustl-logo',
			'logo-width'  => 279,
		);
		break;
	default:
		$brand = array(
			'text'        => 'Washington University School of Medicine in St. Louis',
			'url'         => 'http://medicine.wustl.edu/',
			'event_label' => 'School of Medicine',
			'logo'        => 'wusm-logo',
			'logo-width'  => 435,
		);
}
?>
<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php
	if ( get_field( 'line_1', 'option' ) && get_field( 'line_2', 'option' ) ) {
		$site_title = get_field( 'line_1', 'option' ) . ' ' . get_field( 'line_2', 'option' );
	} else {
		$site_title = get_bloginfo( 'name' );
	}
	?>

	<title><?php echo is_front_page() ? $site_title : wp_title( '' ); ?> | <?php echo is_front_page() ? $brand['text'] : $site_title; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/_/js/modernizr.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/_/js/respond.min.js"></script>
	<![endif]-->
</head>

<!--[if IE 7 ]>  <body <?php body_class( 'ie ie7 ie-lt10 ie-lt9 ie-lt8' ); ?>> <![endif]-->
<!--[if IE 8 ]>  <body <?php body_class( 'ie ie8 ie-lt10 ie-lt9' ); ?>> <![endif]-->
<!--[if IE 9 ]>  <body <?php body_class( 'ie ie9 ie-lt10' ); ?>> <![endif]-->
<!--[if gt IE 9]><!--><body <?php body_class(); ?>><!--<![endif]-->

<header>

	<div id="header-logo-row" class="clearfix">

		<div class="wrapper clearfix">

			<div id="header-logo"><a onclick="__gaTracker( 'send', 'event', 'header-logo', '<?php echo $brand['url']; ?>', '<?php echo $brand['event_label']; ?>' );" href="<?php echo $brand['url']; ?>"><img width="<?php echo $brand['logo-width']; ?>" height="23" src="<?php echo get_template_directory_uri(); ?>/_/img/<?php echo $brand['logo']; ?>.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/<?php echo $brand['logo']; ?>.png';this.onerror=null;" alt="<?php echo $brand['text']; ?>"></a></div>

	<?php if ( get_field( 'logo', 'option' ) != 'WUSTL' ) : ?>
			<nav id="utility-bar">
				<ul id="utility-nav">
					<li><a onclick="__gaTracker( 'send', 'event', 'utility-nav', 'http://wustl.edu', 'WUSTL' );" href="http://wustl.edu/">WUSTL</a></li>
					<li class="last-child"><a onclick="__gaTracker( 'send', 'event', 'utility-nav', 'http://medicine.wustl.edu/directory', 'Directory' );" href="http://medicine.wustl.edu/directory">Directories</a></li>
				</ul>
			</nav>
	<?php endif; ?>

		</div>

	</div>

	<div id="header-site-row" class="clearfix">
		<div class="wrapper clearfix">
			<div id="mobile-search-icon">
				<img class="search-open" src="<?php echo get_template_directory_uri(); ?>/_/img/search-mobile.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/search-mobile.png';this.onerror=null;">
				<img class="search-close" src="<?php echo get_template_directory_uri(); ?>/_/img/close.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/close.png';this.onerror=null;">
			</div>
			<div id="mobile-menu-icon">
				<img class="mobile-open" src="<?php echo get_template_directory_uri(); ?>/_/img/menu.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/menu.png';this.onerror=null;">
				<img class="mobile-close" src="<?php echo get_template_directory_uri(); ?>/_/img/close.svg" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/close.png';this.onerror=null;">
			</div>
	<?php get_search_form(); ?>
			<div id="site-title"><a href="<?php echo home_url(); ?>">
				<?php
				if ( get_field( 'line_1', 'option' ) && get_field( 'line_2', 'option' ) ) {
					echo '<div class="line-1">' . get_field( 'line_1', 'option' ) . '</div>';
					echo '<div class="line-2">' . get_field( 'line_2', 'option' ) . '</div>';
				} else {
					echo bloginfo( 'name' );
				}
				?>
			</a></div>
		</div>
	</div>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'header-menu',
			'container'      => 'nav',
			'container_id'   => 'main-nav',
			'items_wrap'     => '<div class="wrapper"><ul>%3$s</ul></div>',
		)
	);

	require 'mobile-nav.php'

	?>
</header>
