<?php
get_header();

if ( is_category() ) {
  // Generate a new query on category pages
  global $query_string;
  $query = $query_string . arcadexls_mobile_tag();
  query_posts( $query );
}

if ( have_posts() ) :
  if( arcadexls_get_option( 'mtlastlbanner-switch', 1) == '1'){
    $mtlastlbanner=stripslashes( arcadexls_get_option('mtlastlbanner') );
    ?>
    <section class="advmnt advmnt-a bgco1 flol rnd5" data-titl="<?php _e('ADVERTISEMENTS', 'arcadexls'); ?>">
      <?php echo $mtlastlbanner; ?>
    </section>
    <?php
  }
  ?>
  <ul id="content" class="pstgms lstli">
    <?php while ( have_posts() ) : the_post(); ?>
      <li class="post">
        <article class="pstcnt bgco1 rnd5">
          <figure class="rnd5"><a href="<?php the_permalink(); ?>"><?php myarcade_thumbnail(130, 130); ?></a></figure>
          <header>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo get_the_category_list(', '); ?></p>
            <a class="iconb-game" href="<?php the_permalink(); ?>" title="<?php _e('Play', 'arcadexls'); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></a>
          </header>
        </article>
      </li>
    <?php endwhile; ?>
  </ul>

  <?php mt_pagination(); ?>
<?php else :
  // If no content, include the "No posts found" template.
  get_template_part( 'content', 'none' );
endif;

get_footer();