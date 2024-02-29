<?php

/*
 * Embeds a youtube video
 */

if ( !class_exists('WP_Widget_MABP_Youtube_Video') ) {
  class WP_Widget_MABP_Youtube_Video extends WP_Widget {

      // Constructor
      function __construct() {

        $widget_ops   = array('description' => __('Embeds a youtube video to your sidebar.', 'arcadexls'));

        parent::__construct('MABP_Youtube_Video', __('MyArcade Youtube Widget', 'arcadexls'), $widget_ops);
      }

      // Display Widget
      function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', esc_attr($instance['title']));
        $videoid = apply_filters('widget_title', esc_attr($instance['videoid']));

        echo $before_widget;

        if($title) {
          echo $before_title . $title . $after_title;
        }
        // <-- START --> HERE COMES THE OUPUT

        ?>
        <div class="videowidget">
          <object width="300" height="250">
            <param name="movie" value="https://www.youtube.com/v/<?php echo $videoid; ?>&hl=en&fs=1&rel=0&border=1"></param>
            <param name="allowFullScreen" value="true"></param>
            <param name="allowscriptaccess" value="always"></param>
            <embed src="https://www.youtube.com/v/<?php echo $videoid; ?>&hl=en&fs=1&rel=0&border=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="300" height="250"></embed>
          </object>
        </div>
        <?php

        // <-- END --> HERE COMES THE OUPUT
        echo $after_widget;
      }

      // Update Widget
      function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['videoid'] = strip_tags($new_instance['videoid']);

        return $instance;
      }

      // Display Widget Control Form
      function form($instance) {
        global $wpdb;

        $instance = wp_parse_args((array) $instance, array('title' => __('Featured Video', 'arcadexls'), 'videoid' => 'eBx9mYEmPyQ'));

        $title = esc_attr($instance['title']);
        $videoid = esc_attr($instance['videoid']);

        ?>

        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title', 'arcadexls'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </label>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('videoid'); ?>">
            <?php _e('Video ID', 'arcadexls'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('videoid'); ?>" name="<?php echo $this->get_field_name('videoid'); ?>" type="text" value="<?php echo $videoid; ?>" />
          </label>
        </p>

        <?php
      }
    }
}
?>