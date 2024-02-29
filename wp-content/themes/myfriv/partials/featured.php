<?php
// Check if featured games have been disabled
if ( ! myfriv_get_option('feat_games')) : ?>
    <div id="feat">
      <div class="container container-flex">
        <?php
        $featured_query= array(
          'posts_per_page'  => 8,
          'order' => 'DESC',
          'orderby' => 'meta_value_num',
          'meta_key' => 'post_views_count',
        );

        $featured = new WP_Query( $featured_query );

        if ( $featured->have_posts() ) :
          while ($featured->have_posts()) : $featured->the_post(); ?>
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
            <?php
          endwhile;
          wp_reset_query(); ?>
        <?php else : ?>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>