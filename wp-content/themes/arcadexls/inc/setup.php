<?php
/**
 * ArcadeXLS Setup
 *
 * @package WordPress
 * @subpackage ArcadeXLS
 */

	if (!defined('NONCE_KEY')) die('die');

	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 1200;

	function arcadexls_after_setup_theme(){
		load_theme_textdomain('arcadexls', get_template_directory() . '/languages' );
	}
	add_action( 'after_setup_theme', 'arcadexls_after_setup_theme' );

	// This theme uses wp_nav_menu() in two locations
	add_theme_support( 'menus' );
	register_nav_menus(
		array(
			'menu_header' => __('Menu header', 'arcadexls'),
			'menu_footer' => __('Menu footer', 'arcadexls'),
		)
	);

  // We don't want to show our WordPress version
  remove_action('wp_head', 'wp_generator');

  // Don't show the admin bar
  add_filter( 'show_admin_bar', '__return_false' );

  // Let WordPress manage the document title.
  // By adding theme support, we declare that this theme does not use a
  // hard-coded <title> tag in the document head, and expect WordPress to
  // provide it for us.
  add_theme_support( 'title-tag' );

  // Declare WooCommerce support
  add_theme_support( 'woocommerce' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  // Enable support for Post Thumbnails on posts and pages.
  add_theme_support('post-thumbnails');
  add_image_size('contest-promo', 127, 127);
  add_image_size('blog-featured-image', 1100, 600);

  // Switch default core markup for search form, comment form, and comments
  // to output valid HTML5.
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

/**
 * Enables MCE Editor For bbPress
 *
 * @version 3.0.0
 * @since   3.0.0
 * @param   array $args
 * @return  array
 */
function arcadexls_bbp_enable_visual_editor( $args = array() ) {
  $args['tinymce'] = true;
  $args['quicktags'] = false;
  return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'arcadexls_bbp_enable_visual_editor' );

/**
 * Show's proper OpenGraph images when using Yoast SEO
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  void
 */
function arcadexls_WPSEO_OpenGraph_Image() {
  global $wpseo_og;

  if ( ! is_a( $wpseo_og, 'WPSEO_OpenGraph' ) || ! class_exists( 'WPSEO_OpenGraph_Image' ) ) {
    return;
  }

  if ( is_single() && function_exists( 'is_game' ) && is_game() ) {
    $image = myarcade_get_screenshot_url( 1, false );

    if ( $image ) {
      $size = getimagesize($image);

      // display of this tags with Yoast SEO plugin
      $wpseo_og->og_tag( 'og:image', $image );
      $wpseo_og->og_tag( 'og:image:width', $size[0] );
      $wpseo_og->og_tag( 'og:image:height', $size[1] );
    }
    else {
      $image = myarcade_thumbnail_url();
      $size = getimagesize( $image );

      // display of this tags with Yoast SEO plugin
      $wpseo_og->og_tag( 'og:image', $image );
      $wpseo_og->og_tag( 'og:image:width', $size[0] );
      $wpseo_og->og_tag( 'og:image:height', $size[1] );
    }
  }
}
if ( class_exists('WPSEO_OpenGraph_Image') ) {
 add_action( "wpseo_opengraph", "arcadexls_WPSEO_OpenGraph_Image" );
}

?>