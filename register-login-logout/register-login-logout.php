<?php
/*
Plugin Name: login, register, logout
Plugin URI: https://github.com/bchiragb/
Description: A Plugin For WordPress login [custom_login], register [custom_registration], logout [custom_forgot] Using Ajax
Author: Chirag Baldaniya
Author URI: https://github.com/bchiragb
Version: 1.0.0
*/  

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  

//==================================================================================== css, js
add_action('wp_enqueue_scripts', 'my_form_scripts');
function my_form_scripts() {
    wp_enqueue_script( 'my-register-form2',
    'https://code.jquery.com/jquery-3.7.0.min.js',
    array(), '', true);

    wp_enqueue_script( 'my-register-form',
    plugin_dir_url(__FILE__ ).'assets/js/my-register-form.js',
    array(), '1.00', true);

    ?><script type="text/javascript">
    var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
    var ajax_noncer = '<?php echo wp_create_nonce( "ajax-register" ); ?>';
    var ajax_noncel = '<?php echo wp_create_nonce( "ajax-login" ); ?>';
    var ajax_noncef = '<?php echo wp_create_nonce( "ajax-forgot" ); ?>';
    </script><?php

    wp_enqueue_style( 'my-register-form', 
	plugin_dir_url(__FILE__ ).'assets/css/my-register-form.css',
    array(), '1.00', 'all');
}


//==================================================================================== register
add_shortcode('custom_registration', 'custom_registration_shortcode');
function custom_registration_shortcode() {
    ob_start();
    custom_registration();
    return ob_get_clean();
}

function custom_registration() {
    echo ' 
	<form method="post" enctype="multipart/form-data" id="register_forms">
		<div> 
			<label for="username">Username <strong>*</strong></label> 
			<input type="text" name="username" id="r_username"> 
		</div> 
		<div> 
			<label for="password">Password <strong>*</strong></label> 
			<input type="password" name="password" id="r_password"> 
		</div> 
		<div> 
			<label for="email">Email <strong>*</strong></label> 
			<input type="text" name="email" id="r_email"> 
		</div> 
		<div> 
			<label for="website">Website</label> 
			<input type="text" name="website" id="r_website"> 
		</div> 
		<div> 
			<label for="nickname">Nickname</label> 
			<input type="text" name="nickname" id="r_nickname"> 
		</div> 
		<div> 
			<label for="firstname">First Name</label> 
			<input type="text" name="fname" id="r_fname"> 
		</div> 
		<div> 
			<label for="website">Last Name</label> 
			<input type="text" name="lname" id="r_lname"> 
		</div> 
		<input type="submit" name="submit" id="rsubmit" value="Register"/> 
		<div id="error_reg"></div>
	</form> 
	';
}

add_action('wp_ajax_my_ajax_register', 'my_ajax_register'); //logged-in users
add_action('wp_ajax_nopriv_my_ajax_register', 'my_ajax_register'); //logged-out users
function my_ajax_register() {
	extract($_POST);
    if (!wp_verify_nonce( $_POST['nonce'], 'ajax-register' ) ) {
        die('Busted!');
    }

    global $reg_errors;
	$reg_errors = new WP_Error;

	if(empty($c_username) || empty($c_password) || empty($c_email)){
	    $reg_errors->add('field', 'Required form field is missing');
	}
	if(username_exists($c_username)){
    	$reg_errors->add('user_name', 'Sorry, that username already exists!');
    }
    if(!is_email($c_email)){
	    $reg_errors->add('email_invalid', 'Email is not valid');
	}
	if(email_exists($c_email)){
	    $reg_errors->add('email', 'Email Already in use');
	}
	if(!empty($c_website)){
	    if(!filter_var($c_website, FILTER_VALIDATE_URL)){
	        $reg_errors->add('website', 'Website is not a valid URL');
	    }
	}

	//error 
	if(is_wp_error($reg_errors)){
	    foreach($reg_errors->get_error_messages() as $error){
	        echo '<div>';
	        echo '<strong>ERROR</strong>:';
	        echo $error . '<br/>';
	        echo '</div>';
	    }
	}

	//register
	if(1 > count($reg_errors->get_error_messages())){
        $userdata = array(
	        'user_login'    => 	sanitize_user($c_username),
	        'user_pass' 	=> 	esc_attr($c_password),
	        'user_email' 	=> 	esc_attr($c_email),
	        'user_url' 		=> 	esc_attr($c_website),
	        'nickname' 		=> 	esc_attr($c_nickname),
	        //'first_name' 	=> 	$c_first_name,
	        //'last_name' 	=> 	$c_last_name,
	        //'description' 	=> 	$c_bio,
		);
        $user_id = wp_insert_user($userdata);
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>';   
        
        //you can add login code for login direct after register
        /* wp_clear_auth_cookie();
        do_action('wp_login', $user_id);
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id, true);
        $data = home_url(); 
        wp_redirect( site_url() );
		exit; */
    }
    wp_die();
}


//==================================================================================== login / chk
add_shortcode('custom_login', 'custom_login_shortcode');
function custom_login_shortcode() {
    ob_start();
    custom_login();
    return ob_get_clean();
}

function custom_login() {
	if(is_user_logged_in()) {
		$current_user = wp_get_current_user(); 
		echo "Username: ". $current_user->user_login.'<br>';

		echo '<a href="'.wp_logout_url( home_url() ).'" title="Logout">Logout</a>';
	} else {
	    echo ' 
		<form method="post" enctype="multipart/form-data" id="login_forms">
			<div> 
				<label for="username">Username <strong>*</strong></label> 
				<input type="text" name="username" id="l_username"> 
			</div> 
			<div> 
				<label for="password">Password <strong>*</strong></label> 
				<input type="password" name="password" id="l_password"> 
			</div>
			<div> 
				<label for="Remember">Remember</label> 
				<input type="checkbox" name="Remember" id="l_remember"> 
			</div> 
			<input type="submit" name="submit" id="lsubmit" value="Login"/> 
			<div id="error_logi"></div>
		</form> 
		';
	}

}

add_action('wp_ajax_my_ajax_login', 'my_ajax_login'); //logged-in users
add_action('wp_ajax_nopriv_my_ajax_login', 'my_ajax_login'); //logged-out users
function my_ajax_login(){ 
	extract($_POST);
	if(!wp_verify_nonce($_POST['nonce'], 'ajax-login')){ die('Busted!'); }
	
    $login_data = array();
    $login_data['user_login'] = sanitize_user($c_username);
    $login_data['user_password'] = esc_attr($c_password);
    $login_data['remember'] = esc_attr($c_remember);
    $userx = wp_signon( $login_data, false);

    $data = "";
    if(is_wp_error($userx)){
        $data = $userx->get_error_message();
    } else {    
        wp_clear_auth_cookie();
        do_action('wp_login', $userx->ID, $userx);
        wp_set_current_user($userx->ID);
        wp_set_auth_cookie($userx->ID, true);
        $data = home_url(); //$redirect_to = $_SERVER['REQUEST_URI'];
        //wp_safe_redirect($redirect_to);
        //wp_redirect($redirect_to);
        //exit();
    }
    echo $data;
	wp_die();
}

//==================================================================================== forgot

add_shortcode('custom_forgot', 'custom_forgot_shortcode');
function custom_forgot_shortcode() {
    ob_start();
    custom_forgot();
    return ob_get_clean();
}

function custom_forgot() {
    echo ' 
	<form method="post" enctype="multipart/form-data" id="forgot_forms">
		<div> 
			<label for="username">Username / Email <strong>*</strong></label> 
			<input type="text" name="username" id="f_username"> 
		</div> 
		<input type="submit" name="submit" id="fsubmit" value="Forgot"/> 
		<div id="error_logi"></div>
	</form> 
	';
}

add_action('wp_ajax_my_ajax_forgot', 'my_ajax_forgot'); //logged-in users
add_action('wp_ajax_nopriv_my_ajax_forgot', 'my_ajax_forgot'); //logged-out users
function my_ajax_forgot(){ 
	extract($_POST);
	if(!wp_verify_nonce($_POST['nonce'], 'ajax-forgot') && isset($action)){ die('Busted!'); }
	
	$error = ""; $u_type = "";
    $user_login = sanitize_user($c_username);
    if(str_contains($user_login, '@')){  //by email
	    if(!email_exists($user_login)){
	    	$error = 'Sorry, that email not found';
	    } else { $u_type = "email"; }
	} else { //by name
		if(!username_exists($user_login)){
	    	$error = 'Sorry, that username not found';
	    } else {
	    	$u_type = "name";
	    }
	}

	
	if($error == ""){
    	if($u_type == "name") { $fil = "login"; } else { $fil = "email"; }
    	$user = get_user_by($fil, $user_login);
    	$uid = $user->ID;
    	$email = $user->user_email;
		$random_password = wp_generate_password(12, false);
		$update_user = wp_update_user(array('ID' => $uid, 'user_pass' => $random_password));

		//mail send to user for new password
		$to = $email;
		$subject = 'Your new password';
		$sender = get_bloginfo( 'name' );
		$message = 'Your new password is: ' . $random_password;
		/* $headers[] = 'MIME-Version: 1.0' . "\r\n";
		$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers[] = "X-Mailer: PHP \r\n";
		$headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n"; */
		$headers = array( 'Content-Type: text/html; charset=UTF-8' );

		$mail = wp_mail( $to, $subject, $message, $headers );
		if($mail) {
			echo '<strong>Success! </strong>Check your email address for you new password.';
		} 
	} else {
		echo $error;	
	}
	wp_die();
}

/*
//==================================================================================== pass reset with key
$user_data = get_user_by( 'email', 'admin@mysite.com' ) );
$key = get_password_reset_key( $user_data );
$user_login = $user_data->user_login;
site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";


add_shortcode( 'custom-password-reset-form', array( $this, 'render_password_reset_form' ) );
public function render_password_reset_form( $attributes, $content = null ) {
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );
    if(is_user_logged_in()) {
        return __('You are already signed in.', 'personalize-login');
    } else {
        if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'])){
            $rp_key = $_REQUEST['rp_key'];
	        $rp_login = $_REQUEST['rp_login'];
	        $user = check_password_reset_key( $rp_key, $rp_login);
	        reset_password($user, $_POST['newpass']);
        } else {
            return __('Invalid password reset link.', 'personalize-login');
        }
    }
} */
