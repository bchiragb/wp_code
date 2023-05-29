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
            <h2>Edit Something <a href="" class="add-new-h2">Add New</a> </h2>

            <form name="post" action="" id="post">
                <div id="poststuff"> 
                    <div id="post-body" class="metabox-holder columns-2">
  
                      <div id="post-body-content"> 
                            <div id="titlediv"> 
                                <div id="titlewrap"> 
                                    <label class="screen-reader-text" id="title-prompt-text" for="title">Enter title here</label> 
                                    <input type="text" name="post_title" size="30" value="Something's title" id="title" autocomplete="off">
                                </div>
                            </div><!-- /titlediv -->
                        </div><!-- /post-body-content -->

                        <div id="postbox-container-1" class="postbox-container">
                            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                                
                                <!-- METABOX -->
                                <div id="submitdiv" class="postbox">
                            <h3 class="hndle"><span>Metabox title</span></h3>
                             <div class="inside">
                                <div class="submitbox" id="submitpost">
                              <div id="minor-publishing">
                                                <div style="display:none;">
                                                    <p class="submit"><input type="submit" name="save" id="save" class="button" value="Save"></p>
                                                </div>
                                                <div id="minor-publishing-actions">
                                                    <div id="save-action">
                                                            <input type="submit" name="save" id="save-post" value="Save Draft" class="button">
                                                    </div>
                                                    <div class="clear"></div>
                                                </div><!-- #minor-publishing-actions -->
                                                <div id="misc-publishing-actions">
                                                    <div class="misc-pub-section misc-pub-post-status">
                                                            <label for="post_status">Status:</label> <span id="post-status-display">Draft</span> <a href="#post_status" class="edit-post-status hide-if-no-js">Edit</a>
                                                            <div id="post-status-select" class="hide-if-js">
                                                                <input type="hidden" name="hidden_post_status" id="hidden_post_status" value="draft"> 
                                                                <select name="post_status" id="post_status">
                                                                    <option value="pending">Pending Review</option>
                                                                    <option selected="selected" value="draft">Draft</option>
                                                                </select> 
                                                                <a href="#post_status" class="save-post-status hide-if-no-js button">OK</a> <a href="#post_status" class="cancel-post-status hide-if-no-js button-cancel">Cancel</a>
                                                            </div>
                                                    </div><!-- .misc-pub-section -->
                                                    <div class="misc-pub-section misc-pub-visibility" id="visibility">
                                                            Visibility: <span id="post-visibility-display">Public</span> <a href="#visibility" class="edit-visibility hide-if-no-js">Edit</a>
                                                            <div id="post-visibility-select" class="hide-if-js">
                                                                <input type="hidden" name="hidden_post_password" id="hidden-post-password" value=""> <input type="hidden" name="hidden_post_visibility" id="hidden-post-visibility" value="public"> <input type="radio" name="visibility" id="visibility-radio-public" value="public" checked="checked"> <label for="visibility-radio-public" class="selectit">Public</label><br>
                                                                <input type="radio" name="visibility" id="visibility-radio-password" value="password"> <label for="visibility-radio-password" class="selectit">Password protected</label><br>
                                                                <span id="password-span"><label for="post_password">Password:</label> <input type="text" name="post_password" id="post_password" value="" maxlength="20"><br></span> <input type="radio" name="visibility" id="visibility-radio-private" value="private"> <label for="visibility-radio-private" class="selectit">Private</label><br>
                                                                <p> <a href="#visibility" class="save-post-visibility hide-if-no-js button">OK</a> <a href="#visibility" class="cancel-post-visibility hide-if-no-js button-cancel">Cancel</a> </p>
                                                            </div>
                                                    </div><!-- .misc-pub-section -->
                                                    <div class="misc-pub-section curtime misc-pub-curtime">
                                                            <span id="timestamp">Publish on: <b>Mar 6, 2014 @ 13:58</b></span> <a href="#edit_timestamp" class="edit-timestamp hide-if-no-js">Edit</a>
                                                            <div id="timestampdiv" class="hide-if-js">
                                                                <div class="timestamp-wrap">
                                                                    <select id="mm" name="mm">
                                                                            <option value="03" selected="selected"> 03-Mar </option>
                                                                    </select> <input type="text" id="jj" name="jj" value="06" size="2" maxlength="2" autocomplete="off">, <input type="text" id="aa" name="aa" value="2014" size="4" maxlength="4" autocomplete="off"> @ <input type="text" id="hh" name="hh" value="13" size="2" maxlength="2" autocomplete="off"> : <input type="text" id="mn" name="mn" value="58" size="2" maxlength="2" autocomplete="off">
                                                                </div><input type="hidden" id="ss" name="ss" value="41">
                                                                <p> <a href="#edit_timestamp" class="save-timestamp hide-if-no-js button">OK</a> <a href="#edit_timestamp" class="cancel-timestamp hide-if-no-js button-cancel">Cancel</a> </p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="major-publishing-actions">
                                                <div id="delete-action">
                                                    <a class="submitdelete deletion" href="">Move to Trash</a>
                                                </div>
                                                <div id="publishing-action">
                                                    <input name="original_publish" type="hidden" id="original_publish" value="Save"> <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save" accesskey="p">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="postimagediv" class="postbox ">
                                    <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Featured Image</span></h3>
                                    <div class="inside">
                                        <p ><a title="Set featured image" href="" id="set-post-thumbnail" class="thickbox">Set featured image</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="postbox-container-2" class="postbox-container"><div id="normal-sortables" class="meta-box-sortables ui-sortable">
                            <div id="" class="postbox">
                                <h3 class="hndle"> <span>Metabox</span> </h3>
                                <div class="inside">
                                    <select name="" id="">
                                        <option value="">Sample selectbox</option>
                                        <option value="">Sample</option>
                                    </select> 
                                    <button id="" class="button button-primary button-large">Button</button>
                                </div>
                            </div>


                            <div id="" class="postbox">
                                <h3 class="hndle"> <span>Another Metabox</span> </h3>
                                <div class="inside">
                                    Add something here
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /post-body --> 
                <br class="clear"> 
            </div><!-- /poststuff -->
        </form>
    </div> 
    <div class="clear"></div>
</div>

<form id="form-id" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
  <label for="first-name">First Name</label>
  <input type="text" name="first-name" id="first-name" required>
  <label for="last-name">Last Name</label>
  <input type="text" name="last-name" id="last-name" required>
  <label for="email">Email Address</label>
  <input type="email" name="email" id="email" required>
  <label for="birthday">Birthday:</label>
  <input type="date" id="birthday" name="birthday">
  <!-- We also need to add the action hidden input so that we can trigger the more specific hook -->
  <input type="hidden" name="action" value="form_submit_action">
  <input type="submit" class="submit-form" value="Submit"/>
</form>


<?php 
// In your functions.php
// Action function
function form_submit_action() {
  // You can now use $_GET/$_POST variables depending on what method you used in your form
  // In this case we are using method post
  $first_name = sanitize_text_field($_POST['first-name']);
  $last_name = sanitize_text_field($_POST['last-name']);
  $email = sanitize_email($_POST['email']);
  $birthday = sanitize_text_field($_POST['birthday']);
 
  // Then do the processing here like create new post/user, update new post/user , etc.
  // But on this example im gonna show you how send an email, create your own custom html body format.
  
  // Send to admin
  $to = get_bloginfo('admin_email'); // or 'sendee@email.com' to specify email
  // Email subject
  $subject = 'Customer Wishlist';
  // Email body/content (tricky part)
  /* Instead of:
      $body = '<div>
                <p>'. $first_name .'</p>
               </div>'; 
   */
  // We can create a custom function with the post fields as your attributes
  $body = my_email_body_function($first_name,$last_name,$email,$birthday);
  $headers = array('Content-Type: text/html; charset=UTF-8');
  wp_mail( $to, $subject, $body, $headers );
  
  // Then redirect to desired page
  wp_redirect(home_url('/desired-page'));
  
}
// Necessary action hooks
// Use our specific action form_submit_action to process the data related to our request
add_action( 'admin_post_nopriv_form_submit_action', 'form_submit_action' );
add_action( 'admin_post_form_submit_action', 'form_submit_action' );

