<?php
global $post;
$gameID = get_post_meta($post->ID, 'contest_gameid', true);
?>
			<?php echo arcadexls_breadcumb(); ?>
            
            <!--<cont>-->
            <section class="cont <?php echo arcadexls_sidebar(1); ?>">
                <!--<article>-->
            	<article>
                    <header class="title bg bgco1 rnd5">
                        <h1><?php the_title(); ?></h1>
                    </header>
                    <div class="blkcnt bgco2 game-info post-blog post-blog-single post-contest">
                        <section class="blcnbx">
                            <section>
        						<a href="<?php echo get_permalink() . $endpoint . '/'; ?>" title="<?php _e("PLAY NOW!", 'arcadexls'); ?> <?php the_title_attribute(); ?>" rel="bookmark nofollow" class="botn"><?php _e("PLAY NOW!", 'arcadexls'); ?></a>
                                <?php the_content(); ?>
                            </section>
                        </section>
                    </div>
                </article>
                <!--</article>-->
			</section>
            <!--</cont>-->

<?php get_sidebar(); ?>                