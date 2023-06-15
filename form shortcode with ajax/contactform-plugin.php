<?php
/*
Plugin Name: My Contact Form
Plugin URI: https://github.com/bchiragb/
Description: My Contact Form - Shortcode: [my-contact-form]
Author: Chirag Baldaniya
Author URI: https://github.com/bchiragb
Version: 1.0.0
*/


global $wpdb;

add_shortcode( 'my-contact-form', 'my_contact_form' );
add_action( 'wp_enqueue_scripts', 'my_contact_form_scripts' );
add_action( 'wp_enqueue_scripts', 'my_contact_form_styles' );

function my_contact_form() { ?>
	<form id="my-contact-form" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
        <input type="hidden" name="contact_form">
        <div class="form-section">
            <label for="full-name"><?php echo esc_html( 'Full Name ::', 'twentytwentyone' ); ?></label>
            <input type="text" id="full-name" name="full_name">
        </div>
        <div class="form-section">
            <label for="email"><?php echo esc_html( 'Email ::', 'twentytwentyone' ); ?></label>
            <input type="text" id="email" name="email">
        </div>
        <div class="form-section">
            <label for="message"><?php echo esc_html( 'Message ::', 'twentytwentyone' ); ?></label>
            <textarea id="message" name="message"></textarea>
        </div>
        <input type="submit" id="my-contact-form-submit" value="<?php echo esc_attr( 'Submit', 'twentytwentyone' ); ?>">
        <div id="validation-messages-container"></div>
    </form>
	<?php
}

function my_contact_form_scripts() {
     wp_enqueue_script( 'my-contact-form2',
    'https://code.jquery.com/jquery-3.7.0.min.js',
    array(), '', true);

    wp_enqueue_script( 'my-contact-form',
    plugin_dir_url(__FILE__ ).'js/my-contact-form.js',
    array(), '1.00', true);

    ?><script type="text/javascript">
    var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
    var ajax_nonce = '<?php echo wp_create_nonce( "ajax-nonce" ); ?>';
    </script><?php
}

function my_contact_form_styles() {
    wp_enqueue_style( 'my-contact-form', 
	plugin_dir_url(__FILE__ ).'css/my-contact-form.css',
    array(), '1.00', 'all');
}


add_action( 'wp_ajax_my_ajax_request', 'my_ajax_request' ); //logged-in users
add_action('wp_ajax_nopriv_my_ajax_request', 'my_ajax_request'); //logged-out users
function my_ajax_request() {
   if (!wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
        die('Busted!');
    }
    $to = $_POST["c_em"];
    $subject = $_POST["c_nm"];
    $headers = "Testing";
    $message = $_POST["c_ms"];
    $attachments = "";
    $sent = wp_mail($to, $subject, $message, $headers, $attachments);
    if (! $sent) {
        echo "<span class='error'>Problem in sending mail.</span>";
    } else {
        echo "<span class='success'>Hi, thank you for the message.</span>";
    }
    wp_die();
}
