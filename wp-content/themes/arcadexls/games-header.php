<?php if( arcadexls_get_option('mtheaderbanner') !='' && !( arcadexls_get_option( 'mobile_header_slider', 0 ) && wp_is_mobile() )  or arcadexls_get_option('slider-header')!='' && !( arcadexls_get_option( 'mobile_header_slider', 0 ) && wp_is_mobile() ) ){ ?>
<!--<bnrsld>-->
<section class="bnrsld bgco1 clfl rnd5">
  <?php if(arcadexls_get_option('mtheaderbanner-switch', 1) == '1'){ ?>
  <?php
  $mtheaderbanner=stripslashes(arcadexls_get_option('mtheaderbanner'));
  ?>
  <!--<bnr728>-->
  <section class="bnr728 flol">
    <?php echo $mtheaderbanner; ?>
  </section>
  <!--</bnr728>-->
  <?php }?>
  <?php if(arcadexls_get_option('slider-header', 1)==1){ ?>
  <!--<sldrcnt>-->
  <section class="sldrgmcnt flor pore">
    <div class="sldr-title iconb-hert"><?php printf( __('MOST %sPOPULAR%s', 'arcadexls'), '<strong>', '</strong>'); ?></div>
    <ul class="sldrgm">
      <?php
      $games = new WP_Query(array('posts_per_page' => arcadexls_get_option('sortable-sliderhd', 20), 'r_sortby' => 'most_rated', 'r_orderby' => 'desc', 'category__in' => arcadexls_get_option('categories-sliderhd'), 'tag' => ( wp_is_mobile() && arcadexls_get_option( 'mobile' ) ) ? 'mobile' : '' ) );
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
<?php if(is_category() and !is_category(array(1))){ ?>
<?php echo arcadexls_breadcumb(); ?>

<div class="title bg bgco1 rnd5">
  <h1><?php echo single_cat_title("", false); ?></h1>
</div>
<?php } ?>