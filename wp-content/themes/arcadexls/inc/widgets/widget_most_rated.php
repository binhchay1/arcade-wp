<?php

/*
 * Shows the most rated games with thumbnails
 *
 * Required: WP-PostRatings Plugin
 */

if ( !class_exists('WP_Widget_MABP_Most_Rated') ) {
  class WP_Widget_MABP_Most_Rated extends WP_Widget {

    // Constructor
    function __construct() {

      $widget_ops   = array('description' => __('Shows images of the most rated games. WP-Ratings Plugin required!', 'arcadexls'));

      parent::__construct('MABP_Most_Rated', __('MyArcade Most Rated Games', 'arcadexls'), $widget_ops);
    }

    // Display Widget
    function widget($args, $instance) {
      extract($args);

      $title = apply_filters('widget_title', esc_attr($instance['title']));
      $limit = intval($instance['limit']);

      global $post, $wpdb;

      echo $before_widget.$before_title.$title.$after_title;
	  if(arcadexls_exclude_categories()!=''){
     	 $exclude = '&cat='.arcadexls_exclude_categories();
	  }else{
		 $exclude='';
	  }

      if(function_exists('the_ratings')) {
        $most_rated = new WP_Query("showposts=".$limit."&r_sortby=highest_rated&r_orderby=desc".$exclude.arcadexls_mobile_tag());
      } else {
        $most_rated = new WP_Query("showposts=".$limit."&orderby=rand".$exclude.arcadexls_mobile_tag());
      }
	  echo'
        <ul class="pstgms lstli">';
      if ( !empty($most_rated) ) {

        while( $most_rated->have_posts() ) : $most_rated->the_post();
          ?>
        <!--<game>-->
        <li>
            <article class="pstcnt bgco1 rnd5">
                <figure class="rnd5"><a href="<?php the_permalink(); ?>"><?php myarcade_thumbnail( array( 'width' => 60, 'height' => 60 , 'class' => 'widgetimage', 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?><span class="iconb-game" title="<?php the_title_attribute(); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></span></a></figure>
            </article>
        </li>
        <!--</game>-->
	  <?php
        endwhile;
      }
      else {
        ?><li><?php _e('No Games', 'arcadexls'); ?><li><?php
      }
	  echo'</ul>';
      echo $after_widget;
    }

    // Update Widget
    function update($new_instance, $old_instance) {

      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = intval($new_instance['limit']);

      return $instance;
    }

    // Display Widget Control Form
    function form($instance) {
      global $wpdb;

      $instance = wp_parse_args((array) $instance, array('title' => __('Most Rated Games', 'arcadexls'), 'limit' => 12));

      $title = esc_attr($instance['title']);
      $limit = intval($instance['limit']);

      ?>

      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
          <?php _e('Title', 'arcadexls'); ?>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </label>
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>">
          <?php _e('Limit', 'arcadexls'); ?>
          <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
        </label>
      </p>

      <?php
    }
  }
}
?>
