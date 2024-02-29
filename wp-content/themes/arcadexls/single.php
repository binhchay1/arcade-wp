<?php
get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    // Check if pre-game page is disabled.
    if( get_post_type(get_the_ID())=='contest' ) {
      get_template_part('mtsingle', 'contest');
    }
    elseif ( arcadexls_get_option('pregame-page', 1 ) == '1' && function_exists('is_game') && is_game() ) {
      // Pre-Game Page is enabled
      get_template_part('single', 'pre-game');
    }
    else {
      // Display game and content without the landing page
      if( function_exists('is_game') && is_game() ) {
        get_template_part('games', 'play');
      } else{
        get_template_part('single', 'content');
      }
    }
  } // end while
}
else {
  // If no content, include the "No posts found" template.
  get_template_part( 'content', 'none' );
}

// Do some actions before the content wrap ends
do_action('arcadexls_before_content_end');

get_footer();