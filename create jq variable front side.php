<?php

function javascript_variables(){ ?>
    <script type="text/javascript">
        var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
        var ajax_nonce = '<?php echo wp_create_nonce( "secure_nonce_name" ); ?>';
    </script><?php
}
add_action ( 'wp_head', 'javascript_variables' );

function enqueue_scripts() {
	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'style-css', plugin_dir_url( __FILE__ ) . 'css/custom.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts');
?>
