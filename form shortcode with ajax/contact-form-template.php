<?php

/* Template Name: Contact Template */

get_header();


while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header alignwide">
    	   <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    	</header>
        <div class="entry-content">
        <?php the_content('<p>', '</p>'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/my-contact-form.css">
            <form id="my-contact-form" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
                <input type="hidden" name="contact_form">
                <div class="form-section">
                    <label for="full-name"><?php echo esc_html( 'Full Name :::', 'twentytwentyone' ); ?></label>
                    <input type="text" id="full-name" name="full_name">
                </div>
                <div class="form-section">
                    <label for="email"><?php echo esc_html( 'Email :::', 'twentytwentyone' ); ?></label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="form-section">
                    <label for="message"><?php echo esc_html( 'Message :::', 'twentytwentyone' ); ?></label>
                    <textarea id="message" name="message"></textarea>
                </div>
                <input type="submit" id="my-contact-form-submit" value="<?php echo esc_attr( 'Submit', 'twentytwentyone' ); ?>">
                <div id="validation-messages-container"></div>
            </form>
        </div>
        <script type="text/javascript"> var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>'; </script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/my-contact-form.js"></script>
    </article>
    <!-- #post-<?php the_ID(); ?> 
        you need to add ajax response function
        add_action( 'wp_ajax_my_ajax_request', 'my_ajax_request' );
        add_action('wp_ajax_nopriv_my_ajax_request', 'my_ajax_request');
    -->
    <?php
endwhile;

get_footer(); ?>