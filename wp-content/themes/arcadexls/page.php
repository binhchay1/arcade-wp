<?php get_header(); ?>
            
			<?php echo arcadexls_breadcumb(); ?>
            
            <!--<cont>-->
            <section class="cont <?php echo arcadexls_sidebar(1); ?>">
				<?php
                // Do some action before the page output
                do_action('arcadexls_before_page');
                ?>
                <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?> 
                
                <?php
				if(function_exists('is_bbpress') and is_bbpress()){
					get_template_part( 'page', 'bbpress' );
				}else{
					get_template_part( 'page', 'content' );	
				}
				?>
				<?php
                endwhile;
                // Do some action after the page output
                do_action('arcadexls_after_page');
                ?>
                <?php 
                else : 
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );
                endif; 
                ?>
                <?php comments_template(); ?>
            
			</section>
            <!--</cont>-->
            
<?php get_sidebar(); ?>

<?php get_footer(); ?>