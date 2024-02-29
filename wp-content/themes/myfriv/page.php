<?php get_header(); ?>

<section class="container main">
  <div class="padding-10">
    <div class="title-special border-radius">
      <div class="padding-10">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>

    <div class="content padding-10">
      <p><?php the_content(); ?></p>
    </div>
  </div>
</section>

<?php get_footer(); ?>