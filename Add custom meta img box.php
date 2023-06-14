<?php
//add custom img box in post ------------------------------------  backend-code 
add_action( 'add_meta_boxes', 'listing_image_add_metabox' );
function listing_image_add_metabox () {
    add_meta_box( 'listingimagediv', __( 'Video/GIF/WEBP', 'text-domain' ), 'listing_image_metabox', 'post', 'side', 'low');
}

function listing_image_metabox ( $post ) {
    global $content_width, $_wp_additional_image_sizes;
    $image_id = get_post_meta( $post->ID, '_listing_image_id', true );
    $old_content_width = $content_width;
    $content_width = 254;

    if($image_id && get_post($image_id)) {
        if(!isset($_wp_additional_image_sizes['post-thumbnail'])){
            $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
        } else {
            $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
        }
        if(!empty($thumbnail_html)){
            $content = $thumbnail_html;
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove listing image', 'text-domain' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
        } else {
            $contentx = get_the_guid($image_id);
            $content = '<video controls><source src="'.$contentx.'" type="video/mp4"></video>';
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove listing image', 'text-domain' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
        }
        $content_width = $old_content_width;
    } else {
        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
        $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set listing image', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set listing image', 'text-domain' ) . '">' . esc_html__( 'Set listing image', 'text-domain' ) . '</a></p>';
        $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="" />';
    }   echo $content;
}

add_action( 'save_post', 'listing_image_save', 10, 1 );
function listing_image_save ( $post_id ) {
    if( isset( $_POST['_listing_cover_image'] ) ) {
        $image_id = (int) $_POST['_listing_cover_image'];
        update_post_meta( $post_id, '_listing_image_id', $image_id );
    }
}

add_action( 'admin_enqueue_scripts', 'load_custom_script' ); 
function load_custom_script() {
    wp_enqueue_script('custom_js_script', get_bloginfo('template_url').'/js/c_scripts.js', array('jquery'));
}

/*
    //themes/yourtheme/js/c_scripts.js
    jQuery(document).ready(function($) {
        var file_frame;

        jQuery.fn.upload_listing_image = function( button ) {
            var button_id = button.attr('id');
            var field_id = button_id.replace( '_button', '' );
            if ( file_frame ) { file_frame.open(); return; }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
              title: jQuery( this ).data( 'uploader_title' ),
              button: { text: jQuery( this ).data( 'uploader_button_text' ), },
              multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
              var attachment = file_frame.state().get('selection').first().toJSON();
              jQuery("#"+field_id).val(attachment.id);
              jQuery("#listingimagediv img").attr('src',attachment.url);
              jQuery( '#listingimagediv img' ).show();
              jQuery( '#' + button_id ).attr( 'id', 'remove_listing_image_button' );
              jQuery( '#remove_listing_image_button' ).text( 'Remove listing image' );
            });
            file_frame.open();
        };

        jQuery('#listingimagediv').on( 'click', '#upload_listing_image_button', function( event ) {
            event.preventDefault();
            jQuery.fn.upload_listing_image( jQuery(this) );
        });

        jQuery('#listingimagediv').on( 'click', '#remove_listing_image_button', function( event ) {
            event.preventDefault();
            jQuery( '#upload_listing_image' ).val( '' );
            jQuery( '#listingimagediv img' ).attr( 'src', '' );
            jQuery( '#listingimagediv img' ).hide();
            jQuery( this ).attr( 'id', 'upload_listing_image_button' );
            jQuery( '#upload_listing_image_button' ).text( 'Set listing image' );
        });
    });

*/


//front side show gif in all post/page.. not in single post
function alter_att_attributesx($attr) {
    if(!is_admin()){  
        if(!is_single() && get_post_type() == "post") { 
            $avatar_id = get_post_meta(get_the_ID(), "_listing_image_id", true);
            if($avatar_id != 0){
                $attr['srcset'] = '';
                $attr['class'] = $attr['class'].' GIF_VID';
                $attr['src'] = get_the_guid($avatar_id);
                return $attr;   
            } else {
                $attr['data-src'] = $attr['src'];
                return $attr;   
            }
        }  else {
            $attr['data-src'] = $attr['src'];
            return $attr;
        }
    } else {
        $attr['data-src'] = $attr['src'];
        return $attr;
    }
}
//add_filter('wp_get_attachment_image_attributes', 'alter_att_attributesx');  //frontend-code

function gv_filter_admin_post_thumbnail_html($output, $post_id, $thumbnail_id = ""){ $new_thumbnailxx = "";
    if(!is_admin()){   
        if(!is_single() && get_post_type() == "post") { 
            $avatar_id = get_post_meta($post_id, "_listing_image_id", true);
            if($avatar_id != 0) {
                $file_name = get_the_guid($avatar_id);
                $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                if($extension == "mp4") {
                    $new_thumbnailxx = '<video autoplay muted playsinline loop class="GIF_MP4 '.$post_id.'_'.$avatar_id.'"><source src="'.$file_name.'" type="video/mp4">Your browser does not support the video tag.</video>';
                    $output = preg_replace('/<img[^>]+>/', $new_thumbnailxx, $output);
                    return $output;
                } 
            } else {
                return $output;
            }
        }  else {
            return $output;
        }
    } else {
        return $output;
    }
}
//add_filter('post_thumbnail_html', 'gv_filter_admin_post_thumbnail_html', 10, 3);  //frontend-code
?>
