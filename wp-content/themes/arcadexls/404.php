<?php get_header(); ?>
            
			<?php echo arcadexls_breadcumb(); ?>
            
            <!--<cont>-->
            <section class="cont <?php echo arcadexls_sidebar(1); ?>">
            	
                <header class="title bg bgco1 rnd5 pnf404">
                    <h1><?php _e('404', 'arcadexls'); ?></h1>
                    <p><?php _e("Sorry, the page you asked for couldn't be found. Please, try to use the search form below.", 'arcadexls'); ?></p>
                    <div class="srchbx pore rgba1 rnd5">
                        <form action="#">
                            <input type="text" placeholder="<?php _e('Search game...', 'arcadexls'); ?>">
                            <button type="submit"><span class="iconb-srch"><?php _e('Search', 'arcadexls'); ?></span></button>
                        </form>
                	</div>
                </header>
            
			</section>
            <!--</cont>-->
            
<?php get_sidebar(); ?>

<?php get_footer(); ?>