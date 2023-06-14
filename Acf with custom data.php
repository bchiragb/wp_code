<?php

// you need to install acf then take select field and replace with name / key / type - backend
function my_acf_load_data( $field ) {
    global $wpdb; global $post;
    if(!empty($post)) { 
        $post_id = $post->ID;
    } else { $post_id = 1; }

    $args = array(
        'post_type'        => 'post',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
    );
    
    $category_posts = new WP_Query($args);
    foreach($category_posts->posts as $val){
        if($post_id != $val->ID) {
            $field['choices'][$val->ID] = $val->post_title;
        }
    }

    return $field;
}

//add_filter('acf/load_field', 'my_acf_load_data');
//add_filter('acf/load_field/type=select', 'my_acf_load_data');
//add_filter('acf/fields/post_object/query/key=group_648024231f6bd', 'my_acf_load_data');
//add_filter('acf/load_field/name=selectboxx', 'my_acf_load_data');


//create shortcode ([my-related-posts]) for related post - front side 
function related_post_shortcode() {
    global $post;
    $content = "";
    $content .= '<h1>Repated Post</h1>';
    $content .= '<div class="post_group">';
    $post_ids = get_field("related_post", $post->ID);
    foreach($post_ids as $pid) {
        $imagex = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'full' );
        $image = $imagex[0];
        if(is_null($imagex[0])){
            $image = plugins_url()."/related-post/no_img.png";
        }

        $title = get_the_title($pid);
        $plink = get_the_permalink($pid);
        $content.= '<div class="related_post_box">';
        $content.= '<a href="'.$plink.'" class="related_post_box_a"><h3 class="related_post_box_h3">'.$title.'</h3></a>';
        $content.= '<a href="'.$plink.'" class="related_post_box_b"><img class="related_post_box_img" src="'.$image.'"/></a>';
        $content.= '</div>';
    }
    $content .= '</div>';
    ?>
    <style type="text/css">
        img.related_post_box_img {
            width: 200px;
            height: 200px;
        }
        .related_post_box {
            border: 1px solid #ccc;
            margin: 25px;
            padding: 5px;
            display: block;
            float: left;
        }
    </style>
    <?php

    return $content;
}
add_shortcode('my-related-posts', 'related_post_shortcode');


?>
