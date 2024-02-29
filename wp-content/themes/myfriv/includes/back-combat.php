<?php
/**
 * Kizi Theme back compat functionality
 *
 * Prevent theme from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage Myfriv
 */

/**
 * Prevent switching to myfriv on old versions of WordPress.
 * Switches to the default theme.
 */
function myfriv_switch_theme() {
  switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
  unset( $_GET['activated'] );
  add_action( 'admin_notices', 'myfriv_upgrade_notice' );
}
add_action( 'after_switch_theme', 'myfriv_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * myfriv on WordPress versions prior to 4.1.
 */
function myfriv_upgrade_notice() {
  $message = sprintf( __( 'Myfriv requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'myfriv' ), $GLOBALS['wp_version'] );
  printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 */
function myfriv_customize() {
  wp_die( sprintf( __( 'Myfriv requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'myfriv' ), $GLOBALS['wp_version'] ), '', array(
    'back_link' => true,
  ) );
}
add_action( 'load-customize.php', 'myfriv_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 */
function myfriv_preview() {
  if ( isset( $_GET['preview'] ) ) {
    wp_die( sprintf( __( 'Myfriv requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'myfriv' ), $GLOBALS['wp_version'] ) );
  }
}
add_action( 'template_redirect', 'myfriv_preview' );