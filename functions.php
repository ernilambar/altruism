<?php

function altruism_setup() {

	load_theme_textdomain( 'altruism', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'altruism_setup' );

function altruism_scripts() {

    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'altruism-style', get_stylesheet_uri(), '', '1.0' );

	wp_enqueue_script( 'angularjs', get_template_directory_uri() . '/third-party/angular/angular' . $min . '.js', '', '1.5.0', true );
	wp_enqueue_script( 'angularjs-route', get_template_directory_uri() . '/third-party/angular/angular-route' . $min . '.js', '', '1.5.0', true );
	wp_enqueue_script( 'angularjs-sanitize', get_template_directory_uri() . '/third-party/angular/angular-sanitize' . $min . '.js', '', '1.5.0', true );
	wp_enqueue_script( 'altruism-custom', get_template_directory_uri() . '/js/app/app.js', array( 'angularjs' ), '1.0', true );

	$base_url  = esc_url_raw( home_url() );
	wp_localize_script( 'altruism-custom', 'altruismLocalized', array(
		'root'      => esc_url_raw( rest_url() ),
		'base_url'  => $base_url,
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'site_name' => get_bloginfo( 'name' ),
		'partials'  => trailingslashit( get_template_directory_uri() ) . 'partials/',
	) );

}

add_action( 'wp_enqueue_scripts', 'altruism_scripts' );

