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
