<?php get_header(); ?>

  <?php   
  if ( have_posts() ) {
    while (have_posts()) {
      the_post();
      // Display game and content
      get_template_part('games', 'play');
    } // end while
  }
  else {
	  // If no content, include the "No posts found" template.
	  get_template_part( 'content', 'none' ); 
  }
  
  // Do some actions before the content wrap ends
  do_action('arcadexls_before_content_end');
  ?>

<?php get_footer(); ?>