<?php if ( have_posts() ) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <article class="games">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="thumb">
          <div class="play">
            <span class="icon icon-link"></span>
          </div>

          <?php myarcade_thumbnail(); ?>
        </div>
      </a>
    </article>
  <?php endwhile; ?>
<?php else : ?>
  <section class="wrapper-single">
  <div class="notfound">
    <img src="<?php echo get_template_directory_uri(); ?>/images/notfound.png" />
    <br />
    <h2><?php _e("Sorry, the page you asked for couldn't be found.", "myfriv"); ?></h2>
    <br />
    <p><?php _e("Try another search...", "myfriv"); ?>.</p>
  </div>
</section>
<?php endif; ?>