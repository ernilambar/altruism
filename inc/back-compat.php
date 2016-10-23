<?php
/**
 * Back compat functionality
 *
 * @package Altruism
 */

/**
 * Prevent switching to Altruism on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since 2.0.0
 */
function altruism_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'altruism_upgrade_notice' );
}
add_action( 'after_switch_theme', 'altruism_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Altruism on WordPress versions prior to 4.7.
 *
 * @since 2.0.0
 *
 * @global string $wp_version WordPress version.
 */
function altruism_upgrade_notice() {
	$message = sprintf( __( 'Altruism requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'altruism' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since 2.0.0
 *
 * @global string $wp_version WordPress version.
 */
function altruism_customize() {
	wp_die( sprintf( __( 'Altruism requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'altruism' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'altruism_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since 2.0.0
 *
 * @global string $wp_version WordPress version.
 */
function altruism_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Altruism requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'altruism' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'altruism_preview' );
