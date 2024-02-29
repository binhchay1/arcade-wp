<?php /*
List template
This template returns the related posts as a comma-separated list.
Author: Megatemas.com
*/
?>
<?php if ( $related_query->have_posts() ): ?>
                        	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
        <!--<game>-->
        <li>
            <article class="pstcnt bgco1 rnd5">
                <figure class="rnd5"><a href="<?php the_permalink() ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>" itemprop="url"><?php myarcade_thumbnail( array( 'width' => 130, 'height' => 130 , 'lazy_load' => arcadexls_get_option('lazy_load'), 'show_loading' => arcadexls_get_option( 'lazy_load_animation' ) ) ); ?></a></figure>
                <header>
                    <h2 itemprop="name"><a href="<?php the_permalink() ?>" class="thumb_link" rel="bookmark" title="<?php echo $post->post_title; ?>" itemprop="url"><?php the_title(); ?></a></h2>
                    <p><?php echo get_the_category_list(', '); ?></p>
                    <a class="iconb-game" href="<?php the_permalink(); ?>" title="<?php printf( __('Play %s', 'arcadexls'), get_the_title()); ?>"><span><?php _e('Play', 'arcadexls'); ?></span></a>
                </header>
            </article>
        </li>
        <!--</game>-->
                            <?php endwhile; ?>
<?php endif; ?> 