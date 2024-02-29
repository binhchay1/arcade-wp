<?php if ( ! ( arcadexls_get_option( 'mobile_sidebar', 0 ) && wp_is_mobile() ) ) : ?>
            <!--<sdbr>-->
            <aside class="sdbr <?php echo arcadexls_sidebar(2); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">

				<?php
                // Do some actions before the widget area
                do_action('arcadexls_before_sidebar_widgets');
                ?>
              
                <?php   
                // Reset WordPress query vars
                wp_reset_query();
                
                if (is_single()) {
                  if (is_active_sidebar('single-sidebar')) {
                  dynamic_sidebar('single-sidebar');
                  } else {
                    ?>
                    <div class="box sidebar">
                      <div class="warning">
                        <?php _e('This is your Game Sidebar and no widgets have been placed here, yet!', 'arcadexls'); ?>
                        <p><?php sprintf( __('Click %shere%s to setup this this sidebar!', 'arcadexls'), '<a href="'.home_url().'/wp-admin/widgets.php">', '</a>'); ?></p>
                      </div>
                    </div>
                    <?php      
                  }
                }
                elseif (is_page()) {
                  if (is_active_sidebar('page-sidebar')) {
                  dynamic_sidebar('page-sidebar');
                  } else {
                    ?>
                    <div class="box sidebar">
                      <div class="warning">
                        <?php _e('This is your Page Sidebar and no widgets have been placed here, yet!', 'arcadexls'); ?>
                        <p><?php sprintf( __('Click %shere%s to setup this this sidebar!', 'arcadexls'), '<a href="'.home_url().'/wp-admin/widgets.php">', '</a>'); ?></p>
                      </div>
                    </div>
                    <?php      
                  }    
                }
                elseif (is_category()) {
                  if (is_active_sidebar('category-sidebar')) {
                  dynamic_sidebar('category-sidebar');
                  } else {
                    ?>
                    <div class="box sidebar">
                      <div class="warning">
                        <?php _e('This is your Category Sidebar and no widgets have been placed here, yet!', 'arcadexls'); ?>
                        <p><?php sprintf( __('Click %shere%s to setup this this sidebar!', 'arcadexls'), '<a href="'.home_url().'/wp-admin/widgets.php">', '</a>'); ?></p>
                      </div>
                    </div>
                    <?php      
                  }   
                }
                else {
                  // Home Sidebar
                  if (is_active_sidebar('others-sidebar')) {
                  dynamic_sidebar('others-sidebar');
                  } else {
                    ?>
                    <div class="box sidebar">
                      <div class="warning">
                        <?php _e('This is your Others Sidebar and no widgets have been placed here, yet!', 'arcadexls'); ?>
                        <p><?php sprintf( __('Click %shere%s to setup this this sidebar!', 'arcadexls'), '<a href="'.home_url().'/wp-admin/widgets.php">', '</a>'); ?></p>
                      </div>
                    </div>
                    <?php      
                  }    
                }
                ?>
                
                <?php
                // Do some actions after the widget area
                do_action('arcadexls_after_sidebar_widgets');
                ?>

            </aside>
            <!--</sdbr>-->
<?php endif; ?>            