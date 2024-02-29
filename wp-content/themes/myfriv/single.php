<?php get_header(); ?>

<section class="play_wrap">

  <div class="breadcrumb">
    <span class="icon icon-location"></span>
    <?php myfriv_breadcrumb(); ?>
    <div class="spacer"></div>
  </div>

  <?php if ( myfriv_get_option('single_728x90') ) : ?>
    <?php get_template_part( "partials/advertisement", "728" ); ?>
  <?php endif; ?>

  <div class="clearfix"></div>

  <div class="single_game_wrap">
    <div class="main-game border-radius">
      <div class="title-special border-radius">
        <div class="padding-10">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>

      <div class="player">
        <div class="preloader">
          <?php
          if ( ! myfriv_get_option('preloader') ) {
            if ( myfriv_get_option('ad_336x280') ) {
              get_template_part( "partials/advertisement", "336" );
            }
            ?>
            <p>
              <?php _e("Loading...", "myfriv"); ?>
              <br /><br />
              <img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" />
              <br /><br />
              <a href="#" class="skip"><?php _e("Skip Advertisement", "myfriv"); ?></a>
            <p>
            <?php
          } ?>
        </div>

        <div class="game">
          <center>
            <div id="myarcade_game">
              <?php
              if ( function_exists( 'get_game' ) ) {
                global $mypostid; $mypostid = $post->ID;
                echo myarcade_get_leaderboard_code();
                echo get_game();
              }
              ?>
            </div>
          </center>
          <div class="lgtbxbg-pofi"></div>
        </div>

        <div class="control">
          <ul>
            <li><a href="#" class="trnlgt" title="<?php _e("Turn lights on/off", 'kizitheme' ); ?>"><span class="icon icon-lightbulb"></span></a></li>
            <li><a href="<?php echo get_permalink() . 'fullscreen'; ?>/" class="fa-arrows-alt" title="<?php _e('Play in fullscreen', 'myarcadetheme'); ?>"><span class="icon icon-resize-full-alt"></span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php if ( myfriv_get_option('single_728x90') ) : ?>
    <div class="adbelowgame">
    <?php get_template_part( "partials/advertisement", "728" ); ?>
    </div>
  <?php endif; ?>
</section>

<section class="container main border-radius">
  <div class="padding-both">
    <div class="twelve columns">
      <div class="description">
        <div class="title-special border-radius">
          <div class="padding-10">
            <?php _e("Game description", "myfriv"); ?>
          </div>
        </div>

        <div class="padding-10 clearfix">
          <?php the_content(); ?>
        </div>

        <div class="padding-10">
          <div style="margin-top: 15px;">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
              <a class="addthis_button_preferred_1"></a>
              <a class="addthis_button_preferred_2"></a>
              <a class="addthis_button_preferred_3"></a>
              <a class="addthis_button_preferred_4"></a>
              <a class="addthis_button_compact"></a>
              <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-510b368f261b915a"></script>
            <!-- AddThis Button END -->
          </div>

          <div class="clearfix"></div>
          <div class="spacer"></div>

          <?php the_tags('<div class="tags"><span class="icon icon-tag"></span><ul><li>','</li><li>','</li></ul></div>'); ?>
        </div>
      </div>

      <?php if ( ! myfriv_get_option('game_comments') ) : ?>
      <div class="comments">
        <div class="title-special border-radius" style="margin-bottom: 10px;">
          <div class="padding-10">
            <?php _e("Comments", "myfriv"); ?>
          </div>
        </div>
        <?php comments_template(); ?>
      </div>
      <?php endif; ?>
    </div>

    <?php get_template_part( "partials/related" ); ?>
  </div>
</section>

<?php get_footer(); ?>