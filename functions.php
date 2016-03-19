<?php

function altruism_scripts(){

  wp_enqueue_script( 'angularjs', get_template_directory_uri() . '/assets/js/angular/angular.min.js', '', '', true );
  wp_enqueue_script( 'angularjs-route', get_template_directory_uri() . '/assets/js/angular/angular-route.min.js', '', '', true );
  wp_enqueue_script( 'angularjs-sanitize', get_template_directory_uri() . '/assets/js/angular/angular-sanitize.min.js', '', '', true );
  wp_enqueue_script( 'altruism-custom', get_template_directory_uri() . '/assets/app/app.js', array( 'angularjs' ), '', true );
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

function altruism_setup(){

  add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'altruism_setup' );
