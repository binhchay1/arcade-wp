<?php get_header(); ?>
            
			<?php echo arcadexls_breadcumb(); ?>
            
            <!--<cont>-->
            <section class="cont <?php echo arcadexls_sidebar(1); ?>">
                <!--<article>-->
            	<article>
                    <header class="title bg bgco1 rnd5">
                        <h1><?php the_title(); ?></h1>
                    </header>
                    <div class="blkcnt bgco2 game-info post-blog post-blog-single">
                        <section class="blcnbx">
                            <section>
                    			<p class="attachment"><a class="cboxElement" href="<?php $image_attributes=wp_get_attachment_image_src( $post->ID, 'full' ); echo $image_attributes[0]; ?>" title="<?php the_title_attribute(); ?>" rel="lightbox"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a></p>
                            </section>
                        </section>
                    </div>
                </article>
                <!--</article>-->            
			</section>
            <!--</cont>-->
            
<?php get_sidebar(); ?>

<?php get_footer(); ?>