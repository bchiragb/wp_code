<?php
global $wpdb;
$wpdb->prefix;

//=========================================================================================
$sql = "SELECT * FROM wp_users WHERE `id` = '".$aid."'";
$wpdb->get_row($sql);
//$wpdb->get_row($query, ARRAY_A);
if($wpdb->num_rows < 1) {

}

//=========================================================================================
$data = $wpdb->get_row( "SELECT * FROM wp_users WHERE id = '1'" );
$namex = $data->user_login;  


//=========================================================================================
$query = "SELECT * FROM wp_users";
$userdata = $wpdb->get_results($query); // OBJECT is default 
echo $userdata[0]->user_login;

//$userdata = $wpdb->get_results( $query, ARRAY_A );
//echo $userdata[0]['restaurant_base_name'];

//$userdata = $wpdb->get_results( $query, ARRAY_N );
//echo $userdata[0][2]; 

if($userdata) {
	foreach($userdata as $key => $value) {
		echo $key.'=='.$value.'<br>';
		//echo $value->user_login;
	}
}

//=========================================================================================
$wpdb->insert("wp_usersx", array(
	"title" => $_POST['tit_'],
	"description" => $_POST['desc_'],
	"created_at" => time(),
	"updated_at" => time()
));

//=========================================================================================
$wpdb->update( "wp_usersx", array(
	"title" => $_POST['tit_'],
	"description" => $_POST['desc_'],
	"updated_at" => time()
), array('id' => $_POST['aid_']) );

//=========================================================================================
$result = $wpdb->get_results("SELECT * FROM wp_users");
if($wpdb->last_error) {
  	echo 'wpdb error: ' . $wpdb->last_error;
}

//=========================================================================================
echo $wpdb->print_error();
echo $wpdb->show_errors();
echo $wpdb->last_query;



%s – string (value is escaped and wrapped in quotes)
%d – integer
%f – float
%% – % sign

$wpdb->prepare(
    "SELECT * FROM `table` WHERE `column` = %s AND `field` = %d OR `other_field` LIKE %s",
    array( 'foo', 1337, '%bar' )
);

$wpdb->prepare(
    "SELECT DATE_FORMAT(`field`, '%%c') FROM `table` WHERE `column` = %s",
    'foo'
);

$wpdb->prepare(
	"SELECT * FROM {$wpdb->posts} WHERE `post_date` > %1$s AND `post_title` LIKE %2$s OR `post_content` LIKE %3$s",
	$post_date,
	$search_string,
	$search_string
);


//=========================================================================================
if(have_posts()) :
	while(have_posts()) :
		the_post(); ?>
		<h1><?php the_title() ?></h1>
		<div class='post-content'><?php the_content() ?></div> <?php
	endwhile;
else : 
	?>Oops, there are no posts.<?php
endif;


//=========================================================================================
$args = array(
	'post_type' => 'press-release'
	'posts_per_page' => 25,
	'category_name' => 'health',
);
$category_posts = new WP_Query($args);
if($category_posts->have_posts()) :
	while($category_posts->have_posts()) :
		$category_posts->the_post(); ?>
		<h1><?php the_title() ?></h1>
		<div class='post-content'><?php the_content() ?></div> <?php
	endwhile;
else : 
	?>Oops, there are no posts.<?php
endif;
?>