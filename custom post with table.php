<?php


//custom post type
function custom_post_type() {
    $labels = array(
        'name'                => _x( 'Listing', 'Post Type General Name', 'test101' ),
        'singular_name'       => _x( 'List', 'Post Type Singular Name', 'test101' ),
        'menu_name'           => __( 'Listing', 'test101' ),
        'parent_item_colon'   => __( 'Parent List', 'test101' ),
        'all_items'           => __( 'All Listing', 'test101' ),
        'view_item'           => __( 'View List', 'test101' ),
        'add_new_item'        => __( 'Add New List', 'test101' ),
        'add_new'             => __( 'Add New', 'test101' ),
        'edit_item'           => __( 'Edit List', 'test101' ),
        'update_item'         => __( 'Update List', 'test101' ),
        'search_items'        => __( 'Search List', 'test101' ),
        'not_found'           => __( 'Not Found', 'test101' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'test101' ),
    );

    $args = array(
        'label'               => __( 'Listing', 'test101' ),
        'description'         => __( 'List news and reviews', 'test101' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );  
    register_post_type( 'Listing', $args );
}
add_action( 'init', 'custom_post_type', 0 );


//manage column in grid view
add_filter( 'manage_listing_posts_columns', 'cus_posts_columns' );
function cus_posts_columns( $columns ) {
  /*$columns['image'] = __( 'Image' );
  $columns['price'] = __( 'Price', 'smashing' );
  $columns['area'] = __( 'Area', 'smashing' );
  return $columns;*/

  $columns = array(
      'cb' => $columns['cb'],
      'image' => __( 'Image' ),
      'title' => __( 'Title' ),
      'price' => __( 'Price', 'smashing' ),
      'ac_de_btn' => __( 'Status'),
    );
  
  return $columns;
}


//shorting column
function sta_sortable_columns( $columns ) {
  $columns['price'] = 'price_per_month';
  return $columns;
}
add_filter( 'manage_edit-listing_sortable_columns', 'sta_sortable_columns');

//add custom data in table grid
add_action( 'manage_listing_posts_custom_column', 'post_state_column', 10, 2);
function post_state_column( $column, $post_id ) {
	if('image' === $column) {
		echo get_the_post_thumbnail( $post_id, array(80, 80) );
	}

	if('price' === $column){
		$price = get_post_meta($post_id, 'price_per_month', true );
		if(!$price){
			_e('n/a');  
		} else {
			echo '$ ' . number_format( $price, 0, '.', ',' ) . ' p/m';
		}
	}

	if('ac_de_btn' === $column ) {
		echo $post_id;
	}
}

?>