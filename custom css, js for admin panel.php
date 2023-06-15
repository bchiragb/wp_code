<?php
// =========================================================================================== css
function my_custom_fonts() {
  echo '<style>
    #menu-settings {
      display: none !important;
    } 
  </style>';
}

add_action('admin_head', 'my_custom_fonts');



// =========================================================================================== js

function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/js/wp-admin.js';
    echo '<script type="text/javascript" src="'. $url . '"></script>';
}

add_action('admin_footer', 'custom_admin_js');


// =========================================================================================== css, js
function admin_enqueue_scripts() {
	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'style-css', plugin_dir_url( __FILE__ ) . 'css/custom.css' );
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts');

?>
