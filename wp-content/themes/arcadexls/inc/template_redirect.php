<?php
  add_action('init', 'arcadexls_init', 0);

  // Add filter for blog template
  add_filter('category_template', 'arcadexls_blogcat_template');

  if ( !function_exists('arcadexls_blogcat_template') ) {
    /**
    * Blog template redirection
    */
    function arcadexls_blogcat_template($template) {
    global $post,$arcadexlscnf;
    
    $blog =  arcadexls_get_option('blogcat');
    
    $blog_category = empty( $blog ) ? '' : $blog;

    if ($blog_category == '') return $template;

    if(in_category($blog_category)){
      // overwrite the template file if exist
      if ( file_exists(get_template_directory() . '/template-blog.php' ) ) {
      $template = get_template_directory() . '/template-blog.php';
      }
    }

    return $template;
    }
  }

  // Add filter for blog template
  add_filter('single_template', 'arcadexls_blog_template');

  if ( !function_exists('arcadexls_blog_template') ) {
    /**
    * Blog template redirection
    */
    function arcadexls_blog_template($template) {
    global $post,$arcadexlscnf;
    
    $blog =  arcadexls_get_option('blogcat');
    // Get the blog category
    $blog_category = empty($blog) ? '' : $blog;

    if ($blog_category == '') return $template;

    $post_cat = get_the_category();


    if ( is_singular() && !empty($post_cat) and (in_category($blog_category) || ($blog_category == $post_cat[0]->category_parent))) {
      // overwrite the template file if exist
      if ( file_exists(get_template_directory() . '/template-blog-post.php' ) ) {
      $template = get_template_directory() . '/template-blog-post.php';
      }
    }

    return $template;
    }
  }

  /**
   * ArcadeXLS activation function
   */
  function arcadexls_activation( $oldname, $oldtheme = false ) {
    
    $permalinkendpoint =  arcadexls_get_option('game-play-permalink-endpoint');
    $endpoint = empty($permalinkendpoint) ? 'play' : $permalinkendpoint;
    add_rewrite_endpoint( $endpoint, EP_PERMALINK );
    add_rewrite_endpoint('fullscreen', EP_PERMALINK);
    flush_rewrite_rules();
  }
  add_action('after_switch_theme', 'arcadexls_activation', 0);

  /**
   * ArcadeXLS init function - called when WordPress is initialized
   */
  function arcadexls_init() {
    // Check if pre-game page is enabled
    if ( arcadexls_get_option('pregame-page', 1) == '1' ) {
    $endpoint = arcadexls_get_option('game-play-permalink-endpoint');
    if ( empty($endpoint) ) $endpoint = 'play';
    add_rewrite_endpoint( $endpoint, EP_PERMALINK );
    add_action( 'template_redirect', 'arcadexls_play_template_redirect' );
    }

    // Check if fullscreen option is enabled
    if ( arcadexls_get_option('fullscreen-button', 1) == '1' ) {
    add_rewrite_endpoint('fullscreen', EP_PERMALINK);
    add_action('template_redirect', 'arcadexls_fullscreen_teplate_redirect');
    }
  }


  /**
   * Handles game display when user comes from the pre-game page (game landing page)
   *
   * @global type $wp_query
   * @return type
   */
  function arcadexls_play_template_redirect() {
    global $wp_query;

    $endpoint = arcadexls_get_option('game-play-permalink-endpoint');
    if ( empty($endpoint) ) return;

    // if this is not a request for game play then bail
    if ( !is_singular() || !isset($wp_query->query_vars[$endpoint]) ) {
    return;
    }

    // Include game play template
    get_template_part( 'single', 'play' );
    exit;
  }


  /**
   * Handles full screen redirect
   *
   * @global type $wp_query
   * @return type
   */
  function arcadexls_fullscreen_teplate_redirect() {
    global $wp_query;

    // if this is not a fullscreen request then bail
    if ( !is_singular() || !isset($wp_query->query_vars['fullscreen']) ) {
    return;
    }

    // Include fullscreen template
    get_template_part( 'single', 'fullscreen' );
    exit;
  }

  /**
   * Generate play permalink
   *
   * @return type
   */
  function arcadexls_play_link($op=1) {
    $endpoint = arcadexls_get_option('game-play-permalink-endpoint');
    if ( empty($endpoint) ) return;
    ?>
        <a href="<?php echo get_permalink() . $endpoint . '/'; ?>" title="<?php printf( __('PLAY NOW: %s', 'arcadexls'), get_the_title()); ?>" rel="bookmark nofollow" class="botn"><?php _e("PLAY NOW!", 'arcadexls'); ?></a>
    <?php
  }
?>