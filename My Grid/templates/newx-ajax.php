<?php
if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
  global $wpdb;
  $data = $wpdb->get_row( "SELECT * FROM `wp_crud` WHERE id = '".$_REQUEST['id']."'" );
  $namex = $data->namex;  
  $chkx = $data->chkx;  
  $sts = $data->sts;
?>
  <div class="wrap wqmain_body">
    <h3 class="wqpage_heading">Edit Entry</h3>
    <div class="wqform_body">
      <form name="update_form" id="update_form">
        <input type="hidden" name="wqentryid" id="wqentryid" value="<?=$_REQUEST['id']?>" />
        <div class="wqlabel">Title</div>
        <div class="wqfield">
          <input type="text" class="wqtextfield" name="wqtitle" id="wqtitle" placeholder="Enter Your Title" value="<?=$data->title?>" />
        </div>
        <div id="wqtitle_message" class="wqmessage"></div>

        <div>&nbsp;</div>

        <div class="wqlabel">Description</div>
        <div class="wqfield">
          <textarea name="wqdescription" class="wqtextfield" id="wqdescription" placeholder="Enter Your Description"><?=$data->description?></textarea>
        </div>
        <div id="wqdescription_message" class="wqmessage"></div>

        <div>&nbsp;</div>

        <div class="wqlabel">Name</div>
        <div class="wqfield">
          <input type="text" class="namex" name="namex" id="namex" placeholder="Enter Your Title" value="<?=$data->namex?>" />
        </div>
        <div id="wqname_message" class="wqmessage"></div>

        <div>&nbsp;</div>

        <div class="wqlabel">Chk</div>
        <div class="wqfield">
          <?php if($chkx == 1) { $vv = ' checked="checked"'; } else { $vv = ""; } ?>
          <input type="checkbox" id="chk_sts" name="chk_sts"<?php echo $vv; ?>> Data Checked
        </div>
        <div id="wqchk_message" class="wqmessage"></div>

        <div>&nbsp;</div>

        <div class="wqlabel">Status</div>
        <div class="wqfield">
          <select name="stsx" id="stsx" required>
            <option value="0" <?php if($sts == "0") { echo 'selected="selected"'; } ?>>Active</option>
            <option value="1" <?php if($sts == "1") { echo 'selected="selected"'; } ?>>Deactive</option>
          </select>
        </div>
        <div id="wqstsx_message" class="wqmessage"></div>

        <div>&nbsp;</div>

        <div><input type="submit" class="wqsubmit_button" id="wqedit" value="Edit" /></div>
        <div>&nbsp;</div>
        <div class="wqsubmit_message"></div>

      </form>
    </div>
  </div>
<?php
} else {
?>
<div class="wrap wqmain_body">
  <h3 class="wqpage_heading">New Entry</h3>
  <div class="wqform_body">
    <form name="entry_form" id="entry_form">

      <div class="wqlabel">Title</div>
      <div class="wqfield">
        <input type="text" class="wqtextfield" name="wqtitle" id="wqtitle" placeholder="Enter Your Title" value="" />
      </div>
      <div id="wqtitle_message" class="wqmessage"></div>

      <div>&nbsp;</div>

      <div class="wqlabel">Description</div>
      <div class="wqfield">
        <textarea name="wqdescription" class="wqtextfield" id="wqdescription" placeholder="Enter Your Description"></textarea>
      </div>
      <div id="wqdescription_message" class="wqmessage"></div>

      <div>&nbsp;</div>

      <div class="wqlabel">Name</div>
      <div class="wqfield">
        <input type="text" class="wqtextfield" name="namex" id="namex" placeholder="Enter Your Title" />
      </div>
      <div id="wqname_message" class="wqmessage"></div>

      <div>&nbsp;</div>

      <div class="wqlabel">Chk</div>
      <div class="wqfield">
        <input type="checkbox" id="chk_sts" name="chk_sts"> Data Checked
      </div>
      <div id="wqchk_message" class="wqmessage"></div>

      <div>&nbsp;</div>

      <div class="wqlabel">Status</div>
      <div class="wqfield">
        <select name="stsx" id="stsx" required>
          <option value="0">Active</option>
          <option value="1">Deactive</option>
        </select>
      </div>
      <div id="wqstsx_message" class="wqmessage"></div>

      <div>&nbsp;</div>

      <div><input type="submit" class="wqsubmit_button" id="wqadd" value="Add" /></div>
      <div>&nbsp;</div>
      <div class="wqsubmit_message"></div>

    </form>
  </div>
</div>
<?php } ?>
