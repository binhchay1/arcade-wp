    <!--<modal-login>-->
    <section class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icona-clos"><?php _e('Close', 'arcadexls'); ?></span></button>
                    <h4 class="modal-title" id="loginLabel"><?php _e('Login', 'arcadexls'); ?></h4>
                </div>
                <div class="modal-body">
                	<?php
                    $args = array('redirect' => get_permalink(get_option('home').'/') );
					wp_login_form( $args );
					?>
                </div>
            </div>
        </div>
    </section>
    <!--</modal-login>-->
    
    <!--<modal-signup>-->
    <section class="modal fade" id="modal-signup" tabindex="-1" role="dialog" aria-labelledby="signupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icona-clos"><?php _e('Close', 'arcadexls'); ?></span></button>
                    <h4 class="modal-title" id="signupLabel"><?php _e('Signup', 'arcadexls'); ?></h4>
                </div>
                <div class="modal-body">
                	<form id="registerfrmmt" action="#" autocomplete="off">
                        <div class="frmspr">
                            <p class="frmspr"><label class="frmlblk" for="user_login2"><?php _e('User name:', 'arcadexls'); ?></label></p>
                            <input name="user" id="user_login" type="text">
                        </div>
                        <div class="frmspr">
                            <p class="frmspr"><label class="frmlblk" for="email"><?php _e('Your email address:', 'arcadexls'); ?></label></p>
                            <input name="email" id="email" type="text">
                        </div>
                        <div class="frmspr">
                            <p class="frmspr"><label class="frmlblk" for="user_pass2"><?php _e('Password:', 'arcadexls'); ?></label></p>
                            <input name="password" id="user_pass2" type="password">
                        </div>
                        <div class="frmspr">
                            <p class="frmspr"><label class="frmlblk" for="user_pass3"><?php _e('Retype password:', 'arcadexls'); ?></label></p>
                            <input name="rpassword" id="user_pass3" type="password">
                        </div>
                        <input type="hidden" name="action" value="arcadexls_account_action">
                        <button type="submit"><?php _e('Signup', 'arcadexls'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--</modal-login>-->