<?php get_header(); ?>

<section class="wrapper-single">
  <div class="notfound">
    <img src="<?php echo get_template_directory_uri(); ?>/images/notfound.png" />
    <br />
    <h2><?php _e("Sorry, the page you asked for couldn't be found.", "myfriv"); ?></h2>
    <br />
    <p><?php _e("Try another search...", "myfriv"); ?>.</p>
  </div>
</section>

<?php get_footer(); ?>