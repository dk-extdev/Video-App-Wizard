<div class = "col-lg-6">
  <div class="form-group">
    <h1>Enter your data manually:</h1>
    <label>Sender Name</label><input type="text" maxlength="16" placeholder="" id="sender_name" value="{{ Auth::guard('user')->user()->name }}" class="form-control">
  </div>
  <div class="form-group">
    <label>Sender Email</label><input type="text" placeholder="" id="sender_email" value="{{ Auth::guard('user')->user()->email }}" class="form-control">
  </div>
  <div class="form-group">
    <label>Customer Name</label><input type="text" maxlength="16" placeholder="" id="customer_name" class="form-control">
  </div>
  <div class="form-group">
    <label>Customer Domain</label><input type="text" placeholder="" id="customer_domain" class="form-control">
  </div>
  <div class="form-group">
    <label>Customer Email</label><input type="text" placeholder="" id="customer_email" class="form-control">
  </div>
  <div class="form-group">
    <label>Main Text</label><input type="text" maxlength="110" id="customer_description" placeholder="" class="form-control">
  </div>
  <div class="form-group">
    <label>Text Color</label><input id="text_color" type="color" value="#1F1F1F"/>
  </div>
  <form id="myform" method="post">
      <div class="form-group">
          <label>Upload Logo Image</label>
          <input class="form-control" type="file" id="uploadImgfile" />
      </div>
      <div class="form-group">
          <div class="progress upload-img-progress" style="display:none;">
              <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%;display:none;">0%</div>
          </div>
          <div class="msgUpload"></div>
          <img src="" id="uploadedImg"/>
      </div>
      <input type="button" id="btnImgUpload" class="btn btn-primary" value="Upload" />
  </form>
</div>
