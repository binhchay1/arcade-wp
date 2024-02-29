<div class="clearfix"></div>

<footer id="footer">
  <div class="container-1400">
    © <?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>
    <div class="right">
      <div class="menu-footer">
        <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer', 'items_wrap' => '<ul>%3$s</ul>', ) ); ?>
      </div>

      <div class="powered">
        <?php printf( __("Powered by %s", "myfriv"), '<a href="http://myarcadeplugin.com/" title="WordPress Arcade Plugin" target="_blank">MyArcadePlugin</a>' ); ?>
      </div>
    </div>
  </div>
</footer>

<?php echo myfriv_get_option('tracking_code') ?>

<?php wp_footer(); ?>
</body>
</html>