<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> ng-app="app">

  <header>
    <h1>
      <a href="<?php echo esc_url( home_url( '/#/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?></a>
    </h1>
  </header>
