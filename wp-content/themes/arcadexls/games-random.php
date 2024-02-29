    <?php
	if(arcadexls_exclude_categories()!=''){
	 $exclude = '&cat='.arcadexls_exclude_categories();
	}else{
	 $exclude='';  
	}

    $relatedgames = new WP_Query ('showposts=10&orderby=rand'.$exclude.arcadexls_mobile_tag());
    if ( $relatedgames->have_posts() ) 
      while ($relatedgames->have_posts()) :
        $relatedgames->the_post();
        ?>        
        <!--<game>-->
        <li>
            <article class="pstcnt bgco1 rnd5">
                <figure class="rnd5"><a href="<?php the_permalink() ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>"><?php myarcade_thumbnail( array( 'width' => 130, 'height' => 130 , 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?></a></figure>
                <header>
                    <h2><a href="<?php the_permalink() ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo get_the_category_list(', '); ?></p>
                    <a class="iconb-game" href="<?php the_permalink(); ?>" title="<?php printf( __('Play %s', 'arcadexls'), get_the_title()); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></a>
                </header>
            </article>
        </li>
        <!--</game>-->
    <?php endwhile; ?>
<?php wp_reset_query(); ?>