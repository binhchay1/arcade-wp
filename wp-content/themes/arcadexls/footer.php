<?php get_template_part('games', 'footer'); ?>
</section>
<!--</bdcn>-->
<?php
// Do some actions before the footer
do_action('arcadexls_before_footer');
?>
<!--<ftcn>-->
<footer class="ft" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
  <section class="ftcn bgdg1-shdw1-rnd5">
    <section class="ftcn1 flol-pore">
      <?php $logo = arcadexls_get_option('logohd'); ?>
      <div class="logo flol-pore"><a href="<?php echo home_url();?>" title="<?php bloginfo('name');?>"><img src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('blogname');?>"></a></div>
      <nav class="navcnt flol-pore" itemscope="itemscope" itemtype="http://www.schema.org/SiteNavigationElement">
        <button type="button" class="btn-collapse" data-toggle="collapse" data-target=".menucn-ft" data-tooltip="tooltip" data-placement="top" title="<?php _e('Menu', 'arcadexls'); ?>"><span class="iconb-menu rgba1 rnd5"><?php _e('Menu', 'arcadexls'); ?></span></button>
        <div class="menucn menucn-ft collapse">
          <ul>
            <li><a class="iconb-home" href="<?php echo home_url(); ?>"><?php _e('HOME', 'arcadexls'); ?></a></li>
            <?php wp_nav_menu(array('fallback_cb' => 'arcadexls_default_menu', 'container' => '', 'theme_location' => 'menu_footer', 'items_wrap' => '%3$s', 'walker' => new arcadexls_walker_nav_menu())); ?>
            <?php if(arcadexls_get_option('mtrandomgame')!=''){ ?>
            <li><a class="iconb-rand" href="<?php echo arcadexls_get_option('mtrandomgame'); ?>"><?php _e('RANDOM GAME', 'arcadexls'); ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </nav>
    </section>

    <?php arcadexls_get_social_icons('footer'); ?>

  </section>
  <section class="ftxt">
    <p><?php $copyright = arcadexls_get_option( 'footer_copyright' ); if ( empty( $copyright ) ) { $copyright = sprintf( __('Proudly powered by %sMyArcadePlugin%s', 'arcadexls'), '<a target="_blank" href="http://myarcadeplugin.com/" title="WordPress Arcade" itemprop="url">', '</a>' ) ; } echo $copyright; ?></p>
  </section>
</footer>
<!--</ftcn>-->
<?php
// Do some actions after the footer
do_action('arcadexls_after_footer');
?>
</section>
<!--</wrpp>-->

<?php wp_footer(); ?>
<!--[if lt IE 9]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/css3mq.js"></script><![endif]-->
<!--[if lte IE 9]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/ie.js"></script><![endif]-->

</body>
</html>