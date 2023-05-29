<?php  global $wpdb; extract($_POST); $tblnm = "wp_crud";
if(isset($_POST['action'])){
    if($_POST['action'] == 'save_data'){ // new-------------------------------------------------------------------
      $arr_ins = array(
        "title" => $wqtitle,
        "description" => $wqdescription,
        "namex" => $email,
        "chkx" => $chk_sts,
        "sts" => $stsx,
        "created_at" => time(),
        "updated_at" => time()
      );
      
      $sql = "SELECT * FROM ".$tblnm." WHERE `title` = '".$_POST['wqtitle']."' AND `description` = '".$_POST['wqdescription']."' ORDER BY `id` DESC";
      $wpdb->get_row($sql);
      if($wpdb->num_rows < 1) {
        $wpdb->insert($tblnm, $arr_ins);
        $response = 1;
      } else {
        $response = 0;
      }
      $link = admin_url('admin.php?page=supporthost_list2&ss='.$response);
      ?><script>window.location.replace('<?php echo $link; ?>');</script><?php
    } else if($_POST['action'] == 'update_data'){ // edit-------------------------------------------------------------------
       print_r($_POST);
       $arr_upd = array(
        "title" => $wqtitle,
        "description" => $wqdescription,
        "namex" => $email,
        "chkx" => isset($_POST['chk_sts']) ? 1 : 0,
        "sts" => $stsx,
        "created_at" => time(),
        "updated_at" => time()
      ); 
      $sql = "SELECT * FROM ".$tblnm." WHERE `title` = '".$_POST['wqtitle']."' AND `description` = '".$_POST['wqdescription']."' AND `id`!='".$_POST['wqentryid']."' ORDER BY `id` DESC";
      $wpdb->get_row($sql);
      if($wpdb->num_rows < 1) {
        $wpdb->update($tblnm, $arr_upd, array('id' => $wqentryid));
        $response = 1;
      } else {
        $response = 0;
      }
      $link = admin_url('admin.php?page=supporthost_list2&action=edit&id='.$wqentryid.'&ss='.$response);
      ?><script>window.location.replace('<?php echo $link; ?>');</script><?php
    }
}

//get data and show
if(isset($_REQUEST['id']) && $_REQUEST['id']!='') { //edit --------------------------------------------------------------------------------
  global $wpdb;
  $data = $wpdb->get_row("SELECT * FROM ".$tblnm." WHERE id = '".$_REQUEST['id']."'");
  $namex = $data->namex;  
  $chkx = $data->chkx;  
  $sts = $data->sts;  ?>
  <div id="wpbody">
    <div id="wpbody-content">
      <div class="wrap">
        <h2>Edit Data<a href="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" class="add-new-h2">Add New</a> </h2>
        <?php if(isset($_REQUEST['ss'])) {
        if($_REQUEST['ss'] == 1) { ?> 
          <div id="message" class="notice notice-success is-dismissible"><p>Data Has updated Successfully. </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss</span></button></div>
        <?php } else { ?> 
          <div id="message" class="notice notice-warning is-dismissible"><p>Data Has Error.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss</span></button></div>
        <?php } } ?>
        <form name="update_form" id="update_formxx" action="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" method="post">
          <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-1">
              <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                  <div id="postexcerpt" class="postbox">
                    <div class="postbox-header">
                      <h2 class="hndle ui-sortable-handle">Data Box</h2></div>
                    <div class="inside">
                      <h3 class="hndle"><span>Title:</span></h3>
                      <input type="text" class="wqtextfield" name="wqtitle" id="wqtitle" placeholder="Enter Your Title" value="<?=$data->title?>" />
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Description:</label></h3>
                      <textarea name="wqdescription" class="wqtextfield" id="wqdescription" placeholder="Enter Your Description"><?=$data->description?></textarea>  
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Date:</label></h3>
                      <input type="date" id="birthday" name="birthday">
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Email:</label></h3>
                      <input type="email" name="email" id="email" required value="<?php echo $namex; ?>">
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Check ?</label></h3>
                      <?php if($chkx == 1) { $vv = ' checked="checked"'; } else { $vv = ""; } ?>
                      <input type="checkbox" id="chk_sts" name="chk_sts"<?php echo $vv; ?>> Data Checked
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Online ?</label></h3>
                      <input type="radio" id="css" name="lo_sts" value="1"> Online
                      <input type="radio" id="css" name="lo_sts" value="0"> Offline
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Status ?</label></h3>
                       <select name="stsx" id="stsx" required>
                        <option value="0" <?php if($sts == "0") { echo 'selected="selected"'; } ?>>Active</option>
                        <option value="1" <?php if($sts == "1") { echo 'selected="selected"'; } ?>>Deactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="inside">
                    <input type="hidden" name="action" value="update_data"/>
                    <input type="hidden" name="wqentryid" value="<?php echo $_REQUEST['id']; ?>"/>
                    <input type="submit" name="publish" id="wqedit" class="button button-primary button-large" value="Update" accesskey="p">
                  </div>
                </div>
              </div>
            </div>
            <br class="clear"> 
          </div>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
<?php } else { //new -------------------------------------------------------------------------------- ?>
  <div id="wpbody">
    <div id="wpbody-content">
      <div class="wrap">
        <h2>Add Data <a href="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" class="add-new-h2">Add New</a> </h2>
        <?php if(isset($_REQUEST['ss'])) {
        if($_REQUEST['ss'] == 1) { ?> 
          <div id="message" class="notice notice-success is-dismissible"><p>Data Has Inserted Successfully. </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss</span></button></div>
        <?php } else { ?> 
          <div id="message" class="notice notice-warning is-dismissible"><p>Data Has Already Exist Or Error.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss</span></button></div>
        <?php } } ?>
        <form name="entry_form" id="entry_formxx" action="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" method="post">
          <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-1">
              <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                  <div id="postexcerpt" class="postbox">
                    <div class="postbox-header">
                      <h2 class="hndle ui-sortable-handle">Data Box</h2></div>
                    <div class="inside">
                      <h3 class="hndle"><span>Title:</span></h3>
                      <input type="text" class="wqtextfield" name="wqtitle" id="wqtitle" placeholder="Enter Your Title" value="" />
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Description:</label></h3>
                      <textarea name="wqdescription" class="wqtextfield" id="wqdescription" placeholder="Enter Your Description"></textarea>  
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Date:</label></h3>
                      <input type="date" id="birthday" name="birthday">
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Email:</label></h3>
                      <input type="email" name="email" id="email" required>
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Check ?</label></h3>
                      <input type="checkbox" id="chk_sts" name="chk_sts"> Data Checked
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Online ?</label></h3>
                      <input type="radio" id="css" name="lo_sts" value="1"> Online
                      <input type="radio" id="css" name="lo_sts" value="0"> Offline
                    </div>
                    <div class="inside">
                      <h3 class="hndle"><label class="screen-reader-textx hndle">Status ?</label></h3>
                      <select name="stsx" id="stsx" required>
                        <option value="">--</option>
                        <option value="0">Active</option>
                        <option value="1">Deactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="inside">
                    <input type="hidden" name="action" value="save_data" />
                    <input type="submit" class="button button-primary button-large" value="Save" accesskey="p">
                  </div>
                </div>
              </div>
            </div>
            <br class="clear"> 
          </div>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
<?php } ?>
