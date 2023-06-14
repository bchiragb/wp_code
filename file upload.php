<?php
//signle file upload
if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

$uploadedfile = $_FILES['file'];
$upload_overrides = array( 'test_form' => false );
$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

if ( $movefile && ! isset( $movefile['error'] ) ) {
    echo "File is valid, and was successfully uploaded.\n";
    var_dump( $movefile );
} else {
    /**
     * Error generated by _wp_handle_upload()
     * @see _wp_handle_upload() in wp-admin/includes/file.php
     */
    echo $movefile['error'];
}



//signle file upload
add_action( 'save_post', 'my_files_save' );
function my_files_save( $post_id ) {
    if( ! isset( $_FILES ) || empty( $_FILES ) || ! isset( $_FILES['my_files'] ) )
        return;

    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }

    $upload_overrides = array( 'test_form' => false );
    $files = $_FILES['my_files'];
    foreach ($files['name'] as $key => $value) {
      if ($files['name'][$key]) {
        $uploadedfile = array(
            'name'     => $files['name'][$key],
            'type'     => $files['type'][$key],
            'tmp_name' => $files['tmp_name'][$key],
            'error'    => $files['error'][$key],
            'size'     => $files['size'][$key]
        );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        if ( $movefile && !isset( $movefile['error'] ) ) {
            $ufiles = get_post_meta( $post_id, 'my_files', true );
            if( empty( $ufiles ) ) $ufiles = array();
            $ufiles[] = $movefile;
            //update_post_meta( $post_id, 'my_files', $ufiles );
        }
      }
    }
}


//for multiple files
if ( ! function_exists( 'wp_handle_upload' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
$upload_overrides = array( 'test_form' => false );
$files = $_FILES['file'];
foreach ( $files['name'] as $key => $value ) {
	if ( $files['name'][ $key ] ) {
		$file = array(
			'name' => $files['name'][ $key ],
			'type' => $files['type'][ $key ],
			'tmp_name' => $files['tmp_name'][ $key ],
			'error' => $files['error'][ $key ],
			'size' => $files['size'][ $key ]
		);

		$movefile = wp_handle_upload( $file, $upload_overrides );
	}
}

?>
