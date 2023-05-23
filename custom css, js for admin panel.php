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

?>