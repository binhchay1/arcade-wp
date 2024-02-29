<?php

/*
 * Shows an advertisement banner
 */

if ( !class_exists('WP_Widget_MABP_Advertisement') ) {
  class WP_Widget_MABP_Advertisement extends WP_Widget {

      // Constructor
      function __construct() {

        $widget_ops   = array('description' => __('Show advertisements where ever you want in your sidebar.', 'arcadexls'));

        parent::__construct('MABP_Advertisement', __('MyArcade Advertisement', 'arcadexls'), $widget_ops);
      }

      // Display Widget
      function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', esc_attr($instance['title']));
        $adcode = $instance['adcode'];
        ?>
        <!--<advmnt>-->
        <section class="advmnt bgco1 rnd5">
          <?php echo $adcode; ?>
        </section>
        <!--</advmnt>-->
        <?php
      }

      // Update Widget
      function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['adcode'] = $new_instance['adcode'];

        return $instance;
      }

      // Display Widget Control Form
      function form($instance) {
        global $wpdb;

        $instance = wp_parse_args((array) $instance, array('title' => __('Advertisement', 'arcadexls'), 'adcode' => ''));

        $title = esc_attr($instance['title']);
        $adcode = $instance['adcode'];

        ?>

        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title', 'arcadexls'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </label>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('adcode'); ?>">
            <?php _e('300x250px Banner Code', 'arcadexls'); ?>
            <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"  name="<?php echo $this->get_field_name('adcode'); ?>"><?php echo $adcode; ?></textarea>
          </label>
        </p>

        <?php
      }
    }
}
?>
