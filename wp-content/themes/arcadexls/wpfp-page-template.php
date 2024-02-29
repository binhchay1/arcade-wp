<?php
	global $wpfp_options;
	$wpfp_before='';
    echo "<div class='wpfp-span'>";
    if (!empty($user)):
        if (!wpfp_is_user_favlist_public($user)):
			echo sprintf( __("%s's Favorite Posts.", 'arcadexls'), $user);
        else:
            echo "$user's list is not public.";
			echo sprintf( __("%s's list is not public.", 'arcadexls'), $user);
        endif;
    endif;

    if ($wpfp_before):
        echo "<p>".$wpfp_before."</p>";
    endif;

    echo '<ul class="lstfavgms">';
    if ($favorite_post_ids):
		$favorite_post_ids = array_reverse($favorite_post_ids);
        $post_per_page = wpfp_get_option("post_per_page");
        $page = intval(get_query_var('paged'));
        query_posts(array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page));
        while ( have_posts() ) : the_post();
			echo'<li><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
            wpfp_remove_favorite_link(get_the_ID());			
			echo'</li>';
        endwhile;
?>
	<?php mt_pagination(); ?>
    <?php
        wp_reset_query();
    else:
        echo "<li>";
        echo $wpfp_options['favorites_empty'];
        echo "</li>";
    endif;
    echo '</ul>';

    if (wpfp_is_user_can_edit()) {
        $wpfp_options = wpfp_get_options();
        echo wpfp_before_link_img();
        echo wpfp_loading_img();
        echo "<a class='wpfp-link remove-parent clrfav' href='?wpfpaction=clear' rel='nofollow'>". wpfp_get_option('clear') . "</a>";
    }
    echo "</div>";
    wpfp_cookie_warning();
?>