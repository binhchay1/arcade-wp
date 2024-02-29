<?php
function arcadexls_init_actions() {
  /** Add WPSeoContentManager Compatibility **/
  if ( function_exists('get_WPSEOContent') ) {
    add_action('arcadexls_after_404_content', 'get_WPSEOContent');
    add_action('arcadexls_after_archive_content', 'get_WPSEOContent');
    add_action('arcadexls_after_index_content', 'get_WPSEOContent');
  }
  
  // Only if contest is activated
  if ( function_exists('myarcadecontest_init') ) {
    add_action('arcadexls_before_game', 'arcadexls_contest_alert');
  }
}
add_action('init', 'arcadexls_init_actions');

function arcadexls_action_after_404_content() {
  do_action('arcadexls_after_404_content');
}

function arcadexls_action_after_archive_content() {
  do_action('arcadexls_after_archive_content');
}

function arcadexls_action_after_index_content() {
  do_action('arcadexls_after_index_content');
}

/**
 * Replace the default WordPress logo with a custom logo
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  void
 */
function arcadexls_login_logo() {
  $login_logo = arcadexls_get_option( 'logologin' );
  if ( empty( $login_logo['url'] ) ) {
    $login_logo = arcadexls_get_option( 'logohd' );
    if ( empty( $login_logo['url'] ) ) {
      $login_logo['url'] = get_template_directory_uri() .' /images/arcadexls.png';
    }
  }
  ?>
  <style type="text/css">
    .login h1 a {
      background-image: url('<?php echo $login_logo['url']; ?>') !important;
      background-size: auto auto !important; width: auto !important;
    }
  </style>
  <?php
}
add_action( 'login_enqueue_scripts', 'arcadexls_login_logo' );

/**
 * Change the login logo URL to our site
 *
 * @version 3.0.0
 * @since   3.0.0
 * @access  public
 * @return  string Home URL
 */
function arcadexls_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'arcadexls_login_logo_url' );

/**
 * Change login logo title from 'Powered by WordPress' to our site name
 *
 * @version 3.0.0
 * @since   3.0.0
 * @access  public
 * @return  string Site name
 */
function arcadexls_login_logo_title() {
  return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'arcadexls_login_logo_title' );
?>