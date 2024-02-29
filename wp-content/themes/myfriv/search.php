<?php get_header(); ?>

<?php if ( myfriv_get_option('index_728x90') ) {
  get_template_part( "partials/advertisement", "728" );
} ?>

<div class="container-1400" id="games_wrap">
  <section id="games" class="clearfix">
    <div class="padding-10">
      <h1>
        <?php printf( __("Search for %s", "kizitheme"), get_search_query() ); ?>
      </h1>
    </div>

    <?php get_template_part( "partials/loop" ); ?>
  </section>
</div>

<?php get_footer(); ?>