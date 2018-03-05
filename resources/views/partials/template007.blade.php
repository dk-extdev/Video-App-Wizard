<div class = "col-lg-6">
  <div class="form-group">
    <h1>Enter your data manually:</h1>
    <label>Sender Name</label><input type="text" maxlength="16" placeholder="" id="sender_name" value="{{ Auth::guard('user')->user()->name }}" class="form-control">
  </div>
  <div class="form-group">
    <label>Sender Email</label><input type="text" placeholder="" id="sender_email" value="{{ Auth::guard('user')->user()->email }}" class="form-control">
  </div>
  <form id="myform" method="post">
      <div class="form-group">
          <label>Upload Logo Image</label>
          <input class="form-control" type="file" id="uploadImgfile" />
      </div>
      <div class="form-group">
          <label>Upload Photo</label>
          <input class="form-control" type="file" id="uploadPhotofile" />
      </div>
      <div class="form-group">
          <div class="progress upload-img-progress" style="display:none;">
              <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%;display:none;">0%</div>
          </div>
          <div class="msgUpload"></div>
          <img src="" id="uploadedImg"/>
          <div class="msgPhoto"></div>
          <img src="" id="uploadedPhoto"/>
      </div>
      <input type="button" id="btnImgUpload" class="btn btn-primary" value="Upload" />
  </form>
</div>
<div class = "col-lg-6" >
  <label>Preview</label>
  <div class = "create_video-previewbox" id="create_video_previewbox">
  </div>
</div>