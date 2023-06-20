
//-------------------------------------------------------------------------------------  find wordpress version
1. inside wp-admin at dashboard and find At a Glance widget
2. inside wp-admin at footer
3. inside wp-admin then update page
4. View source of home page then find generator
5. View source of home page with css, js version
6. find in feed websitename.com/feed
7. Check wp-include/version.php

//-------------------------------------------------------------------------------------  remove wordpress version

remove_action('wp_head', 'wp_generator'); 
-------------

function wp_remove_version() {
	return '';
}
add_filter('the_generator', 'wp_remove_version');
-------------

// Pick out the version number from scripts and styles
function remove_version_from_style_js( $src ) {
	if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_version_from_style_js');
add_filter( 'script_loader_src', 'remove_version_from_style_js');
-------------

