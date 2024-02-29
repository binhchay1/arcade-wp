<?php

/*
 * Shows the User Login panel. When the user is logged in serveral user links
 * are shown.
 *
 */

if ( !class_exists('WP_Widget_MABP_User_Login') ) {
  class WP_Widget_MABP_User_Login extends WP_Widget {

    // Constructor
    function __construct() {

      $widget_ops   = array('description' => __('Shows the user login and the user panel.', 'arcadexls'));

      parent::__construct('MABP_User_Login', __('MyArcade User Login Panel', 'arcadexls'), $widget_ops);

      add_action('wp_print_scripts', array($this, 'js_load_scripts'));

    }

	function js_load_scripts () {
    if ( defined('WDFB_PLUGIN_URL')) {
		if (!is_admin()) wp_enqueue_script('wdfb_connect_widget', WDFB_PLUGIN_URL . '/js/wdfb_connect_widget.js');
		if (!is_admin()) wp_enqueue_script('wdfb_facebook_login', WDFB_PLUGIN_URL . '/js/wdfb_facebook_login.js');
    }
	}

    // Display Widget
    function widget($args, $instance) {

      $current_user = wp_get_current_user();

      extract($args);

      $title = apply_filters('widget_title', esc_attr($instance['title']));

      echo $before_widget.$before_title.$title.$after_title;

      // <-- START --> HERE COMES THE OUPUT
      if ( $current_user->ID ) {
        // user is logged in
		global $mngl_options, $mngl_message;
        ?>
		<!--<user panel>-->
                    <ul class="leabrd">
                        <li>
                            <figure><?php echo get_avatar( $current_user->user_email, $size = '85'); ?></figure>
                            <p><?php _e('Hello', 'arcadexls'); ?>, <strong><?php echo $current_user->display_name; ?></strong>!</p>
                            <ul class="menusr">
                                <li class="mycnt">
                                    <a class="botn" href="<?php if(defined('BP_VERSION')){ global $bp; echo $bp->loggedin_user->domain; }else{ echo home_url().'/wp-admin/profile.php'; } ?>" title="<?php _e('MY ACCOUNT', 'arcadexls'); ?>"><?php _e('MY ACCOUNT', 'arcadexls'); ?></a>
                                    <ul>
									<?php if ( defined('MNGL_PLUGIN_NAME') ) : ?>
                                    <?php
                                      $unread_count = $mngl_message->get_unread_count();
                                      $unread_count_str = '[0]';
                                      if($unread_count) $unread_count_str = " [{$unread_count}]";
                                    ?>
                                    <li><a href="<?php echo get_permalink($mngl_options->activity_page_id); ?>"><?php _e('Activity', 'arcadexls'); ?></a></li>
                                    <li><a href="<?php echo get_permalink($mngl_options->profile_page_id); ?>"><?php _e('Profile', 'arcadexls'); ?></a></li>
                                    <li><a href="<?php echo get_permalink($mngl_options->profile_edit_page_id); ?>"><?php _e('Settings', 'arcadexls'); ?></a></li>
                                    <li><a href="<?php echo get_permalink($mngl_options->friends_page_id); ?>"><?php _e('Friends', 'arcadexls'); ?></a></li>
                                    <li><a href="<?php echo get_permalink($mngl_options->friend_requests_page_id); ?>"><?php _e('Friend Requests', 'arcadexls'); ?><?php echo $request_count_str; ?></a></li>
                                    <li><a href="<?php echo get_permalink($mngl_options->inbox_page_id); ?>"><?php _e('Inbox', 'arcadexls'); ?> <?php echo $unread_count_str; ?></a></li>

                                    <?php elseif ( defined('BP_VERSION') ) : ?>
                                    <?php global $bp; ?>
                                    <?php if( bp_is_active('activity') ) : ?>
                                    <li><a href="<?php echo $bp->loggedin_user->domain . BP_ACTIVITY_SLUG . '/'; ?>"><?php _e('Activity', 'arcadexls'); ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo site_url( bp_get_members_root_slug() ); ?>"><?php _e('Members', 'arcadexls'); ?></a></li>
                                    <?php if( bp_is_active('groups') ) : ?>
                                    <li><a href="<?php echo $bp->loggedin_user->domain . BP_GROUPS_SLUG . '/'; ?>"><?php _e('Groups', 'arcadexls'); ?></a></li>
                                    <?php endif; ?>
                                    <?php if ( bp_is_active( 'friends' ) ) : ?>
                                    <li><a href="<?php echo $bp->loggedin_user->domain . BP_FRIENDS_SLUG . '/'; ?>"><?php _e('Friends', 'arcadexls'); ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e('Profile', 'arcadexls'); ?></a></li>
                                    <?php if ( isset($bp->myscore) ) : ?>
                                    <li><a href="<?php echo $bp->loggedin_user->domain . $bp->myscore->slug . '/'; ?>"><?php _e('My Scores', 'arcadexls'); ?></a></li>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <li><a href="<?php echo home_url(); ?>/wp-admin/index.php"><?php _e('Go to Dashboard', 'arcadexls'); ?></a></li>
                                    <li><a href="<?php echo home_url(); ?>/wp-admin/profile.php"><?php _e('Edit My Profile', 'arcadexls'); ?></a></li>
                                    <?php endif; ?>
                                    </ul>
                                </li>
                                <li><a class="botn logout" href="<?php echo wp_logout_url( home_url() ); ?>" title="<?php _e('LOGOUT', 'arcadexls'); ?>"><?php _e('LOGOUT', 'arcadexls'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                	<?php if(function_exists('wpfp_list_favorite_posts')) { ?>
                    <h4><?php _e('Your Favorite Games', 'arcadexls'); ?></h4>
						<?php wpfp_list_favorite_posts(); ?>
                	<?php } ?>
        <!--</user panel>-->
        <?php
      } else {
        // user isn't logged in
        ?>
		<!--<user panel>-->
        <section class="blkcnt bgco2 bbp_widget_login">
            <fieldset id="loginBox">
                <form action="<?php echo home_url(); ?>/wp-login.php" method="post">
                    <label><input autocomplete="off" type="text" name="log" id="log" placeholder="<?php _e('username', 'arcadexls'); ?>"></label>
                    <label><input autocomplete="off" type="password" name="pwd" id="pwd" placeholder="<?php _e('password', 'arcadexls'); ?>"></label>
                    <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>/">
                    <input type="submit" name="Login" value="<?php _e('Login', 'arcadexls'); ?>" class="logininp">
                </form>
				<?php
                if(get_option('users_can_register')) {
                $signup_url = home_url() . '/wp-login.php?action=register';

                if ( defined('MNGL_PLUGIN_NAME') ) {
                global $mngl_options;

                if( !empty($mngl_options->signup_page_id) and $mngl_options->signup_page_id > 0) {
                  $signup_url = get_permalink($mngl_options->signup_page_id);
                }
                }
                ?>
                <p><a href="<?php echo $signup_url; ?>"><?php _e('Register', 'arcadexls'); ?></a></p>
              	<?php } ?>
                <p><a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword"><?php _e('Lost password?', 'arcadexls'); ?></a></p>
				<?php
				if ( function_exists('wdfb_get_fb_plugin_markup') && class_exists('Wdfb_Permissions') ) {
				 echo '<p class="wdfb_login_button">' .
					wdfb_get_fb_plugin_markup('login-button', array(
					   'scope' => Wdfb_Permissions::get_permissions(),
					   'redirect-url' => wdfb_get_login_redirect(),
					   'content' => __("Login with Facebook", 'arcadexls'),
					)) .
				 '</p>';
				}
				?>
            </fieldset>
        </section>
        <!--</user panel>-->
        <?php
      }
      // <-- END --> HERE COMES THE OUPUT

      echo $after_widget;
    }

    // Update Widget
    function update($new_instance, $old_instance) {

      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);

      return $instance;
    }

    // Display Widget Control Form
    function form($instance) {
      global $wpdb;

      $instance = wp_parse_args((array) $instance, array('title' => __('User Panel', 'arcadexls')));

      $title = esc_attr($instance['title']);

      ?>

      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
          <?php _e('Title', 'arcadexls'); ?>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </label>
      </p>
      <?php
    }
  }
}
?>