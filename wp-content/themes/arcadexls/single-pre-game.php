<?php
global $post;
global $mypostid; $mypostid = $post->ID;
?>
<?php echo arcadexls_breadcumb(); ?>

<section class="cont <?php echo arcadexls_sidebar(1); ?>">

  <header class="title bg bgco1 rnd5">
    <h1><?php the_title(); ?></h1>
  </header>

  <section class="game-brcn bgdg1 clfl rnd5 shdw1">
    <?php if(function_exists('the_ratings')) { ?>
    <div class="flol">
      <span class="iconb-rate"><?php printf( __('%sRATE%s THIS GAME:', 'arcadexls'), '<strong>', '</strong>'); ?></span>
      <div class="votcnt">
        <?php the_ratings(); ?>
      </div>
    </div>
    <?php } ?>
    <div class="flor">
      <?php if (function_exists('wpfp_link')) { echo arcadexls_countfav(); } ?><?php if(function_exists('the_views')) { ?><span class="iconb-game"><?php the_views(); ?></span><?php } ?>
    </div>
  </section>

  <article class="blkcnt bgco2 game-info post-advrsm">
    <header class="bltitl"><?php printf( __('%s Game info', 'arcadexls'), '<h2>'.get_the_title().'</h2>'); ?></header>
    <section class="blcnbx">
      <figure class="imgcnt"><?php myarcade_thumbnail( array( 'width' => 80, 'height' => 80 , 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?></figure>
      <section>
        <p><strong><?php _e('Description:', 'arcadexls'); ?></strong></p>
        <?php echo arcadexls_content(); ?>
        <?php if ( function_exists("myarcadecontrols_output") ) echo myarcadecontrols_output(); ?>
      </section>
      <div class="bnrpst">
        <?php

        if( arcadexls_get_option('mtpregamebanner-switch', 1 ) == '1'){
          $mtpregamebanner=stripslashes( arcadexls_get_option('mtpregamebanner') );
          ?>
          <div class="bnr200">
            <?php echo $mtpregamebanner; ?>
          </div>
          <?php
        }
        ?>
        <?php arcadexls_play_link(); ?>
      </div>
    </section>
    <footer>
      <span class="iconb-date"><?php _e('Uploaded on:', 'arcadexls'); ?> <strong><?php echo get_the_date('d'); ?> <?php echo get_the_date('M'); ?> , <?php echo get_the_date('Y'); ?></strong></span> <span class="iconb-user"><?php _e('Uploader:', 'arcadexls'); ?> <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('display_name',$post->post_author); ?></a></span> <span class="iconb-cate"><?php _e('Categories:', 'arcadexls'); ?> <?php echo get_the_category_list(', '); ?></span> <span class="iconb-comt"><?php printf( __('Comments: <strong>%s</strong>', 'arcadexls'), get_comments_number() ); ?></span> <?php echo get_the_tag_list('<span class="iconb-tags">'.__('Tags:', 'arcadexls').' ', ', ','</span>'); ?>
    </footer>
  </article>
  <?php if( arcadexls_get_option('display-game-screen-shots', 1 ) == 1 and myarcade_count_screenshots()>0){ ?>
  <section class="blkcnt bgco2">
    <div class="bltitl"><?php printf( __('%s Screen Shots', 'arcadexls'), '<h3>'.get_the_title().'</h3>'); ?></div>
    <div class="blcnbx scrlbr">
      <ul class="pstgms lstli">
        <?php myarcade_all_screenshots(130, 130, 'screen_thumb'); ?>
      </ul>
    </div>
  </section>
  <?php } ?>
  <?php
  $video = myarcade_video('600', '500');
  if ( arcadexls_get_option('display-game-video', 1) ==1 && $video ) : ?>
  <section class="blkcnt bgco2">
    <div class="bltitl"><?php printf( __('%s Video', 'arcadexls'), '<h3>'.get_the_title().'</h3>'); ?></div>
    <div class="blcnbx">
      <center><?php echo $video; ?></center>
    </div>
  </section>
  <?php endif; ?>
  <?php if ( arcadexls_get_option('game-embed-box', 1 ) == 1 ) { ?>
  <section class="blkcnt bgco2">
    <div class="bltitl"><?php _e('Do You Like This Game?', 'arcadexls'); ?></div>
    <div class="blcnbx">
      <p><?php _e('Embed this game on your MySpace or on your Website:', 'arcadexls'); ?></p>
      <form name="select_all" action="#">
        <textarea name="text_area" onClick="javascript:this.form.text_area.focus();this.form.text_area.select();" class="intx rnd5" cols="66" rows="6"><a href="<?php echo home_url();?>"><?php bloginfo('name'); ?></a><br /><?php if ( function_exists('get_game_code') ) { echo get_game_code(); } else { if ( function_exists('get_game')) { echo get_game($post->ID); } } ?></textarea>
      </form>
    </div>
  </section>
  <?php } ?>

  <?php arcadexls_related(); ?>

  <?php comments_template(); ?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>