
<!--Jquery Library-->
<!--script src="{{ asset('js/jquery.js') }}"></script-->

<!--Swiper JavaScript-->

<!-- Mainly scripts -->
<script src="{{ asset('assets/theme-new/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/staps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/chartJs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/demo/peity-demo.js') }}"></script>
<script src="{{ asset('assets/Parsley.js-2.8.0/dist/parsley.js') }}"></script>
<script src="{{ asset('assets/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/plugins/cropper/cropper.min.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/bootstrap-tooltip.js') }}"></script>
<script src="{{ asset('assets/theme-new/js/ajaxscript.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/jquery.csv.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid_renderers.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid_editors.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid_validators.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid_utils.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/theme-new/js/grid/editablegrid_charts.js') }}" type="text/javascript"></script>


<script type="text/javascript">
	$('#myTable').DataTable( {
    "order": [[ 2, "desc" ]],
		"dom": '<"top"lf>rt<"bottom"ip><"clear">',
		language: {
			searchPlaceholder: "",
			"paginate": {
				"previous": '<i class="fa fa-chevron-left"></i>',
				"next": '<i class="fa fa-chevron-right"></i>'
			},
			sSearch: "Search"
		}
	} );
  $('#myTable1').DataTable( {
    "order": [[ 1, "desc" ]],
    "dom": '<"top"lf>rt<"bottom"ip><"clear">',
    language: {
      searchPlaceholder: "",
      "paginate": {
        "previous": '<i class="fa fa-chevron-left"></i>',
        "next": '<i class="fa fa-chevron-right"></i>'
      },
      sSearch: "Search"
    }
  } );
  $('#myTable2').DataTable( {
    "order": [[ 1, "desc" ]],
    "dom": '<"top"lf>rt<"bottom"ip><"clear">',
    language: {
      searchPlaceholder: "",
      "paginate": {
        "previous": '<i class="fa fa-chevron-left"></i>',
        "next": '<i class="fa fa-chevron-right"></i>'
      },
      sSearch: "Search"
    }
  } );
  $(document).ready(function(){
    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var page = $(this).attr('href').split("page=")[1];
      var selected_category = [];
      $(".file-manager .i-checks").each(function(){
        if($(this).iCheck('update')[0].checked){
          selected_category.push($(this).iCheck('update')[0].value);
        }
      });
      var searchkey = $("#template_search_keyword").val(); 
      var sort = $("#sorttemplate").val();
      var formData = new FormData();
      formData.append('searchkey', searchkey);
      formData.append('sort', sort);
      formData.append('category', selected_category);
      getAllTemplates(page,formData);
    });
    function getAllTemplates(id,formData){
      $.ajax(
      {
        url: "create_videos/page?page="+id,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "html",
        type: "POST",
        success: function (data)
        {
          $('.new-table-content').html(data);
          $("#videotemplateModal").on('hidden.bs.modal', function (e) {
              $("#videotemplateModal iframe").attr("src", "");
          });
          $('.preview-video-template').click(function(){
            var url = $(this).attr('video-url');
            var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            if(videoid[1]){
             var inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
              $('#videotemplateModal .modal-body').html(inject_contents);
              $("#videotemplateModal").modal('show'); 
            }
          });
          $('div.choose-template').click(function(){
            var choosedtemplate = $(this).attr('template-type');
            var choosedtemplateurl = $(this).attr('template-url');
            var chooseedtemplategroup = $(this).attr('template-group');
            var template_video_id = $(this).attr('template-video-id');
            $('.template-selected').remove();
            $(this).parent().append('<span class="template-selected">Selected</span>');
            $('#choosed_template').val(choosedtemplate);
            $('#choosed_template_url').val(choosedtemplateurl);
            $('#choosed_template_group').val(chooseedtemplategroup);
            $('#template_video_id').val(template_video_id);
            if(chooseedtemplategroup){
              getTemplate(chooseedtemplategroup);
            }
          });
        }
      });
    }
    var static_csv_field = [];
    var static_csv_html = [];
    var csv_mapped_data = [];
    var editableGrid;
    function getTemplate(id){
      //$('.create_video-step3-2').load('template/'+id);
      $.ajax({
        url: "template/"+id,
        type: 'GET',
        dataType: "json",
        success: function (data)
        {
          if(data['project'] && data['template_field'].length){
            static_csv_field = ['customer_first_name','customer_last_name','customer_email'];
            static_csv_html = ['Customer First Name', 'Customer Last Name', 'Customer Email'];
            mapped_data = [];
            $('#csv_mapping').html('');
            $('#csv_content_table tbody').html('');
            $('#csv_content_table thead').html('');
            $('#csv-display').addClass('hide');
            $('#startmapping').remove();
            $('#create_video-inpute-file').val();
            var template_field = data['template_field'];
            var common_field = data['common_field'];
            $('#upload-manually').html('');
            var html = '';
            html += '<input type="hidden" id="project_title" name="project_title" value="'+$("#projecttitle").val()+'"/>';
            html += '<input type="hidden" id="template_video_id" name="template_video_id" value="'+$('#template_video_id').val()+'"/>';
            html += '<div class="form-check">\
                      <input class="form-check-input" type="checkbox" id="directDownload" value="unchecked" name="directDownload">\
                      <label class="form-check-label" for="directDownload">\
                        Do not upload to youtube and send email.\
                      </label>\
                    </div>';
            var template_html = '';
            common_field.forEach(function(common){

              if(common!="id"){
                if(common=="sender_name"){
                  html += '<div class="form-group">\
                    <label>'+common.replace(/_/g , " ").replace(/\b\w/g, l => l.toUpperCase())+'</label><input type="text" maxlength="100" placeholder="" name="'+common+'" id="'+common+'" value="{{ Auth::guard("user")->user()->name }}" class="form-control">\
                  </div>';
                }else if(common=="sender_email"){
                  html += '<div class="form-group">\
                    <label>'+common.replace(/_/g , " ").replace(/\b\w/g, l => l.toUpperCase())+'</label><input type="text" maxlength="100" placeholder="" name="'+common+'" id="'+common+'" value="{{ Auth::guard("user")->user()->email }}" class="form-control">\
                  </div>';
                }else{
                  html += '<div class="form-group">\
                    <label>'+common.replace(/_/g , " ").replace(/\b\w/g, l => l.toUpperCase())+'</label><input type="text" maxlength="100" placeholder="" name="'+common+'" id="'+common+'" class="form-control">\
                  </div>';  
                }
                
              }
            });
            $('#upload-manually').html(html);
            template_field.forEach(function(field){
              static_csv_field.push(field['title']);
              static_csv_html.push(field['html_label']);
              if(field['type']=="Text"){
                template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input type="text" maxlength="50" placeholder="" name="'+field["title"]+'" id="'+field["title"]+'" class="form-control">\
                </div>';
              }else if(field['type']=="File"){
                template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+'</label>\
                    <input class="form-control upload-file" type="file" id="uploadImgfile" />\
                    <div class="msgUpload"></div>\
                    <input type="hidden" id="'+field["title"]+'" name="'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnImgUpload" imgTarget="'+field["title"]+'" value="Upload" />\
                </div>';
              }else if(field['type']=="Color Picker"){
                template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input name="'+field["title"]+'" id="'+field["title"]+'" type="color" value="#1F1F1F"/>\
                </div>';
              }
            });
            $('#upload-manually').append(template_html);
          }
        }
      });
    }
    $("#wizard").steps({
      enableCancelButton: false,
      //enablePagination: true,
      enableFinishButton: true,  
      onStepChanging: function (event, currentIndex, newIndex) {
        if(currentIndex==0 && !$('#projecttitle').val()){
          $('#projecttitle').focus();
          return false;
        }else if(newIndex==2){
          if(!$("#choosed_template").val()){
            alert("Please Choose Template Video!");
            return false;
          }else{
            return true;  
          }
        }else if(currentIndex==2){
          $('a[href="#finish"]').css('display', 'none');
          if($('.create_video-step3-1').is(':visible')){
            $('#youtubepreview').remove();
            $('#youtubepreview2').remove();
            return true;
          }else{
            $('#youtubepreview').remove();
            $('#youtubepreview2').remove();
            $('.create_video-step3-1').fadeIn();
            $('.create_video-step3-2').fadeOut();
            $('.create_video-step3-3').fadeOut();
            return false;
          }
        }else{
          return true;
        }
      },
      onStepChanged: function(event, currentIndex, newIndex){
        if(currentIndex==2){
          //$('a[href="#finish"]').css('display', 'block');
        }else{
          //$('a[href="#finish"]').css('display', 'none');
        }
      },
      onFinishing: function(event, currentIndex) {
        return true;
      },
      onFinished: function(event, currentIndex) {
        if($('.create_video-step3-2').is(':visible')){
          if(!$("#directDownload").is(':checked')){
            if(!$("#customer_first_name").val() || !$("#customer_last_name").val() || !$("#customer_email").val() || !$("#sender_name").val() || !$("#sender_email").val()){
              $(window).scrollTop(0);
              $('.manual-field-error').html('<strong>Please input correct info! </strong>');
              $('.manual-field-error').show();
              setTimeout(function(){ 
                $('.manual-field-error').html('');
                $('.manual-field-error').hide(); 
              }, 6000);
              return false;
            }else{
              var manualformData = $("#upload-manually").serialize();
              $.ajax({
                url: "create_videos/render",
                type: 'post',
                dataType: "json",
                data: manualformData,
                success: function (data)
                {
                  if(data.success=="success"){
                    location.href = "{{URL::to('my_videos')}}";
                  }else if(data.success=="failed"){
                    $(window).scrollTop(0);
                    var errorHtml = '';
                    if(typeof(data.errors) == "object"){
                      var error = data.errors;
                      for(var i in data.errors){
                        for(var j in data.errors[i]){
                          errorHtml += '<strong>'+data.errors[i][j]+'</strong><br>';   
                        }
                      }
                      $('.manual-field-error').html(errorHtml);
                      $('.manual-field-error').show();
                    }else{
                      $('.manual-field-error').html('<strong>'+data.errors+'</strong>');
                      $('.manual-field-error').show();  
                    }
                    setTimeout(function(){ 
                      $('.manual-field-error').html('');
                      $('.manual-field-error').hide(); 
                    }, 6000);
                  }
                }
              });
            }
          }else{
            var manualformData = $("#upload-manually").serialize();
            $.ajax({
              url: "create_videos/render",
              type: 'post',
              dataType: "json",
              data: manualformData,
              success: function (data)
              {
                if(data.success=="success"){
                  location.href = "{{URL::to('my_videos')}}";
                }else if(data.success=="failed"){
                  $(window).scrollTop(0);
                  var errorHtml = '';
                  if(typeof(data.errors) == "object"){
                    var error = data.errors;
                    for(var i in data.errors){
                      for(var j in data.errors[i]){
                        errorHtml += '<strong>'+data.errors[i][j]+'</strong><br>';   
                      }
                    }
                    $('.manual-field-error').html(errorHtml);
                    $('.manual-field-error').show();
                  }else{
                    $('.manual-field-error').html('<strong>'+data.errors+'</strong>');
                    $('.manual-field-error').show();  
                  }
                  setTimeout(function(){ 
                    $('.manual-field-error').html('');
                    $('.manual-field-error').hide(); 
                  }, 6000);
                }
              }
            });
          }
        }else{
          var uploadCsvFile = $('#create_video-inpute-file').val();
          if (uploadCsvFile == '') {
              alert('Please select file');
              return;
          }
          var editableData;
          editableData = getEditableTableData();
          if(!$('#csv_sender_name').val() || !$('#csv_sender_email').val() || !editableData.length){
            $(window).scrollTop(0);
            $('.csv-field-error').html('<strong>Please input correct info! </strong>');
            $('.csv-field-error').show();
            setTimeout(function(){ 
              $('.csv-field-error').html('');
              $('.csv-field-error').hide(); 
            }, 6000);
            return;
          }
          var formData = new FormData();
          formData.append('mapped_data', JSON.stringify(editableData));
          formData.append('project_title', $("#projecttitle").val());
          formData.append('sender_email', $("#csv_sender_email").val());
          formData.append('email_subject', $("#csv_email_subject").val());
          formData.append('sender_name', $("#csv_sender_name").val());
          formData.append('template_video_id', $("#template_video_id").val());
          $.ajax({
            url: "create_videos/render-from-file",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            type: "POST",
            success: function (data)
            {
              console.log(data);
              if(data.success=="success"){
                location.href = "{{URL::to('my_videos')}}";
              }else if(data.success=="failed"){
                $(window).scrollTop(0);
                var errorHtml = '';
                if(typeof(data.errors) == "object"){
                  var error = data.errors;
                  for(var i in data.errors){
                    for(var j in data.errors[i]){
                      errorHtml += '<strong>'+data.errors[i][j]+'</strong><br>';   
                    }
                  }
                  $('.csv-field-error').html(errorHtml);
                  $('.csv-field-error').show();
                }else{
                  $('.csv-field-error').html('<strong>'+data.errors+'</strong>');
                  $('.csv-field-error').show();  
                }
                setTimeout(function(){ 
                  $('.csv-field-error').html('');
                  $('.csv-field-error').hide(); 
                }, 6000);
              }
            }
          });
        }
      },
    });
    $('a[href="#finish"]').css('display', 'none');
    $("#videotemplateModal").on('hidden.bs.modal', function (e) {
        $("#videotemplateModal iframe").attr("src", "");
    });
    $('.preview-video-template').click(function(){
      var url = $(this).attr('video-url');
      var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
      if(videoid[1]){
       var inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
        $('#videotemplateModal .modal-body').html(inject_contents);
        $("#videotemplateModal").modal('show'); 
      }
    });
    $('div.choose-template').click(function(){
      var choosedtemplate = $(this).attr('template-type');
      var choosedtemplateurl = $(this).attr('template-url');
      var chooseedtemplategroup = $(this).attr('template-group');
      var template_video_id = $(this).attr('template-video-id');
      $('.template-selected').remove();
      $(this).parent().append('<span class="template-selected">Selected</span>');
      $('#choosed_template').val(choosedtemplate);
      $('#choosed_template_url').val(choosedtemplateurl);
      $('#choosed_template_group').val(chooseedtemplategroup);
      $('#template_video_id').val(template_video_id);
      if(chooseedtemplategroup){
        getTemplate(chooseedtemplategroup);
      }
    });
    
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
    function searchPage(){
      var selected_category = [];
      $(".file-manager .i-checks").each(function(){
        if($(this).iCheck('update')[0].checked){
          selected_category.push($(this).iCheck('update')[0].value);
        }
      });
      var searchkey = $("#template_search_keyword").val(); 
      var sort = $("#sorttemplate").val();
      var formData = new FormData();
      formData.append('searchkey', searchkey);
      formData.append('sort', sort);
      formData.append('category', selected_category);
      $.ajax({
        url: "create_videos/search",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "html",
        type: "POST",
        success: function (data)
        {
          $('.new-table-content').html(data);
          $("#videotemplateModal").on('hidden.bs.modal', function (e) {
              $("#videotemplateModal iframe").attr("src", "");
          });
          $('.preview-video-template').click(function(){
            var url = $(this).attr('video-url');
            var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            if(videoid[1]){
             var inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
              $('#videotemplateModal .modal-body').html(inject_contents);
              $("#videotemplateModal").modal('show'); 
            }
          });
          $('div.choose-template').click(function(){
            var choosedtemplate = $(this).attr('template-type');
            var choosedtemplateurl = $(this).attr('template-url');
            var chooseedtemplategroup = $(this).attr('template-group');
            var template_video_id = $(this).attr('template-video-id');
            $('.template-selected').remove();
            $(this).parent().append('<span class="template-selected">Selected</span>');
            $('#choosed_template').val(choosedtemplate);
            $('#choosed_template_url').val(choosedtemplateurl);
            $('#choosed_template_group').val(chooseedtemplategroup);
            $('#template_video_id').val(template_video_id);
            if(chooseedtemplategroup){
              getTemplate(chooseedtemplategroup);
            }
          });
        }
      });
    }
    $('#sorttemplate').change(function(){
      searchPage();
    });
    $('.file-manager .i-checks').on('ifChanged', function(event) {
      searchPage();
    });
    $("#gotemplatesearch").click(function(){
      searchPage();
    });
    function ValidateFile(image)
    {
      if(image!='')
      {
       var checkimg = image.name.toLowerCase();
        if (!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)){ // validation of file extension using regular expression before file upload
            //document.getElementById("uploadImgfile").focus();
            alert("Wrong file selected");
            //document.getElementById("errorName5").innerHTML="Wrong file selected"; 
            return false;
         }
        if(image.size >=  1048576*10)  // validation according to file size
        {
            alert("Image size too long");
            return false;
         }
         return true;
      }
    }  
    function checkfile(sender) {
      var validExts = new Array(".xlsx", ".xls", ".csv");
      var fileExt = sender.substr( sender.lastIndexOf('.') );
      if (validExts.indexOf(fileExt) < 0) {
        alert("Invalid file selected, valid files are of " +
                 validExts.toString() + " types.");
        $('#create_video-inpute-file').val('');
        $('#create_video-inpute-file-text').val('');
        return false;
      }
      else {
        return true;
      }
    }
    // Step 3 selection
    $('.btn-create_video-step-3-selection').click (function(event){
      event.preventDefault();
      $('.create_video-step3-1').hide();
      var choosedtemplateurl = $('#choosed_template_url').val();
      var videoid = choosedtemplateurl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
      if($("input[name='rd-step3']:checked").val() == "step3-1"){
        if(videoid[1]){
          $("#create_video_previewbox").append("<iframe width='100%' height='100%' id='youtubepreview' frameborder='0' src='https://www.youtube.com/embed/"+videoid[1]+"?modestbranding=1&controls=0&showinfo=0&rel=0&autoplay=1' frameborder='0' allowfullscreen></iframe>");  
        }
        $('.create_video-step3-2').fadeIn();
        $('a[href="#finish"]').css('display', 'block');
      }else{
        if(videoid[1]){
          $("#create_video_previewbox2").append("<iframe width='100%' height='100%' id='youtubepreview2' frameborder='0' src='https://www.youtube.com/embed/"+videoid[1]+"?modestbranding=1&controls=0&showinfo=0&rel=0&autoplay=1' frameborder='0' allowfullscreen></iframe>");  
        }
        $('.create_video-step3-3').fadeIn();
      }
    });
    $(document).on("click", ".btnImgUpload", function() {
      var uploadImgfilepath = $(this).parent().children("input:file").val();
      var uploadImgfile = $(this).parent().children("input:file")[0].files[0];
      if ( uploadImgfilepath == '') {
          alert('Please select image to upload.');
          return;
      }
      if(ValidateFile(uploadImgfile)){
        var formData = new FormData();
        formData.append('uploadImgfile', uploadImgfile);
        formData.append('imgTarget', $(this).attr('imgTarget'));
        $(this).attr('disabled', 'disabled');
        $.ajax({
            url: 'create_videos/upload',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            type: 'POST',
            success: function (data) {
              if(data.success=="success"){
                $('#'+data.imgTarget).parent().find('.msgUpload').text("Image successfully uploaded to bucket.("+data.imgUrl+")");
                $('#'+data.imgTarget).parent().find('.btnImgUpload').removeAttr('disabled');
                $('#'+data.imgTarget).val(data.imgUrl);
              }else{
                $('#'+data.imgTarget).parent().find('.msgUpload').text("Something's wrong. Please try to again upload.");
                $('#'+data.imgTarget).parent().find('.btnImgUpload').removeAttr('disabled');
              }
            }
        });
      }
    });
    
    $("body").on("click", ".load-logo", function() {
      var url = $(this).data('url'); 
      var id = $(this).parent().parent().attr('id');
      console.log($(this).data('url'));
      console.log($(this).parent().parent().attr('id'));
      var formData = new FormData();
      formData.append('url', url);
      formData.append('id', id);
      $('#loadingImg').show();
      $("#imgModal .modal-body table").html('');
      $("#imgModal").modal('show');
      $.ajax({
        url: "create_videos/imgtourl",
        processData: false,
        contentType: false,
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data)
        {
          $('#loadingImg').hide();
          console.log(data); 
          var modalHtml = '';
          if(data.result_image.length){
            for (var i=0; i<Math.ceil(data.result_image.length/4); i++){
              modalHtml += '<tr>';
              for(var j=0; j<4; j++ ){
                if(typeof(data.result_image[i*4+j])!="undefined"){
                  modalHtml += '<td><div class="gallery" data-id="'+data['id']+'"><img src="'+data.result_image[i*4+j]+'" /></div></td>';
                }
              }
              modalHtml += '</tr>';
            }
            $('#imgModal .modal-body table').append(modalHtml);
          }else{
            $('#loadingImg').hide();
            modalHtml = "There is no matching images for logo."
            $('#imgModal .modal-body table').append(modalHtml);
          }

        }
      });
    });
    $("body").on("click","#directDownload", function(){
      if(!$(this).is(':checked')){
        $(this).val("unchecked");
        $('#sender_name').parent().show();
        $('#sender_email').parent().show();
        $('#email_subject').parent().show();
      }else{
        $(this).val("checked");
        $('#sender_name').parent().hide();
        $('#sender_email').parent().hide();
        $('#email_subject').parent().hide();
      }
    });
    $("body").on("click", ".gallery", function(index) {
      if($(this).data('id')){
        var img = $(this).find('img').attr('src');
        var id = $(this).data('id');
        var rowIndex;
        $('table.testgrid tbody tr').each(function(row){
          console.log($(this).attr('id'));
          if($(this).attr('id')==id){
            rowIndex = row;
          }
        });
        $("#"+id).find('td').each(function(index){
          if($(this).hasClass("editablegrid-logo") || $(this).hasClass("editablegrid-endlogo")){
            editableGrid.setValueAt(rowIndex,index,img,true);
          }
        });
        $("#imgModal").modal('hide');
      }
    });
    function addGridTable(mappingData){
      var metadata = [];
      for(var i=0; i<static_csv_field.length; i++){
        metadata.push({ name: static_csv_field[i], label: static_csv_html[i], datatype: "string", editable: true});
      }
      if(loadImageStatus){
        metadata.push({name:"action", larbel:"ACTION",datatype:"html"});  
      }
      
      csv_mapped_data = [];
      var row = [];
      for(var k in static_csv_field) {
        row[k] = "";
      }
      for(var i = 0; i < mapped_data[0].dataarray.length; i++) {
        csv_mapped_data[i] = {
          id: i + 1,
          values: {}
        };
        var temp = row;
        for(var k in static_csv_field) {
          if (mapped_data[k]){
            temp[parseInt(mapped_data[k].key)] = mapped_data[k].dataarray[i];

          }
        }
        for(var k in static_csv_field) {
          csv_mapped_data[i].values[static_csv_field[k]] = temp[k];
        }
      }
      if(loadImageStatus){
        for(var i in mapped_data){
          if(mapped_data[i].key=="action"){
            //
            for(var j in mapped_data[i].dataarray){
              if(mapped_data[i].dataarray[j]){
                csv_mapped_data[j].values["action"] = '<input type="button" class="load-logo btn btn-sm btn-primary" data-url="'+mapped_data[i].dataarray[j]+'" value="Load Logo">';
              }
            }
          }
        }  
      }

      console.log(csv_mapped_data);

      editableGrid = new EditableGrid("DemoGridJsData");
      editableGrid.load({"metadata": metadata, "data": csv_mapped_data});
      editableGrid.renderGrid("csv-display", "testgrid table table-bordered table-hover table-striped");
      $('#csv-display').removeClass('hide');
    }
    function getEditableTableData(){
      var result = [];
      for(var i in editableGrid.data){
        result[i] = {};
        for(var k in static_csv_field) {
          result[i][static_csv_field[k]] = editableGrid.data[i].columns[k];
        }
      }
      return result;
    }
    var loadImageStatus = false;
    function addMappingTable(data){
      var csv_html = '';
      loadImageStatus = false;
      $.each(data, function( index, row ) {
        csv_html += '<div class="row"><div class="col-md-8"><table class="csv-mapping-table table table-bordered table-hover">';
        csv_html += '<thead><tr><th>'+row['orgheader']+'</th></tr></thead><tbody>'
        if(row['orgheader'].trim().toLowerCase().indexOf("website url") != -1) loadImageStatus = true;
        var col_html = '';
        $.each(row['data'], function(rowIndex, colData){
          if(rowIndex==0) col_html += '<tr><td class="fix-word">'+colData+'</td></tr>';
          else col_html += '<tr class="hide"><td class="fix-word">'+colData+'</td></tr>';
        });
        //col_html += '<tr><td class="fix-word">'+row['data'][0]+'</td></tr>';
        csv_html += col_html;
        var options_html = "";
        var selected_option = "8";
        var selected_status_exist = false;
        $.each(static_csv_field, function( belongIndex, belongRow ) {
          var selected_status = '';
          if(row['header'] == belongRow){
            selected_status = 'selected';
            selected_option = belongIndex;
          }
          options_html += '<option '+ selected_status +' value=' +belongIndex+ '>' + belongRow + '</option>';
        });
        if($.inArray( row['header'], static_csv_field )==-1){
          options_html += '<option selected value="8">Nothing(skip)</option>';
        }else{
          options_html += '<option value="8">Nothing(skip)</option>';
        }
        csv_html += '</tbody></table></div><div class="col-md-4"><div class="belongs"><label for="selectbox">Belongs to</label><select class="select-csv-mapping form-control" data-org="' + selected_option + '">';
        csv_html += options_html;
        csv_html += '</select></div></div></div>';
      });
      $('#csv_mapping').append(csv_html);
      $('#csv_mapping').append('<input type="button" id="startmapping" class="btn btn-primary" value="Save Mapping" />');
    }
    
    $("body").on("change", ".select-csv-mapping", function() {
      var selbox = $(this),
        selected = selbox.val(),
        org = selbox.data("org");
      if(selected!="8"){
        $("#csv_mapping").find(".select-csv-mapping").each(function() {
          if($(this).val() == selected){
            $(this).val(org);
            selbox.data("org", selected);
          }
        });
        selbox.val(selected);  
      }else{
        selbox.data("org", 8);
      }
    });
    
    var mapped_data = [];
    $("body").on("click", "#startmapping", function() {
      mapped_data = [];
      $("#csv_mapping").find("table.csv-mapping-table").each(function(key, value) {
        var current_mapping = $(this);
        var mapping_status = $(this).parent().parent().find(".select-csv-mapping")[0];
        if(mapping_status.value != "8"){
          mapped_data.push({
            key:  mapping_status.value,
            dataarray: []
          });
          current_mapping.find("td.fix-word").each(function(index, value){
            mapped_data[mapped_data.length - 1].dataarray.push($(this).html());
          });
        }
        //console.log($(this).find('th').text());
        $(this).find('th').each(function(thkey, thvalue){
          var current_th = $(this);
          if(current_th.text().trim().toLowerCase().indexOf("website url") != -1){
            mapped_data.push({
              key:  "action",
              dataarray: []
            });
            current_th.parent().parent().parent().find("td.fix-word").each(function(index, value){
              mapped_data[mapped_data.length - 1].dataarray.push($(this).html());
            });
          }
        });
      });
      
      var status_check = 0;

      if(mapped_data.length){
        for(var i=0; i < mapped_data.length; i++){
          if(mapped_data[i]['key']=="0" || mapped_data[i]['key']=="1" || mapped_data[i]['key']=="2") {
            status_check ++;
          }
        }
        if(status_check!=3){
          alert('<Customer First Name> and <Customer Last Name> and <Customer Email> fields can not be empty!');
        }else{
          addGridTable(mapped_data);
          $('a[href="#finish"]').css('display', 'block');  
        }
      }else{
        alert("Please map csv data!");
      }
    });

    function generateHtmlTable(data) {
      var headerData = [];
      var html = '';
      var col = 0;
      var maxCol = 51;
      if(typeof(data[0]) === 'undefined') {
        return null;
      } else {
        var classIndex = [1,3,3,3,1,1,2];
        $.each(data, function( index, row ) {
          //bind header
          if(index == 0) {
            $.each(row, function( index, colData ) {
              var header = "";
              if(colData.toLowerCase().indexOf("first")!=-1 && colData.toLowerCase().indexOf("name")!=-1){
                header = "customer_first_name";
              }
              if(colData.toLowerCase().indexOf("last")!=-1 && colData.toLowerCase().indexOf("name")!=-1){
                header = "customer_last_name";
              }
              if(colData.toLowerCase().indexOf("email")!=-1){
                header = "customer_email";
              }
              if(header == "") header = colData;
              headerData.push({
                  orgheader : colData,
                  header:  header,
                  data: []
              });
            });
          } else {
            col++;
            if(col < maxCol){
              $.each(row, function( itemindex, colData ) {
                headerData[itemindex].data.push(colData);
              });  
            }
          }
        });
        if(headerData.length){
          addMappingTable(headerData);
        }
        $('.text-success').text('File format is OK. '+col+' data rows parsed successfully.');
        $('.text-success').removeClass('hide');
      }
    } 
    $('#create_video-inpute-file').change(function(){
      $('#csv_content_table tbody').html('');
      $('#csv_mapping').html('');
      if(checkfile($('#create_video-inpute-file')[0].files[0].name)){
        $('#create_video-inpute-file-text').val($('#create_video-inpute-file')[0].files[0].name);
        var file = $('#create_video-inpute-file')[0].files[0]; // The file
        fr = new FileReader(); // FileReader instance
        fr.onload = function () {
          data = $.csv.toArrays(fr.result);
          generateHtmlTable(data);
        };
        fr.readAsText( file );
      }
    });
  });
</script>