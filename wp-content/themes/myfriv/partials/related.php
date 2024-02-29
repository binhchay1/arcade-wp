<div class="related four columns">
  <div class="title-special border-radius">
    <div class="padding-10">
      <?php _e("Related Games", "myfriv"); ?>
    </div>
  </div>
  <?php
  $args = array(
    'category__in' => wp_get_post_categories( get_the_ID() ),
    'posts_per_page' => intval( myfriv_get_option('related_number') ),
    'post__not_in' => array( get_the_ID() ),
  );

  $relatedgames = new WP_Query( $args);

  if ( $relatedgames->have_posts() ) : ?>
    <?php while ( $relatedgames->have_posts() ) : $relatedgames->the_post(); ?>
      <article class="games">
        <a href="<?php the_permalink(); ?>"  class="tooltip" title="<?php the_title(); ?>">
          <div class="thumb">
            <div class="play">
              <span class="icon icon-link"></span>
            </div>

            <?php myarcade_thumbnail(); ?>
          </div>
        </a>
      </article>
    <?php endwhile; wp_reset_postdata(); ?>
  <?php else: ?>
    <p><?php _e("No related games found", 'myfriv' ); ?></p>
  <?php endif; ?>
</div>