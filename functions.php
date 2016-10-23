<?php
/**
 * Theme functions and definitions.
 *
 * @package Altruism
 */

/**
 * Altruism only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require_once trailingslashit( get_template_directory() ) . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function altruism_setup() {
	load_theme_textdomain( 'altruism' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'altruism_setup' );

/**
 * Enqueue scripts and styles.
 */
function altruism_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/third-party/normalize/normalize' . $min . '.css', false, '5.0.0' );

	wp_enqueue_style( 'altruism-style', get_stylesheet_uri(), '', '2.0.0' );

	wp_register_script( 'director', get_template_directory_uri() . '/third-party/director/director' . $min . '.js', array(), '1.2.6' );

	wp_enqueue_script( 'altruism-main', get_template_directory_uri() . '/js/main' . $min . '.js', array( 'jquery', 'underscore', 'director' ), '1.0.0', true );

	wp_localize_script( 'altruism-main', 'altruismObj', array(
		'root'      => esc_url_raw( untrailingslashit( rest_url() ) ),
		'base_url'  => esc_url_raw( untrailingslashit( home_url() ) ),
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'site_name' => get_bloginfo( 'name' ),
	) );
}

add_action( 'wp_enqueue_scripts', 'altruism_scripts' );

/**
 * Prevent WP_Query from returning a 404.
 */
function altruism_override_routing() {
	global $wp_query;

	$wp_query->is_404 = false;

	status_header( 200 );
}

add_action( 'template_redirect', 'altruism_override_routing', 999 );

/**
 * Disable canonical.
 */
function altruism_remove_redirect_guess_404_permalink( $redirect_url ) {
	if ( is_404() ) {
		return false;
	}

	return $redirect_url;
}

add_filter( 'redirect_canonical', 'altruism_remove_redirect_guess_404_permalink' );

// Load hooks.
require_once trailingslashit( get_template_directory() ) . '/inc/hooks.php';
