function isEmail(email) {
  //var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return regex.test(email);
}

//register
$(document).on('submit','form#register_forms',function(){
  var c_username = $("#r_username").val();
  var c_password = $("#r_password").val();
  var c_email = $("#r_email").val();
  var c_website = $("#r_website").val();
  var c_fname = $("#r_fname").val();
  var c_lname = $("#r_lname").val();
  var c_nickname = $("#r_nickname").val();

  if(c_username == "") { alert("enter username"); return false; }
  if(c_password == "") { alert("enter password");  return false; }
  if(c_email == "") { alert("enter email");  return false; }
  //if(isEmail(email) == false) { alert("enter valid email"); return false; }

  var formData = { c_username: c_username, c_password: c_password, c_email: c_email, c_website: c_website, c_fname: 
  c_fname, c_lname: c_lname, c_nickname: c_nickname, nonce: ajax_noncer, action: 'my_ajax_register' }

  $.ajax({
    type: "POST",
    url: ajax_url,  
    data : formData,
    beforeSend: function(data){
      $("error_reg").html('');
    },
    error: function() { 
      alert("Error occured. Please try again");
    },
    success: function(data){
      $("#error_reg").html(data);
    }
  });

  return false;
});



//login
$(document).on('submit','form#login_forms',function(){
  var c_username = $("#l_username").val();
  var c_password = $("#l_password").val();
  var c_remember = $("#l_remember").prop("checked");
  
  if(c_username == "") { alert("enter login username"); return false; }
  if(c_password == "") { alert("enter login password");  return false; }
  //if(isEmail(email) == false) { alert("enter valid email"); return false; }

  var formData = { c_username: c_username, c_password: c_password, c_remember: c_remember, nonce: ajax_noncel, action: 'my_ajax_login' }
  $.ajax({
    type: "POST",
    url: ajax_url,  
    data : formData,
    beforeSend: function(data){ $("error_logi").html(''); },
    error: function() { alert("Error occured. Please try again"); },
    success: function(data){ window.location = data; }
  });

  return false;
});


//forgot
$(document).on('submit','form#forgot_forms',function(){
  var c_username = $("#f_username").val();
  if(c_username == "") { alert("enter forgot username"); return false; }
  
  var formData = { c_username: c_username, nonce: ajax_noncef, action: 'my_ajax_forgot' }
  $.ajax({
    type: "POST",
    url: ajax_url,  
    data : formData,
    beforeSend: function(data){ $("error_forgot").html(''); },
    error: function() { alert("Error occured. Please try again"); },
    success: function(data){ $("error_forgot").html(data); }
  });

  return false;
});

