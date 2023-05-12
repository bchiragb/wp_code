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
