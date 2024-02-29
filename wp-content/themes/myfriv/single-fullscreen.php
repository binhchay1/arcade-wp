<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

    <title><?php bloginfo('name'); ?> - <?php _e('Playing game:', 'myfriv'); ?> - <?php single_post_title(); ?></title>

    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all" />

    <?php wp_head(); ?>
  </head>

  <body>
  <center>
    <div class="title-special border-radius-top">
    <div class="padding-10">
      <h2><a href="javascript:history.go(-1)">&laquo; <?php _e('Go Back To', 'myfriv'); ?>: <?php bloginfo('name'); ?> </a></h2>
      </div>
    </div>
      <?php
        global $mypostid, $post;
        $mypostid = $post->ID;
        // overwrite the post id
        $post->ID = $mypostid;
        if ( function_exists('myarcade_get_leaderboard_code') )  {
          echo myarcade_get_leaderboard_code();
        }
        echo get_game($mypostid, $fullsize = false, $preview = false, $fullscreen = true);
        ?>
    </center>

    <?php wp_footer(); ?>
  </body>
</html>