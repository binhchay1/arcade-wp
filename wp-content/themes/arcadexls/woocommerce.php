<?php
/**
 * The template for displaying products on the woocommerce shop page.
 *
 * This is the template that displays the Woocommerce shop page.
 *
 * @package WordPress
 * @subpackage MyArcadeTheme
 */

get_header(); ?>

<section class="cont <?php echo arcadexls_sidebar(1); ?>">
      <?php woocommerce_breadcrumb(); ?>

      <?php woocommerce_content(); ?>
</section>

    <?php get_sidebar(); ?>
<?php get_footer(); ?>