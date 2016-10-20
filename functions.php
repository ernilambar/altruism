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

}

add_action( 'wp_enqueue_scripts', 'altruism_scripts' );
