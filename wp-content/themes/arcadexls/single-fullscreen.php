<?php
/* 
Plugin Name:  Full Screen Mod for MyArcadePlugin Pro
Plugin URI:   http://myarcadeplugin.com
Description:  Show a game in full screen mode
Version:      2.0.0
Author:       Daniel Bakovic
Author URI:   http://netreview.de
*/
?>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <title><?php bloginfo('name'); ?> - <?php _e('Playing game:', 'arcadexls'); ?> - <?php single_post_title(); ?></title>

    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all" />
    
    <?php wp_head(); ?>   
    
    <style type="text/css">
    #gamecntmt { 
      width:95%;
      margin:5px auto 0 auto;
      display:block;
      position: relative;
    }
    
    #gamecntmt h2 {
      background:#C9CCD3;
      line-height:40px;
      margin-bottom: 5px;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius:4px;
    }
    </style>
  </head>

  <body>
    <center>
      <div id="gamecntmt">
        <h2><a href="javascript:history.go(-1)">&laquo; <?php _e('Go Back To', 'arcadexls'); ?>: <?php bloginfo('name'); ?> </a></h2>
      </div>      
        <?php
        if ( function_exists('get_game') ) {
          global $mypostid, $post; 
          $mypostid = $post->ID;
          // overwrite the post id
          $post->ID = $mypostid;
          if ( function_exists('myarcade_get_leaderboard_code') )  {
            echo myarcade_get_leaderboard_code();
          }         
          echo get_game($mypostid, $fullsize = false, $preview = false, $fullscreen = true);
        }
        ?>
    </center>
    
    <?php 
    wp_footer();    
    ?> 
  </body>
</html>