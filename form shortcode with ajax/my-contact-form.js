$(document).on('submit','form#my-contact-form',function(){
  var c_nm = $("#full-name").val();
  var c_em = $("#email").val();
  var c_ms = $("#message").val();

  if(c_nm == "") { alert("enter name"); return false; }
  if(c_em == "") { alert("enter email");  return false; }
  if(c_ms == "") { alert("enter message");  return false; }

  var formData = { c_nm: c_nm, c_em: c_em, c_ms: c_ms, action: 'my_ajax_request' }
  
  $.ajax({
    type: "POST",
    url: ajax_url,  //"http://site_nm/wp-admin/admin-ajax.php",
    data : formData,
    beforeSend: function(data){
      $("#validation-messages-container").html('');
    },
    error: function() { 
      alert("Error occured.please try again");
    },
    success: function(data){
      $("#validation-messages-container").html(data);
    },
    complete: function() { }
  }).done(function (data) { });

  return false;
});


(function($){
  //alert(10);
}(jQuery));

