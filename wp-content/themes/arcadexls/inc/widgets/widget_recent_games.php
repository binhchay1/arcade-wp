<?php

/*
 * Shows thumbnails of the recent games
 *
 */

if ( !class_exists('WP_Widget_MABP_Recent_Games') ) {
  class WP_Widget_MABP_Recent_Games extends WP_Widget {

    // Constructor
    function __construct() {

      $widget_ops   = array('description' => __('Shows images of the most recent games.', 'arcadexls'));

      parent::__construct('MABP_Recent_Games', __('MyArcade Recent Games', 'arcadexls'), $widget_ops);
    }

    // Display Widget
    function widget($args, $instance) {
      extract($args);

      $title = apply_filters('widget_title', esc_attr($instance['title']));
      $limit = intval($instance['limit']);

      global $post, $wpdb;

      echo $before_widget;

      if($title) {
        echo $before_title . $title . $after_title;
      }

	  echo'<section class="sldrcngms_cn"><ul class="sldrcn_gms" style="height:50px;position:absolute">';
      // <-- START --> HERE COMES THE OUTPUT
	  if(arcadexls_exclude_categories()!=''){
     	 $exclude = '&cat='.arcadexls_exclude_categories();
	  }else{
		 $exclude='';
	  }

      $games = new WP_Query("showposts=".$limit.$exclude.arcadexls_mobile_tag());

      if ( !empty($games) ) {

        while( $games->have_posts() ) : $games->the_post();
          ?>
            <!--<game>-->
            <li style="opacity:0.0">
                <article>
                    <div class="pstcnt bgco1 rnd5">
                        <figure class="rnd5"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php myarcade_thumbnail( array( 'width' => 60, 'height' => 60 , 'class' => 'widgetimage', 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?><span class="iconb-game" title="<?php the_title_attribute(); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></span></a></figure>
                    </div>
                    <header>
                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php myarcade_title(20); ?></a></h4>
                        <?php if(function_exists('the_ratings')) { ?>
                        <div class="votcnt">
                            <?php echo mt_the_ratings_results($post->ID); ?>
                        </div>
                        <?php } ?>
                        <p class="info-ics"><?php if(function_exists('the_views')) { ?><span class="iconb-game"><strong><?php the_views(); ?></strong> <?php _e('Plays', 'arcadexls'); ?></span><?php } ?> <strong class="iconb-comt"><?php echo get_comments_number(); ?></strong></p>
                    </header>
                </article>
            </li>
            <!--</game>-->
	  <?php
        endwhile;
      }

      // <-- END --> HERE COMES THE OUTPUT
      echo'</ul></section>';
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

      $instance = wp_parse_args((array) $instance, array('title' => __('Recent Games', 'arcadexls'), 'limit' => 12));

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
