<?php //add in function.php

//http://localhost/test101/wp-json/test101/v1/latest-posts/1
add_action('rest_api_init', function () {
	register_rest_route( 'test101/v1', 'latest-posts/(?P<category_id>\d+)',array(
		'methods'  => 'GET',
		'callback' => 'get_latest_posts_by_category'
	));
});

function get_latest_posts_by_category($request) {
    $args = array('category' => $request['category_id']);
    $posts = get_posts($args);
    if(empty($posts)) { return new WP_Error( 'empty_category', 'There are no posts to display', array('status' => 404) ); }
    //echo "<pre>"; print_r($posts);
    $response = new WP_REST_Response($posts);
    $response->set_status(200);
    return $response;
}


//http://localhost/test101/wp-json/foo
add_action( 'rest_api_init', function ( $server ) {
	$server->register_route( 'foo', '/foo', array(
		'methods'  => 'GET',
		'callback' => function () {
			return 'Welcome to API';
		},
	));
});


?>