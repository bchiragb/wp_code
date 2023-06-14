<?php
echo "<pre>";

$the_plugs = get_option('active_plugins'); 
echo '<ul>';
foreach($the_plugs as $key => $value) {
    $string = explode('/',$value);
    echo '<li>'.$string[0] .'</li>';
}
echo '</ul>';
echo "<br>==============================<br>";


if(!function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$all_plugins = get_plugins();
print_r($all_plugins);
echo "<br>==============================<br>";


if(is_plugin_active('classic-editor/classic-editor.php')){
   echo "active";
} else {
    echo "not active";
}
echo "<br>==============================<br>";


$the_plugs = get_site_option('active_sitewide_plugins'); 
print_r($the_plugs);
echo "<br>==============================<br>";


function check_plugin_state(){
    if (is_plugin_active('classic-editor/classic-editor.php')){
     echo 'plugin is active';
   } else {
    echo 'plugin is not active';
   }
}
add_action('admin_init', 'check_plugin_state');
echo "<br>==============================<br>";


function my_plugin_admin_notices() {
    if(!is_plugin_active('advanced-custom-fields/acf.php')){
        deactivate_plugins('related-post/related-post.php');
        unset($_GET['activate']);
        echo '<div class="error"><p>advanced-custom-fields not active</p></div>';
    } 
}
function activate_plugin_function(){
	add_action( 'admin_notices', 'my_plugin_admin_notices' );
}
register_activation_hook( __FILE__, 'activate_plugin_function' );
echo "<br>==============================<br>";


function acti_plugin_function(){ //working with function and without also
	$wp_version = get_bloginfo('version');
	if ( $wp_version < 6.0 ) {
	    add_action( 'admin_init', 'deactivate_plugin_now' );
	    add_action( 'admin_notices', 'errormsg' ) );
	}

	public function deactivate_plugin_now() {
	    if(!is_plugin_active('advanced-custom-fields/acf.php')){
	        deactivate_plugins('related-post/related-post.php');
	        unset($_GET['activate']);
	    }
	}

	public function errormsg () {
		//wp_die( 'WordPress need to be at least 6.0 to activate this plugin' );
		//echo '<div class="notice notice-error is-dismissible"><p>WP minimum version issue.</p></div>';
	    $class = 'notice notice-error';
	    $message = __( 'Error you did not meet the WP minimum version', 'text-domain' );
	    printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	}
}
register_activation_hook( __FILE__, 'acti_plugin_function' );

echo "<br>==============================<br>";
