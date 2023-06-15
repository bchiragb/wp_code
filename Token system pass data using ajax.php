<?php

//php
add_action( 'wp_enqueue_scripts', 'wpdocs_name_scripts' );
function wpdocs_name_scripts() {
     wp_enqueue_script( 'script-name', get_stylesheet_directory_uri() . 
         '/js/ajxfile.js', array(), '1.0.0', true );
     wp_localize_script('script-name', 'ajax_var', array(
         'url' => admin_url('admin-ajax.php'),
         'nonce' => wp_create_nonce('ajax-nonce')
     ));
 }
add_action('wp_ajax_nopriv_custom_script_name', 'custom_php_ajax_function');    
add_action('wp_ajax_custom_script_name', 'custom_php_ajax_function');


//js
$(document).on('submit','form#my-contact-form',function(){
  var c_nm = $("#full-name").val();
  var c_em = $("#email").val();
  var c_ms = $("#message").val();
  var formData = { c_nm: c_nm, c_em: c_em, c_ms: c_ms, nonce: ajax_var.nonce, action: 'my_ajax_request' }
  $.ajax({
    type: "POST",
    url: ajax_var.url,  //"http://site_nm/wp-admin/admin-ajax.php",
    data : formData,
    beforeSend: function(data){
      $("#validation-messages-container").html('');
    },
    success: function(data){
      $("#validation-messages-container").html(data);
    },
    complete: function() { }
  }).done(function (data) { });
  return false;
});

//php
function custom_php_ajax_function() {
     if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
         die ( 'Busted!');
     }
 }


?>
