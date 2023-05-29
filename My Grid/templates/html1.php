<?php 
//echo "<pre>";
//print_r($_POST);
//print_r($_REQUEST);
if(isset($_POST['action'])){
    if($_POST['action'] == 'save_data'){
        echo "save";
    } else if($_POST['action'] == 'update_data'){
        echo "update";
    }
}


if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
  global $wpdb;
  $data = $wpdb->get_row("SELECT * FROM `wp_crud` WHERE id = '".$_REQUEST['id']."'");

?>
  <div class="wrap wqmain_body">
    <h3 class="wqpage_heading">Edit Entry</h3>
    <div class="wqform_body">
      <form name="update_form" id="update_formxx" action="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" method="post">
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

        <div><input type="submit" class="wqsubmit_button" id="wqedit" value="Edit" /></div>
        <input type="hidden" name="action" value="update_data" />
        <div>&nbsp;</div>
        <div class="wqsubmit_message"></div>

      </form>
    </div>
  </div>
<?php } else { ?>

<div class="wrap wqmain_body">
  <h3 class="wqpage_heading">New Entry</h3>
  <div class="wqform_body">
    <form name="entry_form" id="entry_formxx" action="<?php echo admin_url('admin.php?page=supporthost_list2'); ?>" method="post">

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

      <div><input type="submit" class="wqsubmit_button" id="wqadd" value="Add" /></div>
      <input type="hidden" name="action" value="save_data" />
      <div>&nbsp;</div>
      <div class="wqsubmit_message"></div>

    </form>
  </div>
</div>
<?php } ?>
<div id="wpbody">
  <div id="wpbody-content" aria-label="Main content" tabindex="0" style="overflow: hidden;">
    <div class="wrap">
      <h2>Edit Data<a href="" class="add-new-h2">Add New</a> </h2>
      <form name="post" action="" id="post">
        <div id="poststuff">
          <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
              <div id="titlediv">
                <div id="titlewrap">
                  <label class="screen-reader-text" id="title-prompt-text" for="title">Enter title here</label>
                  <input type="text" name="post_title" size="30" value="" id="title" autocomplete="off"> </div>
              </div>
            </div>
            <div id="postbox-container-1" class="postbox-container">
              <div id="side-sortables" class="meta-box-sortables ui-sortable">
                <div id="submitdiv" class="postbox">
                  <div class="inside">
                    <div class="submitbox" id="submitpost">
                      <div id="major-publishing-actions">
                        <div id="publishing-action">
                          <input name="original_publish" type="hidden" id="original_publish" value="Save">
                          <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save" accesskey="p"> </div>
                        <div class="clear"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="postbox-container-2" class="postbox-container">
              <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <div id="" class="postbox">
                  <h3 class="hndle"><span>Title</span></h3>
                  <div class="inside">
                    <input type="text" class="wqtextfield" name="wqtitle" id="wqtitle" placeholder="Enter Your Title" value="" />
                  </div>
                  <h3 class="hndle"><span>Description</span></h3>
                  <div class="inside">
                    <textarea name="wqdescription" class="wqtextfield" id="wqdescription" placeholder="Enter Your Description"></textarea>
                  </div>
                </div>
                <div id="" class="postbox">
                  <div class="inside">
                    <label for="birthday">Status ?</label>
                    <select name="" id="">
                      <option value="0">Active</option>
                      <option value="1">Deactive</option>
                    </select>
                  </div>
                  <div class="inside">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday"> </div>
                  <div class="inside">
                    <label for="birthday">Email:</label>
                    <input type="email" name="email" id="email" required> </div>
                  <div class="inside">
                    <label for="birthday">Check ?:</label>
                    <input type="checkbox" id="chk_sts" name="chk_sts"> </div>
                  <div class="inside">
                    <label for="birthday">Online ?:</label>
                    <br>
                    <input type="radio" id="css" name="lo_sts" value="1"> Online
                    <input type="radio" id="css" name="lo_sts" value="0"> Offline </div>
                </div>
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
                    <input type="checkbox" id="chk_sts" name="chk_sts">
                  </div>
                  <div class="inside">
                    <h3 class="hndle"><label class="screen-reader-textx hndle">Online ?</label></h3>
                    <input type="radio" id="css" name="lo_sts" value="1"> Online
                    <input type="radio" id="css" name="lo_sts" value="0"> Offline
                  </div>
                  <div class="inside">
                    <h3 class="hndle"><label class="screen-reader-textx hndle">Status ?</label></h3>
                    <select name="" id="">
                      <option value="0">Active</option>
                      <option value="1">Deactive</option>
                    </select>
                  </div>

                </div>
                <div class="inside">
                  <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save" accesskey="p">
                </div>
                <div id="postexcerpt" class="postbox">
                  <div class="postbox-header">
                    <h2 class="hndle ui-sortable-handle">Excerpt</h2></div>
                  <div class="inside">
                    <label class="screen-reader-text" for="excerpt">Excerpt</label>
                    <textarea rows="1" cols="40" name="excerpt" id="excerpt"></textarea>
                    <p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme.</p>
                  </div>
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