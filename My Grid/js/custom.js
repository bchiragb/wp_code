jQuery(document).ready(function(){

  //new
  $(document).on('submit','#entry_form', function(e) {
    e.preventDefault();
    $('.wqmessage').html('');
    $('.wqsubmit_message').html('');

    var wqtitle = $('#wqtitle').val();
    var wqdescription = $('#wqdescription').val();

    if(wqtitle=='') {
      $('#wqtitle_message').html('Title is Required');
    }
    if(wqdescription=='') {
      $('#wqdescription_message').html('Description is Required');
    }

    if(wqtitle!='' && wqdescription!='') {
      var fd = new FormData(this);
      var action = 'wqnew_entry';
      fd.append("action", action);
      $.ajax({
        data: fd,
        type: 'POST',
        url: ajax_var1.ajaxurl1,
        contentType: false,
			  cache: false,
			  processData:false,
        success: function(response) {
          var res = JSON.parse(response);
          $('.wqsubmit_message').html(res.message);
          if(res.rescode!='404') {
            $('#entry_form')[0].reset();
            $('.wqsubmit_message').css('color','green');
          } else {
            $('.wqsubmit_message').css('color','red');
          }
        }
      });
    } else {
      return false;
    }
  });


  //update
  $(document).on('submit','#update_form', function(e) { 
    e.preventDefault();
    $('.wqmessage').html('');
    $('.wqsubmit_message').html('');

    var wqtitle = $('#wqtitle').val();
    var wqdescription = $('#wqdescription').val();

    if(wqtitle=='') {
      $('#wqtitle_message').html('Title is Required');
    }
    if(wqdescription=='') {
      $('#wqdescription_message').html('Description is Required');
    }

    if(wqtitle!='' && wqdescription!='') {
      var fd = new FormData(this);
      var action = 'wqedit_entry';
      fd.append("action", action);

      $.ajax({
        data: fd,
        type: 'POST',
        url: ajax_var1.ajaxurl1,
        contentType: false,
			  cache: false,
			  processData:false,
        success: function(response) {
          var res = JSON.parse(response);
          $('.wqsubmit_message').html(res.message);
          if(res.rescode!='404') {
            $('.wqsubmit_message').css('color','green');
          } else {
            $('.wqsubmit_message').css('color','red');
          }
        }
      });
    } else {
      return false;
    }
  });

  //status
  $(document).on('click','.chn_sts', function(e) { 
    e.preventDefault();
    var aid = $(this).attr('data-val');
    
    $.ajax({
      data: { "action": 'sts_upd', "aid": aid },
      type: 'POST',
      url: ajax_var1.ajaxurl1,
      cache: false,
      success: function(response) {
        if(response == 1){
          alert("Data Has Updated Successfully");
          window.location.replace(ajax_var1.ajaxurl2 + '/wp-admin/admin.php?page=supporthost_list');
        } 
      }
    });
  });

  //active class all, active tab
  var liclass = $('.activeon').val();
  console.log(liclass);
  $(".subsubsub li").each(function() { 
    var li_cls = $(this).attr("class");
    if(li_cls == liclass) {
      $(this).children().addClass("current");
    }
  });

});
