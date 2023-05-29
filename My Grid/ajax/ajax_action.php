<?php
add_action('wp_ajax_wqnew_entry', 'wqnew_entry_callback_function1');
add_action('wp_ajax_nopriv_wqnew_entry', 'wqnew_entry_callback_function1');

function wqnew_entry_callback_function1() {
  global $wpdb;

  $rttt = $wpdb->get_row( "SELECT * FROM `wp_crud` WHERE `title` = '".$_POST['wqtitle']."' AND `description` = '".$_POST['wqdescription']."' ORDER BY `id` DESC" );
  if($wpdb->num_rows < 1) { 
    if(isset($_POST['chk_sts']) && $chk_sts == "on") { $chkxx = '1'; } else { $chkxx = '0'; }
    $wpdb->insert("wp_crud", array(
      "title" => $_POST['wqtitle'],
      "description" => $_POST['wqdescription'],
      "namex" => $_POST['namex'],
      "chkx" => $chkxx,
      "sts" => $_POST['stsx'],
      "created_at" => time(),
      "updated_at" => time()
    ));
    //echo $wpdb->print_error();
    //echo $wpdb->show_errors();
    //echo $wpdb->last_query;

    $response = array('message'=>'Data Has Inserted Successfully', 'rescode'=>200);
  } else {
    $response = array('message'=>'Data Has Already Exist', 'rescode'=>404);
  }
  echo json_encode($response);
  exit();
  wp_die();
}



add_action('wp_ajax_wqedit_entry', 'wqedit_entry_callback_function1');
add_action('wp_ajax_nopriv_wqedit_entry', 'wqedit_entry_callback_function1');

function wqedit_entry_callback_function1() { extract($_POST);
  global $wpdb;
  $wpdb->get_row( "SELECT * FROM `wp_crud` WHERE `title` = '".$_POST['wqtitle']."' AND `description` = '".$_POST['wqdescription']."' AND `id`!='".$_POST['wqentryid']."' ORDER BY `id` DESC" );
  if($wpdb->num_rows < 1) {
    if(isset($_POST['chk_sts']) && $chk_sts == "on") { $chkxx = '1'; } else { $chkxx = '0'; }
      $wpdb->update( "wp_crud", array(
        "title" => $_POST['wqtitle'],
        "description" => $_POST['wqdescription'],
        "namex" => $_POST['namex'],
        "chkx" => $chkxx,
        "sts" => $_POST['stsx'],
        "updated_at" => time()
      ), array('id' => $_POST['wqentryid']) );
    $response = array('message'=>'Data Has Updated Successfully', 'rescode'=>200);
  } else {
    $response = array('message'=>'Data Has Already Exist', 'rescode'=>404);
  }
  echo json_encode($response);
  exit();
  wp_die();
}

add_action('wp_ajax_sts_upd', 'sts_upd_callback_function1');
add_action('wp_ajax_nopriv_sts_upd', 'sts_upd_callback_function1');

function sts_upd_callback_function1() { extract($_POST); 
  global $wpdb;
  $data = $wpdb->get_row( "SELECT sts FROM `wp_crud` WHERE `id` = '".$aid."'" );
  if($data->sts == 0) {
    $n_sts = 1;
  } else {
    $n_sts = 0;
  }

  $wpdb->update("wp_crud", array(
    "sts" => $n_sts,
  ), array('id' => $aid));
  echo 1;
  exit();
  wp_die();
}
