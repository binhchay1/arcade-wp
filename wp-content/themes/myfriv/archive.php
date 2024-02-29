<?php get_header(); ?>

<?php if ( myfriv_get_option('index_728x90') ) {
  get_template_part( "partials/advertisement", "728" );
} ?>

<div id="games_wrap">
  
    <div class="padding-10">
      <h1>
        <?php
        if ( is_category() ) {
          echo single_cat_title( '', false );
        }
        elseif ( is_tag() ) {
          echo single_tag_title( '', false );
        }
        else {
          _e( 'Archives', 'myfriv' );
        }
        ?>
      </h1>
    </div>

  <section id="games">
    <?php get_template_part( "partials/loop" ); ?>
  </section>
</div>

<a id="inifiniteLoader"><?php _e("Loading games...", "myfriv"); ?> <span class="icon icon-clock"></span></a>
<a id="inifiniteLoaderEnd"><?php _e("No more games...", "myfriv"); ?> <span class="icon icon-clock"></span></a>

<?php get_footer(); ?>