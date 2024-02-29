<?php
// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (__("Please do not load this page directly. Thanks!", 'arcadexls'));
    
  if (function_exists('post_password_required')) {
    if ( post_password_required() ) {
      echo '<p class="nocomments">'.__("This post is password protected. Enter the password to view comments.", 'arcadexls').'</p>';
      return;
    }
  } 
  else {
    if (!empty($post->post_password)) { // if there's a password
      if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
        ?>
          <p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", 'arcadexls'); ?></p>
        <?php

        return;
      }
    }
  }
?>
                <div id="cmtcnt">
				<?php if ( have_comments() ) : ?>
                <!--<Comments>-->
                <section class="blkcnt bgco2">
                	<div class="bltitl">
                    	<h3><?php printf( __('Comments %s#%s%s', 'arcadexls'), '<span>', get_comments_number(), '</span>'); ?></h3>
						<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                            <?php echo mt_paginacion(2,' navcom'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="blcnbx">
                        <ul class="lstcmnts" id="comments">
        					<?php wp_list_comments( array( 'callback' => 'arcadexls_comment' ) ); ?>
                        </ul>
                    </div>        
                </section>
                <!--</Comments>-->
				<?php endif; // end have_comments() ?>                

				<?php if ( comments_open() ) : ?>
                <!--<Leave_a_Reply>-->
                <section id="respond" class="blkcnt bgco2">
                    <div class="cancel-comment-reply">
                        <small><?php cancel_comment_reply_link(); ?></small>
                    </div>
                    <div class="bltitl"><?php _e('Leave a Reply'); ?></div>
                    <div class="blcnbx">
                        <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" name="commentform" class="comment-form">
					<?php if ( is_user_logged_in() ) : ?>
                    <p><?php printf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )); ?></p>
					<?php else : ?> 
                            <p class="comment-notes"><?php _e('Your email address will not be published.', 'arcadexls'); ?></p>
                            <ul class="frmcols3_spr10">
                                <li><div class="frmspr"><input id="author" name="author" type="text" value="<?php echo esc_attr($commenter['comment_author'] ); ?>" placeholder="<?php _e('Name', 'arcadexls'); ?>" size="30"></div></li>
                                <li><div class="frmspr"><input id="email" name="email" type="text" value="<?php echo esc_attr(  $commenter['comment_author_email'] ); ?>" placeholder="<?php _e('Email', 'arcadexls'); ?>" size="30"></div></li>
                                <li><div class="frmspr"><input id="url" name="url" type="text" value="<?php echo esc_attr( $commenter['comment_author_url'] ); ?>" placeholder="<?php _e('Website', 'arcadexls'); ?>" size="30"></div></li>
                            </ul>
                    <?php endif; ?>
                            <div class="frmspr mbot20"><textarea id="comment" name="comment" cols="66" rows="6" placeholder="<?php _e('Your comment here...', 'arcadexls'); ?>" aria-required="true"></textarea></div>
                            <p class="form-submit">
                                <input name="submit" type="submit" id="submit" value="<?php _e('Post Comment', 'arcadexls'); ?>">
                            </p>
                    		<?php comment_id_fields(); ?> 
                    		<?php do_action('comment_form', $post->ID); ?>
                        </form>
                    </div>        
                </section>
                <!--</Leave_a_Reply>-->
                <?php endif; ?>
				</div>