<?php
function general_admin_notice(){
    global $pagenow; global $post;
	if($pagenow == 'options-general.php'){
		echo '<div class="notice notice-warning is-dismissible"><p>This is an example of a notice that appears on the settings page.</p></div>';
	} else if($pagenow == 'edit.php'){
		if(!empty($post) && $post->post_type == "listing"){
			echo '<div class="notice notice-warning is-dismissible"><p>aaaaaaaaaaaaaa.</p></div>';
			//wp_die( 'WordPress need to be at least 6.0 to activate this plugin' );
		}
    }
}
add_action('admin_notices', 'general_admin_notice');
?>
