//-------------------------------------------------------------------------------------  file details

For main page 
-------------------------------
front-page.php - site front page, override home.php
home.php - site front page, override index.php
index.php - site front page
search.php - Search results
404.php - no found page

For page 
-------------------------------
page.php
page-{slug}.php // page-{id}.php 

For post
-------------------------------
single-{post-type}.php
archive-{post-type}.php
single.php

For category
-------------------------------
category.php
category-{slug}.php // category-{id}.php

For tag
-------------------------------
tag.php
tag-{slug}.php // tag-{id}.php
archive.php

For archive post
-------------------------------
archive-{post_type}.php
archive.php

For author
-------------------------------
author.php
author-{nicename}.php // author-{id}.php

For custom taxonomy
-------------------------------
taxonomy.php
taxonomy-{taxonomy}.php


//-------------------------------------------------------------------------------------  define value
define( 'ABSPATH', dirname(__FILE__) . '/');
define( 'UPLOADS', 'wp-content/newname' );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/newfolder/wp-content' );
define( 'WP_CONTENT_URL', 'https://your-site.com/newfolder/wp-content' );
define( 'WP_PLUGIN_DIR', dirname(__FILE__) . '/newfolder/wp-content/plugins' );
define( 'WP_PLUGIN_URL', 'https://your-site.com/newfolder/wp-content/plugins' );

//-------------------------------------------------------------------------------------  site path
get_theme_root();
get_home_path();
get_home_url();  / get_site_url();
get_template_directory();
plugin_dir_path( __FILE__ ); 
plugin_dir_path( __DIR__ ); 


//-------------------------------------------------------------------------------------  wp function

register_rest_route();  -- for api
add_shortcode(); -- create shortcode
wp_hanle_upload(); -- file upload
add_meta_box(); -- create custom meta box
admin_enqueue_script(); -- add css, js for admin panel
wp_enqueue_script(); -- add js for frontview
wp_enqueue_style(); -- add css for frontview
wp_head(); -- add css, js, style data in header section
wp_footer(); -- add css, js, style data in footer section
wp_register_style(); -- register style then use with name
wp_register_script(); -- register script then use with name
add_menu_page(); -- add main menu for customization / plugin
add_submenu_page();  -- add submain menu of main menu for customization / plugin
wp_ajax_myajaxcall -- for get ajax request for login user
wp_ajax_nopriv_myajaxcall -- for get ajax request for not login user
is_plugin_active(); -- check plugin active or not
deactive_plugin(); -- for deactive plugin
register_active_hook(); -- for plugin when plugin activate
register_deactive_hook(); -- for plugin when plugin deactivate
wp_insert_user(); -- insert new user
is_user_logged_in(); -- check user is login or not
wp_logout_url(); -- link for logout
wp_login_url(); -- link for logout
wp_signon(); -- login user
wp_generate_password(); -- for create new password
email_exists(); -- email exist in db
username_exists(); -- username exist in db
is_wp_error(); -- check / get / save error
get_option(); -- get setting menu details
get_template_part(); -- get call template file with name also
get_theme_mod(); -- get theme related setting
esc_html__(); -- for html, decode html tag, run with echo 
esc_html_e(); -- same as esc_html but dont need to write echo
esc_attr__(); -- for attribute,  decode html tag, run with echo
esc_attr_e(); -- same as esc_attr but dont need to write echo
current_user_can(); -- user have access for specific operation
wp_kses(); -- filter/sanatize html data
sprintf(); -- implementation and combine
__(); -- returns a translatable string
_e(); -- returns a translatable string without echo 
_x(); -- returns a translatable string with a given context
