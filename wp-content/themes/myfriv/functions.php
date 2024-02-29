<?php
/**
 * MyFriv Theme Functions
 */

// The theme works in WordPress 4.1 or later
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
  require( get_template_directory() . '/includes/back-compat.php' );
}

if ( is_admin() ) {
  // Include options framework
  if ( ! function_exists( 'optionsframework_init' ) ) {
    define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/includes/admin/' );
    require_once( get_template_directory() . '/includes/admin/options-framework.php' );
  }
}

// MyArcadePlugin Theme API
require_once( get_template_directory() . '/includes/myarcadeplugin_api.php' );

// BuddyPress compatibility
require_once( get_template_directory() . '/includes/buddypress.php' );

/**
 * Add rewrite rules on theme switching and flush rewrite rules
 *
 * @version 3.0.0
 * @since 3.0.0
 * @return void
 */
function myfriv_adjust_permalinks( $oldname, $oldtheme = false ) {
  add_rewrite_endpoint( 'fullscreen', EP_PERMALINK );
  flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'myfriv_adjust_permalinks', 0 );

/**
 * Add required rewrite rules
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  void
 */
function myfriv_add_rules() {
  add_rewrite_endpoint('fullscreen', EP_PERMALINK);
  add_action('template_redirect', 'myfriv_fullscreen_teplate_redirect');
}
add_action( 'init', 'myfriv_add_rules', 0 );

/**
 * Handles full screen redirect
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  void
 */
function myfriv_fullscreen_teplate_redirect() {
  global $wp_query;

  // if this is not a fullscreen request then bail
  if ( ! is_singular() || ! isset( $wp_query->query_vars['fullscreen'] ) ) {
    return;
  }

  // Include fullscreen template
  get_template_part( "single", "fullscreen" );
  exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @version 3.0.0
 * @since   1.0.0
 * @return  void
 */
function myfriv_setup() {

  // Make theme available for translation.
  // Translations can be filed in the /languages/ directory.
  load_theme_textdomain( 'myfriv', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  // Let WordPress manage the document title.
  // By adding theme support, we declare that this theme does not use a
  // hard-coded <title> tag in the document head, and expect WordPress to
  // provide it for us.
  add_theme_support( 'title-tag' );

  // Enable support for Post Thumbnails on posts and pages.
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location
  register_nav_menus( array(
    'footer' => __( 'Footer Menu', 'myfriv' ),
  ) );

  // Switch default core markup for search form, comment form, and comments
  // to output valid HTML5.
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

  // We don't want to show our WordPress version
  remove_action('wp_head', 'wp_generator');

  // Don't show the admin bar
  add_filter( 'show_admin_bar', '__return_false' );
}
add_action('after_setup_theme', 'myfriv_setup');

/**
 * Enqueue styles
 *
 * @version 3.0.0
 * @since   1.0.0
 * @return  void
 */
function myfriv_styles() {

  // Enqueue main styles
  wp_enqueue_style( 'myfriv-style', get_stylesheet_uri() );

  // Enqueue responsive framework
  wp_register_style( 'myfriv-skeleton', get_template_directory_uri() . '/css/skeleton.css' );
  wp_enqueue_style( 'myfriv-skeleton' );

  // Enqueue BuddyPress styles
  //wp_register_style( 'buddypress',get_template_directory_uri() . '/css/buddypress.css', false );
  //wp_enqueue_style( 'buddypress' );

  // Enqueue Google fonts
  wp_register_style( 'myfriv-google_fonts', "//fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700" );
  wp_enqueue_style( 'myfriv-google_fonts' );

  // Enqueue jQuery Tooltip styles
  wp_register_style( 'myfriv-tooltip', get_template_directory_uri() . '/css/jquery.qtip.css' );
  wp_enqueue_style( 'myfriv-tooltip' );
}
add_action( 'wp_enqueue_scripts','myfriv_styles' );

/**
 * Enqueue scripts
 *
 * @version 3.0.0
 * @since   1.0.0
 * @return  void
 */
function myfriv_scripts() {
  global $is_IE;

  wp_enqueue_script( 'myfriv-scripts', get_template_directory_uri() . '/js/general.js', array( 'jquery', 'masonry' ), false, true );

  if ( is_single() ) {
    wp_enqueue_script( 'myfriv-single', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), false, true );
    wp_localize_script( 'myfriv-single', 'myfrivsingle', array(
      'time' => myfriv_get_option('preloader_time')
    ));
  }

  if ( is_front_page() || is_archive() ) {
    global $wp_query;
    wp_enqueue_script( 'myfriv-infinite', get_template_directory_uri() . '/js/infinite.js', array( 'jquery' ), false, true );
    wp_localize_script( 'myfriv-infinite', 'myfrivinfinite', array(
      'total' => $wp_query->max_num_pages,
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ));
  }

  if ( $is_IE ) {
    wp_enqueue_script( 'html5shiv', "//html5shiv.googlecode.com/svn/trunk/html5.js", false, true );
  }
}
add_action( 'wp_enqueue_scripts', 'myfriv_scripts' );

/**
 * Add a custom header code
 *
 * @version 3.0.0
 * @since   1.0.0
 * @return  void
 */
function myfriv_header() {

  // Add IE compatibility
  echo '<!--[if lt IE 9]><link rel="stylesheet" href="'. get_template_directory_uri() . '/lib/css/ie.css"><![endif]-->';

  // Include custom colors
  include_once(  get_template_directory() .'/style.php' );

  // Add favicon
  echo '<link rel="shortcut icon" type="image/png" href="' . get_template_directory_uri() . '/images/favicon.png">';
}
add_action( 'wp_head', 'myfriv_header' );


/**
 * Get option value
 *
 * @param  string $name Option name
 * @param  mixed $default Option default value
 * @return mixed Option value
 */
function myfriv_get_option( $name, $default = false ) {
  $config = get_option( 'optionsframework' );

  if ( ! isset( $config['id'] ) ) {
    return $default;
  }

  $options = get_option( $config['id'] );

  if ( isset( $options[$name] ) ) {
    return $options[$name];
  }

  return $default;
}

/**
 * Retrieve the game play count
 *
 * @version 3.0.0
 * @since 3.0.0
 * @return number
 */
function myfriv_get_play_count() {
  global $post;

  if ( empty( $post->ID ) ) {
    return 0;
  }

  return myarcade_format_number( intval( get_post_meta( $post->ID, 'post_views_count', true) ) );
}

/**
 * Update game play counter
 *
 * @version 3.0.0
 * @since 3.0.0
 * @return void
 */
function myfriv_update_play_count() {
  global $post;

  if ( empty( $post->ID ) ) {
    return;
  }

  if ( is_single() && ! wp_is_post_revision( $post->ID ) ) {
    $count = intval( get_post_meta( $post->ID, 'post_views_count', true) );
    $count++;
    update_post_meta( $post->ID, 'post_views_count', $count );
  }
}
add_action( 'wp_head', 'myfriv_update_play_count' );

/**
 * Breadcrumb navigation
 *
 * @version 3.0.0
 * @since 1.0.0
 * @return void
 */
function myfriv_breadcrumb() {
  global $post;

  if ( empty( $post->ID ) ) {
    return;
  }

  $pid = $post->ID;
  $trail = __('You are here:', 'myfriv') . ' <a href="/">'. __('Home', 'myfriv') .'</a>';

  if ( is_front_page() ) {
    // do nothing
  }
  elseif ( is_page() ) {
    $bcarray = array();
    $pdata = get_post($pid);
    $bcarray[] = ' &raquo; '.$pdata->post_title."\n";
    while ($pdata->post_parent) {
      $pdata = get_post($pdata->post_parent);
      $bcarray[] = ' &raquo; <a href="'.get_permalink($pdata->ID).'">'.$pdata->post_title.'</a>';
    }
    $bcarray = array_reverse($bcarray);
    foreach ($bcarray AS $listitem) {
      $trail .= $listitem;
    }
  }
  elseif ( is_single() ) {
    $pdata = get_the_category($pid);
    $adata = get_post($pid);

    if(!empty($pdata)){
      $data = get_category_parents($pdata[0]->cat_ID, TRUE, ' &raquo; ');
      $trail .= " &raquo; ".substr($data,0,-8);
    }

    $trail.= ' &raquo; '.$adata->post_title."\n";
  }
  elseif ( is_category() ) {
    $pdata = get_the_category($pid);
    $data = get_category_parents($pdata[0]->cat_ID, TRUE, ' &raquo; ');
    if(!empty($pdata)){
      $trail .= " &raquo; ".substr($data,0,-8);
    }
  }
  $trail.="";

  echo $trail;
}

/**
 * Infinite scroll
 *
 * @version 3.0.0
 * @since 1.0.0
 * @return void
 */
function myfriv_infinite_pagination() {
  //$loopFile        = $_POST['loop_file'];
  $paged           = $_POST['page_no'];
  $posts_per_page  = get_option('posts_per_page');

  query_posts( array( 'paged' => $paged ) );
  get_template_part( "partials/loop" );

  die();
}
add_action( 'wp_ajax_infinite_scroll', 'myfriv_infinite_pagination' );
add_action( 'wp_ajax_nopriv_infinite_scroll', 'myfriv_infinite_pagination' );

/* 
  * Override a default filter for 'textarea' sanitization and $allowedposttags + script.
  */
  add_action('admin_init','myfriv_change_santiziation', 100);
   
  function myfriv_change_santiziation() {
      remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
      add_filter( 'of_sanitize_textarea', 'myfriv_sanitize_textarea' );
  }
   
  function myfriv_sanitize_textarea($input) {
      return $input;
  }
