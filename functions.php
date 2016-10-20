<?php

function altruism_setup() {

	load_theme_textdomain( 'altruism' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'altruism_setup' );

function altruism_scripts() {

    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    wp_enqueue_style( 'altruism-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:600,400,400italic,300,100,700' );

	wp_enqueue_style( 'altruism-style', get_stylesheet_uri(), '', '2.0' );

	$base_url  = esc_url_raw( home_url() );
	$base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

	wp_enqueue_script( 'vue', get_template_directory_uri() . '/third-party/vue/vue' . $min . '.js', array(), '2.0.3', true );
	wp_enqueue_script( 'altruism-vue', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
	wp_localize_script( 'altruism-vue', 'altruismObj', array(
		'root'      => esc_url_raw( rest_url() ),
		'base_url'  => $base_url,
		'base_path' => $base_path ? $base_path . '/' : '/',
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'site_name' => get_bloginfo( 'name' ),
	) );

}

add_action( 'wp_enqueue_scripts', 'altruism_scripts' );
