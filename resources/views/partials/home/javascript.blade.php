
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
  $('#myTable tbody tr').each( function() {
    var sTitle;
    var nTds = $('td', this);
    var svideoid = $(nTds[6]).text();
    this.setAttribute( 'title', svideoid );
  });
	var myTable = $('#myTable').DataTable( {
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
  myTable.$('tr').tooltip( {
    "delay": 0,
    "track": true,
    "fade": 250
  });
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
  $('#myTable2 tbody tr').each( function() {
    var sTitle;
    var nTds = $('td', this);
    var svideoid = $(nTds[7]).text();
    this.setAttribute( 'title', svideoid );
  });
  
  var myTable2 = $('#myTable2').DataTable( {
    "order": [[ 3, "desc" ]],
    "dom": '<"top"lf>rt<"bottom"ip><"clear">',
    language: {
      searchPlaceholder: "",
      "paginate": {
        "previous": '<i class="fa fa-chevron-left"></i>',
        "next": '<i class="fa fa-chevron-right"></i>'
      },
      sSearch: "Search"
    }
  });

  myTable2.$('tr').tooltip( {
    "delay": 0,
    "track": true,
    "fade": 250
  });
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
              $('#html5_video')[0].pause();
          });
          $('.preview-video-template').click(function(){
            var url = $(this).attr('video-url');
            var videoid;
            var inject_contents;
            if(url.indexOf("youtube")!=-1){
              videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);    
              if(videoid[1]){
                inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>';
              }
            }else{
              inject_contents = '<video id="html5_video" controls style="width: 100%; height: auto; margin:0 auto; frameborder:0;">\
                <source src="'+url+'" >\
              </video>';
            }
            $('#videotemplateModal .modal-body').html(inject_contents);
            $("#videotemplateModal").modal('show');  
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
    var emailtemplates;
    var csv_outro_field_name = '';
    var csv_outro_field_value = '';
    var defaultcsvOutroStr = 'Please \r\nContact \r\nUs \r\nNow \r\nCompany Name/ Your Name \r\nwww.YOURAgencyDomain.com / YourEmailHere@Email.com';
    var default_email_template = '';
    var default_csvemail_template = '';
    function getTemplate(id){
      $.ajax({
        url: "template/"+id,
        type: 'GET',
        dataType: "json",
        success: function (data)
        {
          if(data['project'] && data['template_field'].length){
            static_csv_field = ['customer_first_name','customer_last_name','customer_email', 'customer_domain'];
            static_csv_html = ['Customer First Name', 'Customer Last Name', 'Customer Email', 'Customer Domain'];
            mapped_data = [];
            $('#csv_mapping').html('');
            $('#csv_ext_field').html('');
            $('#csv_outro_field').html('');
            $('#csv_content_table tbody').html('');
            $('#csv_content_table thead').html('');
            $('#csv-display').addClass('hide');
            //$('a#startmapping').parent().remove();
            $('a#startmapping').hide();
            $('#create_video-inpute-file').val();
            //$('#defaultcsv').prop('checked', true);
            var template_field = data['template_field'];
            var common_field = data['common_field'];
            emailtemplates = data['emailtemplates'];
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
            var csv_template_html = '';
            var csv_template_commonhtml = '';
            var csv_outro_html = '';
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
                }else if(common=="email_body"){
                  html += '<div class="form-group">\
                    <label for="email_body">Email Message:</label>\
                    <textarea class="email-template-area form-control" rows="5" name="'+common+'" id="'+common+'"></textarea>\
                  </div>';
                }else if(common=="email_subject"){
                  html += '<div class="form-group">\
                    <label for="email_template">Email Template:</label>\
                    <select class="form-control select-email-template" id="email_template">\
                      <option value="">Select one...</option>';
                      emailtemplates.forEach(function(emailtemplate){
                        html+='<option data-id = "'+emailtemplate['id']+'">'+emailtemplate['name']+'</option>';
                      });
                    html+='</select></div>';
                    html += '<div class="form-group">\
                    <label>Email Subject:</label><input type="text" maxlength="100" placeholder="" name="'+common+'" id="'+common+'" class="form-control">\
                    </div>';
                }else{
                  html += '<div class="form-group">\
                    <label>'+common.replace(/_/g , " ").replace(/\b\w/g, l => l.toUpperCase())+'</label><input type="text" maxlength="100" placeholder="" name="'+common+'" id="'+common+'" class="form-control">\
                  </div>';  
                }
              }
            });
            $('#upload-manually').html(html);
            static_csv_field.forEach(function(commonfield, key){
              csv_template_commonhtml += '<div class="form-group hide">\
                  <label>'+static_csv_html[key]+'</label><input type="text" maxlength="100" placeholder="" name="csv_'+commonfield+'" id="csv_'+commonfield+'" class="form-control">\
                </div>';
            });
            $('#csv_ext_field').append(csv_template_commonhtml);
            template_field.forEach(function(field){
              if(field['type']!="Outro"){
                static_csv_field.push(field['title']);
                static_csv_html.push(field['html_label']);  
              }
              if(field['type']=="Text"){
                template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input type="text" maxlength="50" placeholder="" name="'+field["title"]+'" id="'+field["title"]+'" class="form-control" value="'+(field['default_value'] ? field['default_value']: "")+'">\
                </div>';
                csv_template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input type="text" maxlength="50" placeholder="" name="csv_'+field["title"]+'" id="csv_'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" class="form-control">\
                </div>';
              }else if(field['type']=="File"){
                template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+'</label>\
                    <input class="form-control upload-file" type="file" id="uploadImgfile" style="display:none;"/>\
                    <div class="msgUpload"></div>\
                    <input type="hidden" id="'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnImgUpload" imgTarget="'+field["title"]+'" value="Upload" />\
                </div>';
                csv_template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+' Image</label>\
                    <input class="form-control upload-file" type="file" id="uploadImgfile" style="display:none;"/>\
                    <div class="msgUpload"></div>\
                    <input type="hidden" id="csv_'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="csv_'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnImgUpload" imgTarget="csv_'+field["title"]+'" value="Upload" />\
                </div>';
              }else if(field['type']=="File Video"){
                template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+' Video</label>\
                    <input class="form-control upload-file" type="file" id="uploadVideofile" style="display:none;"/>\
                    <div class="msgUploadVideo"></div>\
                    <input type="hidden" id="'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnVideoUpload" videoTarget="'+field["title"]+'" value="Upload" />\
                </div>';
                csv_template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+' Video</label>\
                    <input class="form-control upload-file" type="file" id="csvuploadVideofile" style="display:none;"/>\
                    <div class="msgUploadVideo"></div>\
                    <input type="text" class="form-control" id="csv_'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="csv_'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnVideoUpload" videoTarget="csv_'+field["title"]+'" value="Upload" />\
                </div>';
              }else if(field['type']=="File Music"){
                template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+' Music</label>\
                    <input class="form-control upload-file" type="file" id="uploadMusicfile" style="display:none;"/>\
                    <div class="msgUploadMusic"></div>\
                    <input type="hidden" id="'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnMusicUpload" musicTarget="'+field["title"]+'" value="Upload" />\
                </div>';
                csv_template_html += '<div class="form-group">\
                    <label>Upload '+field["html_label"]+' Music</label>\
                    <input class="form-control upload-file" type="file" id="uploadMusicfile" style="display:none;"/>\
                    <div class="msgUploadMusic"></div>\
                    <input type="hidden" id="csv_'+field["title"]+'" value="'+(field['default_value'] ? field['default_value']: "")+'" name="csv_'+field["title"]+'" />\
                    <input type="button" class="btn btn-primary btnMusicUpload" musicTarget="csv_'+field["title"]+'" value="Upload" />\
                </div>';
              }else if(field['type']=="Outro"){
                template_html += '<div class="form-group">\
                    <label for="'+field["title"]+'">'+field["html_label"]+'</label>\
                    <textarea id="outroArea" class="form-control" rows="6" name="'+field["title"]+'"></textarea>\
                  </div>';
                csv_outro_html += '<div class="form-group">\
                    <label for="'+field["title"]+'">'+field["html_label"]+'</label>\
                    <textarea id="csvoutroArea" class="form-control" rows="6" name="csv_'+field["title"]+'"></textarea>\
                  </div>';
              }else if(field['type']=="Color Picker"){
                template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input name="'+field["title"]+'" id="'+field["title"]+'" type="color" value="#1F1F1F"/>\
                </div>';
                csv_template_html += '<div class="form-group">\
                  <label>'+field["html_label"]+'</label><input name="csv_'+field["title"]+'" id="csv_'+field["title"]+'" type="color" value="#1F1F1F">\
                </div>';
              }
            });
            $('#upload-manually').append(template_html);
            $('#csv_ext_field').append(csv_template_html);
            $('#csv_outro_field').append(csv_outro_html);
            $('#outroArea').html(defaultcsvOutroStr);
            $('#csvoutroArea').html(defaultcsvOutroStr);
          }
        }
      });
    }
    function checkOutroChanges(val){
      if(val.indexOf("www.YOURAgencyDomain.com")==-1 && val.indexOf("YourEmailHere@Email.com")==-1){
        return true;
      }else return false;
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
            /*$('a[href="#next"]').parent().removeClass("disabled");
            $('a[href="#next"]').css('display', 'block');  
            $('a[href="#next"]').parent().css('display', 'block');  
            $('a[href="#next"]').addClass("btn-create_video-step-3-selection");*/
            
            return true;
          }
        }else if(currentIndex==2){
          $('a[href="#finish"]').css('display', 'none');
          if($('.create_video-step3-1').is(':visible')){
            $('#youtubepreview').remove();
            $('#youtubepreview2').remove();
            $(".btn-create_video-step-3-selection").hide();
            $("#startmapping").hide();
            return true;
          }else if($('.create_video-step3-4').is(':visible')){
            $('.create_video-step3-1').hide();
            $('.create_video-step3-2').hide();
            $('.create_video-step3-3').show();
            $('.create_video-step3-4').hide();
            $(".btn-create_video-step-3-selection").hide();
            $("#startmapping").show();
            return false;
          }else{
            $('#youtubepreview').remove();
            $('#youtubepreview2').remove();
            $(".btn-create_video-step-3-selection").show();
            $('.create_video-step3-1').show();
            $('.create_video-step3-2').hide();
            $('.create_video-step3-3').hide();
            $('.create_video-step3-4').hide();
            $("#startmapping").hide();
            return false;
          }
        }else{
          return true;
        }
      },
      onStepChanged: function(event, currentIndex, newIndex){
        if(currentIndex==2){
          if($('.create_video-step3-1').is(':visible')){
            if($(".btn-create_video-step-3-selection").length){
              $(".btn-create_video-step-3-selection").show();
            }else{
              var $customizeBtn = $('<li><a href="#" style="display:none;" class="btn-create_video-step-3-selection" role="menuitem">Next</a></li>');
              $customizeBtn.appendTo($('ul[aria-label=Pagination]'));
              $(".btn-create_video-step-3-selection").show();
            }
          }else{
            $(".btn-create_video-step-3-selection").hide();
          }
        }else{
          //$(".btn-create_video-step-3-selection").remove();
        }
      },
      onFinishing: function(event, currentIndex) {
        return true;
      },
      onFinished: function(event, currentIndex) {
        if($('.create_video-step3-2').is(':visible')){
          if($("#outroArea").length){
            if(!checkOutroChanges($("#outroArea").val())){
              alert("Please Change Outro Info first.");
              return false;
            }
          }
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
              if($('#email_body').val()==default_email_template){
                alert('Please Change Email Message first.');
                $(window).scrollTop(0);
                return false;
              }
              var upload_attach_status = false;
              $("#upload-manually").find('input:file').each(function(){
                if ($(this).get(0).files.length != 0 && !$(this).siblings('input:hidden').val()) {
                  alert("Try again after complete upload files."); 
                  upload_attach_status = true;
                }             
              });
              if(upload_attach_status){
                return false;
              }
              if($('#uploadVideofile').length && !$('#uploadVideofile').siblings('input:hidden').val()){ 
                alert('Please try again after upload video file.');
                return false;
              }
              $("#upload-manually").find('input:text').each(function(){
                var temp_val = $(this).val();
                $(this).val(temp_val.replace(/\{first_name\}/g,$('#customer_first_name').val()).replace(/\{last_name\}/g,$('#customer_last_name').val()).replace(/\{email\}/g,$('#customer_email').val()));
              });
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
                          var temp_error_data = data.errors[i][j].replace("text01","Main Text").replace("text02","Additional Text").replace("text03","Final Text");
                          errorHtml += '<strong>'+temp_error_data+'</strong><br>';   
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
            var upload_attach_status = false;
            $("#upload-manually").find('input:file').each(function(){
              if ($(this).get(0).files.length != 0 && !$(this).siblings('input:hidden').val()) {
                alert("Try again after complete upload files."); 
                upload_attach_status = true;
              }             
            });
            if(upload_attach_status){
              return false;
            }
            if($('#uploadVideofile').length && !$('#uploadVideofile').siblings('input:hidden').val()){ 
              alert('Please try again after upload video file.');
              return false;
            }
            $("#upload-manually").find('input:text').each(function(){
              var temp_val = $(this).val();
              $(this).val(temp_val.replace(/\{first_name\}/g,$('#customer_first_name').val()).replace(/\{last_name\}/g,$('#customer_last_name').val()).replace(/\{email\}/g,$('#customer_email').val()));
            });
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
                        var temp_error_data = data.errors[i][j].replace("text01","Main Text").replace("text02","Additional Text").replace("text03","Final Text");
                          errorHtml += '<strong>'+temp_error_data+'</strong><br>';   
                        //errorHtml += '<strong>'+data.errors[i][j]+'</strong><br>';   
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
          if(editableData.length){
            for(var tempIndex in editableData){
              for (var tempKey in editableData[tempIndex]) {
                if (editableData[tempIndex].hasOwnProperty(tempKey)) {
                  editableData[tempIndex][tempKey] = editableData[tempIndex][tempKey].replace(/\{first_name\}/g,editableData[tempIndex]['customer_first_name']).replace(/\{last_name\}/g,editableData[tempIndex]['customer_last_name']).replace(/\{email\}/g,editableData[tempIndex]['customer_email_name']);
                }
              } 
            }
          }
          if(editableData.length && csv_outro_field_name){
            for(var k in editableData){
              editableData[k][csv_outro_field_name] = csv_outro_field_value;
            }
          }
          console.log(editableData);
          var formData = new FormData();
          formData.append('mapped_data', JSON.stringify(editableData));
          formData.append('project_title', $("#projecttitle").val());
          formData.append('sender_email', $("#csv_sender_email").val());
          formData.append('email_subject', $("#csv_email_subject").val());
          formData.append('email_body', $("#csv_email_body").val());
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
              if(data.success=="success"){
                location.href = "{{URL::to('my_videos')}}";
              }else if(data.success=="failed"){
                $(window).scrollTop(0);
                var errorHtml = '';
                if(typeof(data.errors) == "object"){
                  var error = data.errors;
                  for(var i in data.errors){
                    for(var j in data.errors[i]){
                      //errorHtml += '<strong>'+data.errors[i][j]+'</strong><br>';   
                      var temp_error_data = data.errors[i][j].replace("text01","Main Text").replace("text02","Additional Text").replace("text03","Final Text");
                          errorHtml += '<strong>'+temp_error_data+'</strong><br>';
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
    
    $('.create_video-step3-4').css('display', 'none');
    $("#videotemplateModal").on('hidden.bs.modal', function (e) {
        $("#videotemplateModal iframe").attr("src", "");
        $('#html5_video')[0].pause();
    });
    $('.preview-video-template').click(function(){
      var url = $(this).attr('video-url');
      var videoid;
      var inject_contents;
      if(url.indexOf("youtube")!=-1){
        videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);    
        if(videoid[1]){
          inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>';
        }
      }else{
        inject_contents = '<video id="html5_video" controls style="width: 100%; height: auto; margin:0 auto; frameborder:0;">\
          <source src="'+url+'" >\
        </video>';
      }
      $('#videotemplateModal .modal-body').html(inject_contents);
      $("#videotemplateModal").modal('show');
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
              $('#html5_video')[0].pause();
          });
          $('.preview-video-template').click(function(){
            var url = $(this).attr('video-url');
            var videoid;
            var inject_contents;
            if(url.indexOf("youtube")!=-1){
              videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);    
              if(videoid[1]){
                inject_contents = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+videoid[1]+'?modestbranding=1&controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>';
              }
            }else{
              inject_contents = '<video id="html5_video" controls style="width: 100%; height: auto; margin:0 auto; frameborder:0;">\
                <source src="'+url+'" >\
              </video>';
            }
            $('#videotemplateModal .modal-body').html(inject_contents);
            $("#videotemplateModal").modal('show');
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
    function ValidateVideoFile(video){
      if(video!='')
      {
       var checkimg = video.name.toLowerCase();
        if (!checkimg.match(/(\.webm|\.flv|\.mov|\.mpg|\.wmv|\.avi|\.mp4|\.mpg|\.3gp|\.m4v)$/)){ // validation of file extension using regular expression before file upload
            alert("Wrong file selected");
            return false;
         }
        if(video.size >=  1048576*100)  // validation according to file size
        {
            alert("Video size too long");
            return false;
         }
         return true;
      }
    }
    function ValidateMusicFile(music){
      if(music!='')
      {
       var checkimg = music.name.toLowerCase();
        if (!checkimg.match(/(\.mp3)$/)){ // validation of file extension using regular expression before file upload
            alert("Wrong file selected");
            return false;
         }
        if(music.size >=  1048576*10)  // validation according to file size
        {
            alert("Music size too long");
            return false;
         }
         return true;
      }
    }
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
    $("body").on("click", "a.btn-create_video-step-3-selection", function(event) {
      event.preventDefault();
      $('.create_video-step3-1').hide();
      var choosedtemplateurl = $('#choosed_template_url').val();
      var videoid;
      if($("input[name='rd-step3']:checked").val() == "step3-1"){
        if(choosedtemplateurl.indexOf("youtube")!=-1){
          videoid = choosedtemplateurl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);    
          if(videoid[1]){
            $("#create_video_previewbox").append("<iframe width='100%' height='100%' id='youtubepreview' frameborder='0' src='https://www.youtube.com/embed/"+videoid[1]+"?modestbranding=1&controls=0&showinfo=0&rel=0' frameborder='0' allowfullscreen></iframe>");  
          }
        }else{
          $("#create_video_previewbox").append('<video controls style="width:100%;height:100%;" id="youtubepreview2">\
            <source src="'+choosedtemplateurl+'" />\
          </video>');
        }
        $('.create_video-step3-2').show();
        $('a[href="#finish"]').css('display', 'block');
        $(this).hide();
      }else{
        if(choosedtemplateurl.indexOf("youtube")!=-1){
          videoid = choosedtemplateurl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);    
          if(videoid[1]){
            $("#create_video_previewbox2").append("<iframe width='100%' height='100%' id='youtubepreview2' frameborder='0' src='https://www.youtube.com/embed/"+videoid[1]+"?modestbranding=1&controls=0&showinfo=0&rel=0' frameborder='0' allowfullscreen></iframe>");  
          }
        }else{
          $("#create_video_previewbox2").append('<video controls style="width:100%;height:100%;" id="youtubepreview2">\
            <source src="'+choosedtemplateurl+'" />\
          </video>');
        }
        $('.create_video-step3-3').show();
        if($("a#startmapping").length){
          $("a#startmapping").show();
        }
        $(this).hide();
      }
    });
    $(document).on("change", ".select-email-template", function() {
      if($(this).find(':selected').attr('data-id')){
        var id = $(this).find(':selected').attr('data-id');
        for(var i in emailtemplates){
          if(emailtemplates[i]['id']==id){
            $("#email_subject").val(emailtemplates[i]['email_subject']);
            $("#email_body").html(emailtemplates[i]['email_body']);
            default_email_template = $("#email_body").val();
          }
        }
      }
    });
    $(document).on("change", ".select-csv-email-template", function() {
      if($(this).find(':selected').attr('data-id')){
        var id = $(this).find(':selected').attr('data-id');
        for(var i in emailtemplates){
          if(emailtemplates[i]['id']==id){
            $("#csv_email_subject").val(emailtemplates[i]['email_subject']);
            $("#csv_email_body").html(emailtemplates[i]['email_body']);
            default_csvemail_template = $("#csv_email_body").val();
          }
        }
      }
    });
      $(document).on("change", ".uploadImgfile", function() {
          var uploadImgfilepath = $(this).parent().children("input:file").val();
          var uploadImgfile = $(this).parent().children("input:file")[0].files[0];
          if ( uploadImgfilepath == '') {
              alert('Please select image to upload.');
              return;
          }
          if(ValidateFile(uploadImgfile)){
              var formData = new FormData();
              var uploadButton = $(this);
              formData.append('uploadImgfile', uploadImgfile);
              formData.append('imgTarget', $(this).parent().find('.hotspotThumb').attr('name'));
              uploadButton.attr('disabled', 'disabled');
              $.ajax({
                  //url: 'create_videos/upload',
                  url: '{{url("create_videos/upload")}}',
                  data: formData,
                  processData: false,
                  contentType: false,
                  dataType: "json",
                  type: 'POST',
                  success: function (data) {
                      if(data.success=="success"){
                          uploadButton.parent().find('.thumb').html('<img src="'+data.imgUrl+'" style="width:100%" /><br><br>');
                          uploadButton.parent().find('.msgUpload').text("Image successfully uploaded to bucket.("+data.imgUrl+")");
                          uploadButton.removeAttr('disabled');
                          $('input[name="'+data.imgTarget+'"]').val(data.imgUrl);
                      }else{
                          uploadButton.parent().find('.msgUpload').text("Something's wrong. Please try to again upload.");
                          uploadButton.removeAttr('disabled');
                      }
                  },
                  error: function (data) {
                      uploadButton.parent().find('.msgUpload').text("Something's wrong. Server Response: "+data.statusText);
                      uploadButton.removeAttr('disabled');
                  }
              });
          }
      });
    $(document).on("click", ".btnImgUpload", function() {
      $(this).parent().children("input:file").click();
    });
    $(document).on("click", ".btnVideoUpload", function() {
      $(this).parent().children("input:file").click();
      
    });
    $(document).on("click", ".btnMusicUpload", function() {
      $(this).parent().children("input:file").click();
    });
    $(document).on("change", ".upload-file", function() {
      if($(this).parent().children("input:button").hasClass("btnImgUpload")){
        var uploadImgfilepath = $(this).val();
        var uploadImgfile = $(this)[0].files[0];
        if ( uploadImgfilepath == '') {
            alert('Please select image to upload.');
            return;
        }
        if(ValidateFile(uploadImgfile)){
          var formData = new FormData();
          formData.append('uploadImgfile', uploadImgfile);
          formData.append('imgTarget', $(this).parent().children("input:button").attr('imgTarget'));
          $(this).parent().children("input:button").attr('disabled', 'disabled');
          $.ajax({
              //url: 'create_videos/upload',
              url: '{{url("create_videos/upload")}}',
              //url: "{{ route('create_videos_upload') }}",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              type: 'POST',
              success: function (data) {
                if(data.success=="success"){
                  $('#'+data.imgTarget).parent().find('.msgUpload').text("Image successfully uploaded to bucket.");
                  $('#'+data.imgTarget).parent().find('.btnImgUpload').removeAttr('disabled');
                  $('#'+data.imgTarget).val(data.imgUrl);
                }else{
                  $('#'+data.imgTarget).parent().find('.msgUpload').text("Something's wrong. Please try to again upload.");
                  $('#'+data.imgTarget).parent().find('.btnImgUpload').removeAttr('disabled');
                }
              }
          });
        }
      }else if($(this).parent().children("input:button").hasClass("btnVideoUpload")){
        var uploadVideofilepath = $(this).val();
        var uploadVideofile = $(this)[0].files[0];
        if ( uploadVideofilepath == '') {
            alert('Please select video file to upload.');
            return;
        }
        if(ValidateVideoFile(uploadVideofile)){
          var formData = new FormData();
          formData.append('uploadVidoefile', uploadVideofile);
          formData.append('videoTarget', $(this).parent().children("input:button").attr('videoTarget'));
          $(this).parent().children("input:button").attr('disabled', 'disabled');
          $.ajax({
              url: '{{url("create_videos/uploadvideo")}}',
              //url: 'create_videos/uploadvideo',
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              type: 'POST',
              success: function (data) {
                if(data.success=="success"){
                  $('#'+data.videoTarget).parent().find('.msgUploadVideo').text("Video file successfully uploaded to bucket.");
                  $('#'+data.videoTarget).parent().find('.btnVideoUpload').removeAttr('disabled');
                  $('#'+data.videoTarget).val(data.videoUrl);
                }else{
                  $('#'+data.videoTarget).parent().find('.msgUploadVideo').text("Something's wrong. Please try to again upload.");
                  $('#'+data.videoTarget).parent().find('.btnVideoUpload').removeAttr('disabled');
                }
              }
          });
        }
      }else if($(this).parent().children("input:button").hasClass("btnMusicUpload")){
        var uploadMusicfilepath = $(this).val();
        var uploadMusicfile = $(this)[0].files[0];
        if ( uploadMusicfilepath == '') {
            alert('Please select video file to upload.');
            return;
        }
        if(ValidateMusicFile(uploadMusicfile)){
          var formData = new FormData();
          formData.append('uploadMusicfile', uploadMusicfile);
          formData.append('musicTarget', $(this).parent().children("input:button").attr('musicTarget'));
          $(this).parent().children("input:button").attr('disabled', 'disabled');
          $.ajax({
              url: '{{url("create_videos/uploadmusic")}}',
              //url: 'create_videos/uploadmusic',
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              type: 'POST',
              success: function (data) {
                if(data.success=="success"){
                  $('#'+data.musicTarget).parent().find('.msgUploadMusic').text("Music file successfully uploaded to bucket.");
                  $('#'+data.musicTarget).parent().find('.btnMusicUpload').removeAttr('disabled');
                  $('#'+data.musicTarget).val(data.musicUrl);
                }else{
                  $('#'+data.musicTarget).parent().find('.msgUploadMusic').text("Something's wrong. Please try to again upload.");
                  $('#'+data.musicTarget).parent().find('.btnMusicUpload').removeAttr('disabled');
                }
              }
          });
        }
      }
    });
    
    $("body").on("click", ".delete-logo", function() {
      var id = $(this).parent().parent().parent().attr('id').replace("DemoGridJsData_","");
      if(id){
        var result = confirm("Are you sure you want to delete this row?");
        if (result) {
          editableGrid.removeRow(id);      
        }
      }
    });
    $("body").on("click", ".load-logo", function() {
      $('#imgModal .modal-body #change_logo_field').html('');
      var choose_field = '';
      $.each( static_csv_field, function( key, value ) {
        if(value!="customer_first_name" && value!="customer_last_name" && value!="customer_email" && value!="customer_domain") choose_field += "<option value='"+value+"'>"+static_csv_html[key]+"</option>";
      });
      $('#imgModal .modal-body #change_logo_field').append(choose_field);
      var url = $(this).data('url'); 
      var id = $(this).parent().parent().parent().attr('id');
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
        $('.select-email-template').parent().show();
        $('#email_subject').parent().show();
        $('#email_body').parent().show();
      }else{
        $(this).val("checked");
        $('#sender_name').parent().hide();
        $('#sender_email').parent().hide();
        $('.select-email-template').parent().hide();
        $('#email_subject').parent().hide();
        $('#email_body').parent().hide();
      }
    });
    $("body").on("click", ".gallery", function(index) {
      var selected_field = $('#change_logo_field').val();
      if($(this).data('id')){
        var img = $(this).find('img').attr('src');
        var id = $(this).data('id');
        var rowIndex;
        $('table.testgrid tbody tr').each(function(row){
          if($(this).attr('id')==id){
            rowIndex = row;
          }
        });
        $("#"+id).find('td').each(function(tdindex){
          if($(this).hasClass("editablegrid-"+selected_field)){
            editableGrid.setValueAt(rowIndex,tdindex,img,true);
          }
        });
        $("#imgModal").modal('hide');
      }
    });
    $("body").on("click","#defaultcsv", function(){
      if($(this).is(':checked')){
        $('#csv_ext_field').removeClass('hide');
      }else{
        $('#csv_ext_field').addClass('hide');
      }
    });

    function addGridTable(mappingData){
      var metadata = [];
      for(var i=0; i<static_csv_field.length; i++){
        metadata.push({ name: static_csv_field[i], label: static_csv_html[i], datatype: "string", editable: true});
      }
      metadata.push({name:"action", larbel:"ACTION",datatype:"html"});  
      /*if(loadImageStatus){
        metadata.push({name:"action", larbel:"ACTION",datatype:"html"});  
      }*/
      
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
      for(var i in mapped_data){
        if(mapped_data[i].key=="action"){
          for(var j in mapped_data[i].dataarray){
            if(mapped_data[i].dataarray[j]){
                csv_mapped_data[j].values["action"] = '<div class="action-grid"><input type="button" class="load-logo btn btn-sm btn-primary" data-url="'+mapped_data[i].dataarray[j]+'" value="Load Logo"><input type="button" class="delete-logo btn btn-sm btn-primary" data-url="'+mapped_data[i].dataarray[j]+'" value="Delete"></div>';  
            }else{
              csv_mapped_data[j].values["action"] = '<div class="action-grid"><input type="button" class="delete-logo btn btn-sm btn-primary" data-url="'+mapped_data[i].dataarray[j]+'" value="Delete"></div>';
            }
          }
        }
      } 
      
      if($('#defaultcsv').is(':checked')){
        for(var i in csv_mapped_data){
          for(var j in csv_mapped_data[i].values){
            if(!csv_mapped_data[i].values[j]){
              //console.log(csv_mapped_data[i]);
              /*if($("#csv_"+j).val()){
                checkKeys($("#csv_"+j).val());
              }*/
              csv_mapped_data[i].values[j] = $("#csv_"+j).val();  
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
        csv_html += '<thead><tr><th style="border:0;">'+row['orgheader']+'</th></tr></thead><tbody>'
        if(row['orgheader'].trim().toLowerCase().indexOf("website 1") != -1 || row['orgheader'].trim().toLowerCase().indexOf("website url") != -1) loadImageStatus = true;
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
      //$('#csv_mapping').append('<input type="button" id="startmapping" class="btn btn-primary" value="Save Mapping" />');
      if($("#startmapping").length){
        $("#startmapping").show();
      }else{
        var $startmappingBtn = $('<li><a href="#" style="display:none;" id="startmapping" role="menuitem">Next</a></li>');
        $startmappingBtn.appendTo($('ul[aria-label=Pagination]'));  
        $("#startmapping").show();
      }
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
    $("body").on("click", "a#startmapping", function() {
      csv_outro_field_name = '';
      csv_outro_field_value = '';
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
        $(this).find('th').each(function(thkey, thvalue){
          var current_th = $(this);
          if(current_th.text().trim().toLowerCase().indexOf("website 1") != -1 || current_th.text().trim().toLowerCase().indexOf("website url") != -1){
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
      var mapped_data_status = false;
      for(var j in mapped_data){
        if(mapped_data[j]['key']=="action"){
          mapped_data_status = true;
        }
      }
      if(!mapped_data_status){
        mapped_data.push({
          key:  "action",
          dataarray: []
        });
        for(var k in mapped_data){
          if(mapped_data[k]['key']=="3"){
            for(var l in mapped_data[k]['dataarray']){
              mapped_data[mapped_data.length - 1].dataarray.push(mapped_data[k]['dataarray'][l]);
            }
          }
        }
      }
      if(mapped_data.length){
        console.log(mapped_data);
        for(var i=0; i < mapped_data.length; i++){
          if(mapped_data[i]['key']=="0" || mapped_data[i]['key']=="1" || mapped_data[i]['key']=="2") {
            status_check ++;
          }
        }
        var csv_uploadfile_status = false;
        $("#csv_ext_field").find('input:file').each(function(){
          if($(this).attr('id')!="csvuploadVideofile"){
            if ($(this).get(0).files.length != 0 && !$(this).siblings('input:hidden').val()) {
              alert("Try again after complete upload files."); 
              csv_uploadfile_status = true;
            }               
          }
        });
        if(csv_uploadfile_status){
          return false;
        }
        if($('#csvuploadVideofile').length){
          console.log($('#defaultcsv').is(':checked'));
          console.log($('#csvuploadVideofile').siblings('input:text').val());
          if($('#defaultcsv').is(':checked') && !$('#csvuploadVideofile').siblings('input:text').val()){
            alert('Please try again after upload video file.');
            return false;
          }  
        }
        
        if(status_check!=3){
          alert('<Customer First Name> and <Customer Last Name> and <Customer Email> fields can not be empty!');
        }else{
          if($('#csv_email_body').val()==default_csvemail_template){
            alert("Please Change Email Message first.");
            $(window).scrollTop(0);
            return false;
          }else{
            if($("#csvoutroArea").length){
              if(!checkOutroChanges($("#csvoutroArea").val())){
                alert("Please Change Outro Info first.");
                $(window).scrollTop(0);
                return false;
              }else{
                csv_outro_field_name = $("#csvoutroArea").attr('name').replace("csv_","");
                csv_outro_field_value = $("#csvoutroArea").val();
                addGridTable(mapped_data);
                $('.create_video-step3-3').hide();
                $('.create_video-step3-4').show();
                $("#startmapping").hide();
                $('a[href="#finish"]').css('display', 'block');  
                $('.btn-create_video-step-3-selection').hide();
              }
            }else{
              addGridTable(mapped_data);
              $('.create_video-step3-3').hide();
              $('.create_video-step3-4').show();
              $("#startmapping").hide();
              $('a[href="#finish"]').css('display', 'block');  
              $('.btn-create_video-step-3-selection').hide();
            }  
          }
        }
      }else{
        alert("Please map csv data!");
      }
    });

    function generateHtmlTable(data) {
      var resultData = [];
      for (var i in data){
        var rowStatus = false;
        for (var j in data[i]){
          if(data[i][j]){
            rowStatus = true;
          }
        }
        if(rowStatus){
          resultData.push(data[i]);
        }
      }
      var headerData = [];
      var html = '';
      var col = 0;
      var maxCol = 51;
      if(typeof(resultData[0]) === 'undefined') {
        return null;
      } else {
        var classIndex = [1,3,3,3,1,1,2];
        $.each(resultData, function( index, row ) {
          //bind header
          if(index == 0) {
            var website_url_status = false;
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
              if(colData.toLowerCase().indexOf("domain")!=-1){
                header = "customer_domain";
              }
              if(colData.toLowerCase().indexOf("logo")!=-1){
                header = "logo";
              }
              if(colData.toLowerCase().indexOf("website")!=-1 || colData.toLowerCase().indexOf("website 1")!=-1 || colData.toLowerCase().indexOf("website 2")!=-1 || colData.toLowerCase().indexOf("website url")!=-1){
                if(!website_url_status){
                  header = "customer_domain";
                  website_url_status = true;
                } 
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
            }else{
              col = 50;  
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