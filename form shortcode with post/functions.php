<?php

//========================================== contact us
add_shortcode( 'contact-form', 'display_contact_form' );

function display_contact_form() {

	$validation_messages = [];
	$success_message = '';

	if ( isset( $_POST['contact_form'] ) ) {

		//Sanitize the data
		$full_name = isset( $_POST['full_name'] ) ? sanitize_text_field( $_POST['full_name'] ) : '';
		$email     = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$message   = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

		//Validate the data
		if ( strlen( $full_name ) === 0 ) {
			$validation_messages[] = esc_html__( 'Please enter a valid name.', 'twentytwentyone' );
		}

		if ( strlen( $email ) === 0 or
		     ! is_email( $email ) ) {
			$validation_messages[] = esc_html__( 'Please enter a valid email address.', 'twentytwentyone' );
		}

		if ( strlen( $message ) === 0 ) {
			$validation_messages[] = esc_html__( 'Please enter a valid message.', 'twentytwentyone' );
		}

		//Send an email to the WordPress administrator if there are no validation errors
		if ( empty( $validation_messages ) ) {

			$mail    = get_option( 'admin_email' );
			$subject = 'New message from ' . $full_name;
			$message = $message . ' - The email address of the customer is: ' . $mail;

			//wp_mail( $mail, $subject, $message );

			$success_message = esc_html__( 'Your message has been successfully sent.', 'twentytwentyone' );

		}

	}

	//Display the validation errors
	if ( ! empty( $validation_messages ) ) {
		foreach ( $validation_messages as $validation_message ) {
			echo '<div class="validation-message">' . esc_html( $validation_message ) . '</div>';
		}
	}

	//Display the success message
	if ( strlen( $success_message ) > 0 ) {
		echo '<div class="success-message">' . esc_html( $success_message ) . '</div>';
	}

	?>
    <div id="validation-messages-container"></div>
    <form id="contact-form" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
        <input type="hidden" name="contact_form">
        <div class="form-section">
            <label for="full-name"><?php echo esc_html( 'Full Name', 'twentytwentyone' ); ?></label>
            <input type="text" id="full-name" name="full_name">
        </div>
        <div class="form-section">
            <label for="email"><?php echo esc_html( 'Email', 'twentytwentyone' ); ?></label>
            <input type="text" id="email" name="email">
        </div>
        <div class="form-section">
            <label for="message"><?php echo esc_html( 'Message', 'twentytwentyone' ); ?></label>
            <textarea id="message" name="message"></textarea>
        </div>
        <input type="submit" id="contact-form-submit" value="<?php echo esc_attr( 'Submit', 'twentytwentyone' ); ?>">
    </form>
	<?php

}

function contact_form_scripts() {
    wp_enqueue_script( 'contact-form',
    get_template_directory_uri() . '/js/contact-form.js',
    array(), '1.00', true);
}
add_action( 'wp_enqueue_scripts', 'contact_form_scripts' );


function contact_form_styles() {
    wp_enqueue_style( 'contact-form', 
	get_template_directory_uri() . '/css/contact-form.css',
    array(), '1.00', 'all');
}

add_action( 'wp_enqueue_scripts', 'contact_form_styles' );


