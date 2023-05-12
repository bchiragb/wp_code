<?php
//custom code ------------------------------- backend
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


//custom code ------------------------------- frontend

$loop = new WP_Query(array('post_type' => 'Listing', 'posts_per_page' => 2, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 )
); 

    while ( $loop->have_posts() ) : $loop->the_post(); //loop for show data
        the_title(); 
    endwhile; 


    $big = 999999999; // need an unlikely integer -- pagination
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $loop->max_num_pages,
        'prev_text'    => __('←'),
        'next_text'    => __('→'),
    ) );
?>
