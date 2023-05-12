<?php
//custom code ------------------------------- backend            custom-Field.php
function hcf_register_meta_boxes() {
    add_meta_box( 'hcf-1', __( 'My Custom Field', 'hcf' ), 'hcf_display_callback', 'Listing' );
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );

/**
 * Meta box display callback.
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './form.php';
}

/**
 * Save meta box content.
 * @param int $post_id Post ID
 */
function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) { $post_id = $parent_id; }
    $fields = ['hcf_order', 'hcf_city', 'hcf_star', 'hcf_option'];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'hcf_save_meta_box' );


//custom code ------------------------------- backend            form.php
?>
<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="hcf_order">Order No</label>
        <input id="hcf_order" type="text" name="hcf_order" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_order', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_city">City</label>
        <input id="hcf_city" type="text" name="hcf_city" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_city', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_star">Review Star</label>
        <input id="hcf_star" type="text" name="hcf_star" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_star', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <?php $sl_meta_box_sidebar = esc_attr( get_post_meta( get_the_ID(), 'hcf_option', true ) );; ?>
        <label for="hcf_option">Covid Safe</label>
        <input type="checkbox" name="hcf_option" <?php if( $sl_meta_box_sidebar == true ) { ?>checked="checked"<?php } ?> />
    </p>    
</div>

<?php

//custom code ------------------------------- frontend

while ( $loop->have_posts() ) : $loop->the_post();

    //get feature img.. if not then show dami
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
    if($feat_image) {?>
        <img src="<?php echo $feat_image; ?>"/>
    <?php } else {?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/default.jpg"/>
    <?php } 

    //chk box
    if(esc_attr( get_post_meta( get_the_ID(), 'hcf_option', true ) ) == "on"){ ?>
        <div class="covid-19-safe mulish-bold-flamingo-12px">Covid-19 Safe</div>
    <?php } else { ?>
        <div class="covid-19-safe mulish-bold-flamingo-12px">xxxx</div>
    <?php }

    //get value if not then show 0.00
    $val_1 = esc_attr( get_post_meta( get_the_ID(), 'hcf_star', true ) );
    if($val_1 == "") { echo "0.00"; } else { echo $val_1; }

endwhile; 

?>