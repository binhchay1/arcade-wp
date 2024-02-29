<?php get_header(); ?>            
			<?php echo arcadexls_breadcumb(); ?>
            
            <!--<cont>-->
            <section class="cont flol">
            	<?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <!--<article>-->
                <article class="blkcnt bgco2 game-info post-blog">
                    <header class="bltitl"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></header>
                    <section class="blcnbx">
                        <section>
                            <?php the_content(); ?>
                        </section>
                    </section>
                </article>
                <!--</article>-->
				<?php
                endwhile;
                ?>
				<?php mt_pagination(); ?>
				<?php 
                else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );				
				endif;
                ?>            
			</section>
            <!--</cont>-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>