<?php

/*
 * Shows random games scroller
 *
 */

if ( !class_exists('WP_Widget_MABP_Random_Games') ) {
  class WP_Widget_MABP_Random_Games extends WP_Widget {

    // Constructor
    function __construct() {

      $widget_ops   = array('description' => __('Shows a random game scroller.', 'arcadexls'));

      parent::__construct('MABP_Random_Games', __('MyArcade Game Scroller', 'arcadexls'), $widget_ops);
    }

    // Display Widget
    function widget($args, $instance) {
      extract($args);

      $title = apply_filters('widget_title', esc_attr($instance['title']));
      $limit = intval($instance['limit']);
      $category = isset($instance['category']) ? intval($instance['category']) : false;

      global $post, $wpdb;

      echo $before_widget;

      if($title) {
        echo $before_title . $title . $after_title;
      }

      // <-- START --> HERE COMES THE OUTPUT
      if ( !$category ) {$category = ''; $comma = ''; } else { $comma = ','; }

	  if(arcadexls_exclude_categories()!=''){
     	 $exclude = '&cat='.arcadexls_exclude_categories();
	  }else{
		 $exclude='';
	  }

      $games = new WP_Query("showposts=".$limit.'&orderby=rand'.$exclude.arcadexls_mobile_tag());

      if ( !empty($games) ) {
        ?>
        <ul class="pstgms lstli">
        <?php
        while( $games->have_posts() ) : $games->the_post();
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
        ?>
        </ul>
        <?php
      }

      // <-- END --> HERE COMES THE OUTPUT

      echo $after_widget;
    }

    // Update Widget
    function update($new_instance, $old_instance) {

      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = intval($new_instance['limit']);
      $instance['category'] = intval($new_instance['category']);

      return $instance;
    }

    // Display Widget Control Form
    function form($instance) {

      $instance = wp_parse_args((array) $instance, array('title' => __('Featured Games', 'arcadexls'), 'limit' => 12, 'wcategory' => 0));

      $title = esc_attr($instance['title']);
      $limit = intval($instance['limit']);

      if ( isset($instance['category']) )
        $category = intval($instance['category']);
      else
        $category = false;

      $slidercategs_obj = get_categories('hide_empty=0');
      $slidercategs = array();
      $slidercategs[0] = 'All';
      foreach ($slidercategs_obj as $categ) {
        $slidercategs[$categ->cat_ID] = $categ->cat_name;
      }

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

      <p>
        <label for="wcategory">
          <?php _e('Category', 'arcadexls'); ?><br />
          <select name="<?php echo $this->get_field_name('category'); ?>">
            <?php foreach ($slidercategs as $id => $name) { ?>
            <option value="<?php echo $id;?>" <?php if ( $category == $id) { echo 'selected="selected"'; } ?>><?php echo $name; ?></option>
            <?php } ?>
          </select>
        </label>
      </p>

      <?php
    }
  }
}
?>
