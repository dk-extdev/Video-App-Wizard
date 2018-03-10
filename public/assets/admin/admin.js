$(function () {
  'use strict';
  function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
  }
  $('#btn_generate').click(function(){
    $('#new_customer_password').val(randomPassword(8));
  });
  $('.video_modal').click(function(){
    //Rendered Videos of customer '{{ $customer->name }}':
    var inject_contents = '<h2 class="text-center">Rendered Videos of customer `'+$(this).attr('customername')+'`:</h2>';
    var video_data = $(this).data('videos');
    for (var i in video_data){
      inject_contents += '<p class="text-warning text-center" ><a href="'+video_data[i]+'">'+video_data[i]+'</a></p>';
    }
    $('#videoModal .modal-body').html(inject_contents);
    $("#videoModal").modal('show');
  });
  $('.transaction_modal').click(function(){
    $("#account_type").val($(this).attr('customertype'));
    $('#accountid').val($(this).attr('customerid'))
    $("#transactionModal").modal('show');
  });
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#update_type').click(function(){
    var id = $('#accountid').val();
    $('#hypercustomerid'+id).attr('customertype',$('#account_type').val());

    $.ajax(
    {
        url: "typeupdate",
        type: 'POST',
        dataType: "json",
        data: {
            "id": id,
            "type":$('#account_type').val()
        },
        success: function (data)
        {
            if(data.success=="success"){
              
            }
        }
    });
    $('.update-type-success').show();
    setTimeout(function(){ $('.update-type-success').hide(); }, 2000);
  });
  
  $('.delete-customer-id').click(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Delete Customer',
        message: 'Are you sure you want to delete this customer?',
        buttons: [
        {
            label: 'Cancel',
            action: function(dialogItself){
                dialogItself.close();
            }
        },{
            label: 'Delete',
            // no title as it is optional
            cssClass: 'btn-danger',
            action: function(dialogItself){
              dialogItself.close();
              $.ajax({
                  url: "deletecustomer/"+id,
                  type: 'POST',
                  dataType: "json",
                  data: {
                      "id": id,
                  },
                  success: function (data)
                  {
                      if(data.success=="success"){
                        $('#customerTable tr').each(function(){
                          if($(this).data('id') && $(this).data('id')==data.id){
                            $(this).remove();
                          }
                        });
                      }
                  }
              });
            }
        }
        ]
    });
  });
  
  $('.customer-suspend').click(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).data('suspendid');
    $.ajax({
        url: "suspendcustomer/"+id,
        type: 'POST',
        dataType: "json",
        data: {
            "id": id,
        },
        success: function (data)
        {
          if(data.success=="success"){
            $('#customerTable tr').each(function(){
                if($(this).data('id') && $(this).data('id')==data.id){
                  if(data.returnstatus==1){
                    $(this).find('td button.customer-suspend').html("Suspend");
                  }else{
                    $(this).find('td button.customer-suspend').html("Unsuspend");
                  }
                }
            });
          }
        }
    });
  });

  $('.delete-news-id').click(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Delete News',
        message: 'Are you sure you want to delete this news?',
        buttons: [
        {
            label: 'Cancel',
            action: function(dialogItself){
                dialogItself.close();
            }
        },{
            label: 'Delete',
            // no title as it is optional
            cssClass: 'btn-danger',
            action: function(dialogItself){
              dialogItself.close();
              $.ajax({
                  url: "deletenews/"+id,
                  type: 'POST',
                  dataType: "json",
                  data: {
                      "id": id,
                  },
                  success: function (data)
                  {
                      if(data.success=="success"){
                        $('#newsTable tr').each(function(){
                          if($(this).data('id') && $(this).data('id')==data.id){
                            $(this).remove();
                          }
                        });
                      }
                  }
              });
            }
        }
        ]
    });
  });
  $('.delete-template-id').click(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).data('id');
    BootstrapDialog.show({
        title: 'Delete News',
        message: 'Are you sure you want to delete this template?',
        buttons: [
        {
            label: 'Cancel',
            action: function(dialogItself){
                dialogItself.close();
            }
        },{
            label: 'Delete',
            // no title as it is optional
            cssClass: 'btn-danger',
            action: function(dialogItself){
              dialogItself.close();
              $.ajax({
                  url: "deletetemplate/"+id,
                  type: 'POST',
                  dataType: "json",
                  data: {
                      "id": id,
                  },
                  success: function (data)
                  {
                      if(data.success=="success"){
                        $('#templateTable tr').each(function(){
                          if($(this).data('id') && $(this).data('id')==data.id){
                            $(this).remove();
                          }
                        });
                      }
                  }
              });
            }
        }
        ]
    });
  });
  $("body").on("click", "#removeTemplate", function() {
    $(this).parent().parent().remove();
  });
  $('#addTemplate').click(function(){
    var html = '';
    html += '<tr>\
      <td>\
        <input type="text" required="true" class="form-control">\
      </td>\
      <td>\
        <input type="text" required="true" class="form-control">\
      </td>\
      <td>\
        <select class="form-control color-picker">\
          <option>Text</option>\
          <option>File</option>\
          <option>Color Picker</option>\
        </select>\
      </td>\
      <td>\
        <input type="text" required="true" class="form-control">\
      </td>\
      <td>\
        <button type="button" id="removeTemplate" class="form-control add-row btn btn-block btn-info" ><i class="glyphicon glyphicon-minus"></i></button>\
      </td>\
    </tr>';
    $('#newTemplate tbody').append(html);
  });
  $('#btnAddTemplate').click(function(){
    if(!$('#project').val()){
      $('#project').focus();
      return false;
    }else{
      var attr = [];
      $('#newTemplate tbody tr').each(function(){
        if($(this).find(".form-control").first().val()) {
          attr.push(new Array);
          $(this).find(".form-control").not("button").each(function(){
            attr[attr.length - 1].push($(this).val());
          });
        }
      });
      if(!attr.length){
        return false;
      }else{
        var formData = new FormData();
        var project = $("#project").val();
        formData.append('project', project);
        formData.append('attr', JSON.stringify(attr));
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax(
        {
          url: "createtemplate",
          data: formData,
          processData: false,
          contentType: false,
          dataType: "json",
          type: "POST",
          success: function (data)
          {
            if(data['success']=="success"){
              $('.alert-success').show();
              setTimeout(function(){ $('.alert-success').hide(); }, 2000);
            }
          }
        });
      }
    }
  });
  $('#btnUpdateTemplate').click(function(){
    var id = $(this).attr('template_group_id');
    if(!$('#project').val()){
      $('#project').focus();
      return false;
    }else{
      var attr = [];
      $('#newTemplate tbody tr').each(function(){
        if($(this).find(".form-control").first().val()) {
          attr.push(new Array);
          $(this).find(".form-control").not("button").each(function(){
            attr[attr.length - 1].push($(this).val());
          });
        }
      });
      if(!attr.length){
        return false;
      }else{
        var formData = new FormData();
        var project = $("#project").val();
        formData.append('project', project);
        formData.append('attr', JSON.stringify(attr));
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax(
        {
          url: id,
          data: formData,
          processData: false,
          contentType: false,
          dataType: "json",
          type: "POST",
          success: function (data)
          {
            console.log(data);
            if(data['success']=="success"){
              $('.alert-success').show();
              setTimeout(function(){ $('.alert-success').hide(); }, 2000);
            }
          }
        });
      }
    }
  });
});
