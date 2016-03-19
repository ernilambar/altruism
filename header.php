<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> ng-app="app">

  <header>
    <h1>
      <a href="<?php echo esc_url( home_url( '/#/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?></a>
    </h1>
  </header>
