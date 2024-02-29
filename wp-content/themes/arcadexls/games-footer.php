<?php if(!is_single() and !is_page()){ ?>
<?php if(arcadexls_get_option('mtfooterbanner')!='' && !( arcadexls_get_option( 'mobile_header_slider', 0 ) && wp_is_mobile() ) or arcadexls_get_option('slider-footer')!='' && !( arcadexls_get_option( 'mobile_header_slider', 0 ) && wp_is_mobile() ) ){ ?>
<!--<bnrsld>-->
<section class="bnrsld bgco1 clfl rnd5">
  <?php
  if(arcadexls_get_option('mtfooterbanner-switch', 1) == '1'){
    $mtfooterbanner=stripslashes(arcadexls_get_option('mtfooterbanner'));
    ?>
    <!--<bnr728>-->
    <section class="bnr728 flol">
      <?php echo $mtfooterbanner; ?>
    </section>
    <!--</bnr728>-->
    <?php
  }
  ?>
  <?php if(arcadexls_get_option('slider-footer', 1) == 1) { ?>
  <!--<sldrcnt>-->
  <section class="sldrgmcnt flor pore">
    <div class="sldr-title iconb-hert"><?php printf( __('MOST %sPLAYED%s', 'arcadexls'), '<strong>', '</strong>'); ?></div>
    <ul class="sldrgm">
      <?php
      $games = new WP_Query( array('posts_per_page' => arcadexls_get_option('sortable-sliderft', 20), 'v_sortby' => 'views', 'v_orderby' => 'desc', 'category__in' => arcadexls_get_option('categories-sliderft'), 'tag' => ( wp_is_mobile() && arcadexls_get_option( 'mobile' ) ) ? 'mobile' : '' ) );

      while( $games->have_posts() ) : $games->the_post(); 
      ?>
      <!--<game>-->
      <li style="opacity:0.0">
        <article class="pstcnt rnd5">
          <figure class="rnd5"><a href="<?php the_permalink(); ?>"><?php myarcade_thumbnail( array( 'width' => 90, 'height' => 90 , 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?><span class="iconb-game rgba1" title="<?php _e('Play', 'arcadexls'); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></span></a></figure>
        </article>
      </li>
      <!--</game>-->
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </ul>
  </section>
  <!--</sldrcnt>-->
  <?php } ?>
</section>
<!--</bnrsld>-->
<?php } ?>
<?php } ?>