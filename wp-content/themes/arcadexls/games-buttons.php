<ul class="game_opts">
  <?php if(arcadexls_get_option('lights-button', 1)) { ?>
  <li><a href="#" class="ictxt trnlgt" data-tooltip="tooltip" data-placement="left" title="<?php _e('TURN LIGHTS OFF/ON', 'arcadexls'); ?>">&#xf0eb;</a></li>
  <?php } ?>
  <?php arcadexls_favorite(); ?>
  <?php if(arcadexls_get_option('fullscreen-button')){ ?>
  <li><a href="<?php echo get_permalink() . 'fullscreen'; ?>/" class="ictxt" data-tooltip="tooltip" data-placement="left" title="<?php _e('Fullscreen', 'arcadexls'); ?>">&#xf065;</a></li>
  <?php } ?>
  <?php if(arcadexls_get_option('report-button', 1)==1 and function_exists('RBL_UI')) { ?>
  <li><?php arcadexls_report(); ?></li>
  <?php } ?>
</ul>