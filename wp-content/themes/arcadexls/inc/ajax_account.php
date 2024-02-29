<?php
	function arcadexls_accountajax_init() {
		if(!is_user_logged_in() and !is_admin()){
			$path_to_theme = get_template_directory_uri();
	
			$myvars = array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'login' => get_bloginfo('url').'/wp-login.php',
				'text' => __('Signup', 'arcadexls'),
				'textb' => __('Loading...', 'arcadexls')
			);
			wp_enqueue_script('arcadexls-account', $path_to_theme.'/js/account.js',array('jquery'));
			wp_localize_script('arcadexls-account', 'ArcadexlsAccountAjax', $myvars );	
		}
	}
	
	add_action('wp_print_scripts', 'arcadexls_accountajax_init');
	
	function arcadexls_account_ajax(){
	
		if( $_POST['action'] == 'arcadexls_account_action' ) {
			$username = sanitize_user( $_POST['user'] );
			$email = sanitize_email($_POST['email']);
			$error='';
			$_POST['passwordb']='';
			$invalid_usernames = array( 'admin' );
			if(empty($username)){
				$error.=__('<p><strong>Error:</strong> You must enter a username.</p>', 'arcadexls');
			}
			if ( !validate_username( $username ) || in_array( $username, $invalid_usernames ) ) {
				$error.=__('<strong>Error:</strong> The user is invalid</p>.', 'arcadexls');
			}
			if ( username_exists( $username ) ) {
				$error.=__('<p><strong>Error:</strong> User already exists, please choose another.</p>', 'arcadexls');
			}
			if (strlen($username) < 5){
				$error.=__('<p><strong>Error:</strong> The user must contain at least 5 characters.</p>', 'arcadexls');
			}
			if(empty($_POST['email'])){
				$error.=__('<p><strong>Error:</strong> You must enter a email.</p>', 'arcadexls');
			}
			if ( !is_email( $_POST['email'] ) ) {
				$error.=__('<p><strong>Error:</strong> Email is invalid.</p>', 'arcadexls');
			}
			if (email_exists($_POST['email'])) {
				$error.=__('<p><strong>Error:</strong> The email already exists, please choose another.</p>', 'arcadexls');
			}
			if(empty($_POST['password'])){
				$error.=__('<p><strong>Error:</strong> You must enter a password.</p>', 'arcadexls');
			}
			if($_POST['password']==$_POST['passwordb']){
				$error.=__('<p><strong>Error:</strong> Passwords do not match.</p>', 'arcadexls');
			}
			if (strlen($_POST['password']) < 6){
				$error.=__('<p><strong>Error:</strong> The password must be at least 6 characters.</p>', 'arcadexls');
			}
			
			if(empty($error)){
				$usr_id=wp_insert_user( array ('user_email' => esc_sql( like_escape($email)), 'user_pass' => esc_sql( like_escape($_POST['password'])),'user_login' => esc_sql( like_escape($username)),'display_name' => esc_sql( like_escape($username)) ) ) ;
				echo '<div class="ok"><p>
				'.sprintf( __('Registered successfully completed, you can log %sclick here%sclick here%s.', 'arcadexls'), '<a data-dismiss="modal" id="lgtclosemt" href="#" data-toggle="modal" data-tooltip="tooltip" data-placement="top" data-target="#modal-login" title="" data-original-title="', '">', '</a>').'
				</p></div>';
			    wp_new_user_notification($usr_id);
			}else{
				echo '<div class="error">'.$error.'</div>';	
			}
		 	die(1);
		 }
	}
	add_action( 'wp_ajax_arcadexls_account_action', 'arcadexls_account_ajax' );
	add_action( 'wp_ajax_nopriv_arcadexls_account_action', 'arcadexls_account_ajax' );	
?>