@extends('layouts.home')

@section('title', 'Create A Video')

@section('content')
<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>
                            Create Video
                        </h2>
                    </div>
                    <div class="ibox-content create_video_wizard">
                        <div id="wizard" class = "" >
                            <h1>Enter Project Title</h1>
                            <div class="step-content">
                                <div class="text-center m-t-md">
                                  <div class = "col-lg-3"></div>            
                                  <div class = "col-lg-6">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group"><label>Project title</label> <input type="text" required placeholder="Enter Project title" class="form-control" id="projecttitle" aria-required="true"></div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                  </div>
                                  <div class = "col-lg-3"></div>            
                                </div>
                            </div>

                            <h1>Choose a Video Template</h1>
                            <div class="step-content">
                              <div class = "col-lg-3" >
                                <div class="file-manager">
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="template_search_keyword"> <span class="input-group-btn"> <button type="button" class="btn btn-primary" id="gotemplatesearch"><i class = "fa fa-search"></i></button> </span>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <h5>CATEGORIES</h5>
                                  @foreach($category as $singlecategory)
                                    @if($singlecategory->id != "20")
                                      <div class="i-checks"><label> <input type="checkbox" class="template-category" value="{{$singlecategory->id}}"> <i></i> {{$singlecategory->name}} </label></div>
                                    @else
                                      @if(Auth::guard('user')->user()->type == "Premium")
                                        <div class="i-checks"><label> <input type="checkbox" class="template-category" value="{{$singlecategory->id}}"> <i></i> {{$singlecategory->name}} </label></div>
                                      @endif
                                    @endif
                                    
                                  @endforeach
                                  <div class="hr-line-dashed"></div>
                                  <div class="clearfix"></div>
                                </div>            
                              </div>
                              <div class="col-lg-9" >
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class = "pull-right" >
                                      <select class="form-control m-b" id="sorttemplate">
                                          <option value='name'>Sort by Name</option>
                                          <option value='date'>Sort by Date</option>
                                      </select>
                                    </div>
                                  </div>
                                  <input type="hidden" id="choosed_template"/>
                                  <input type="hidden" id="template_video_id"/>
                                  <input type="hidden" id="choosed_template_url"/>
                                  <input type="hidden" id="choosed_template_group"/>
                                  <div class="new-table-content">
                                    <div class="col-lg-12 video-template-lists">
                                      @if(count($template_videos)==0)
                                      <div class="text-center">There is no template videos now.</div>
                                      @endif
                                      @foreach($template_videos as $template_video)
                                        <div class="file-box video-template">
                                          <div class="file">
                                              <span class="corner"></span>
                                              <div class="image choose-template" template-video-id = "{{$template_video->video_id}}" template-group = "{{$template_video->template_group_id}}" template-url="{{$template_video->url}}" template-type="Alpha_{{str_replace("YouTube_Preview_","",$template_video->name)}}">
                                                  <img alt="image" class="img-responsive" src="{{ asset('assets/template_thumb') }}/{{str_replace("YouTube_Preview_","",$template_video->name)}}.png">
                                              </div>
                                              <div class = "description" >
                                                <div class="file-name text-center">
                                                    <a class="preview-video-template" video-url="{{$template_video->url}}"><span>{{str_replace("YouTube_Preview_","",$template_video->name)}}</span><i class="fa fa-play-circle" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                              </div>
                                          </div>
                                        </div>
                                      @endforeach
                                    </div>
                                    <div class="temp-pagination text-center">
                                      {{$template_videos->links()}}
                                    </div>
                                  </div>
                                </div>            
                              </div>
                            </div>
                            <h1>Enter your data</h1>
                            <div class="step-content">
                              <div class="text-left m-t-md create_video-step3-1">
                                <div class = "col-lg-4"></div>            
                                <div class = "col-lg-5">
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                                  <div class="i-checks"><label> <input type="radio" checked="" value="step3-1" name="rd-step3"> <i></i> Create One Video </label></div>
                                  <div class="i-checks"><label> <input type="radio" value="step3-2" name="rd-step3"> <i></i>  Create Multi Videos (CSV Upload)</label></div>
                                  <br>
                                  <a class="btn btn-success btn-rounded btn-create_video-step-3-selection" href="#">Customize&nbsp;<i class = "fa fa-long-arrow-right"></i></a>
                                  <br>
                                  <br>
                                  <br>
                                </div>
                                <div class = "col-lg-3"></div>            
                              </div>
                              <div class="text-left m-t-md create_video-step3-2">
                                <div class="alert manual-field-error alert-danger" role="alert">
                                </div>
                                <div class = "col-lg-6 template-data">
                                <h1>Enter your data manually:</h1>
                                <form id="upload-manually" method="post">
                                </form>
                                </div>
                                <div class = "col-lg-6" >
                                  <label>Preview</label>
                                  <div class = "create_video-previewbox" id="create_video_previewbox">
                                  </div>
                                </div>
                              </div>
                              <div class="text-left m-t-md create_video-step3-3">
                                <div class="alert csv-field-error alert-danger" role="alert">
                                </div>
                                <div class = "col-lg-6">
                                  <hr>
                                  <div class="form-group">
                                    <h1>Upload your data from CSV:</h1>
                                    <label>Sender Name</label><input type="text" maxlength="100" placeholder="" id="csv_sender_name" value="{{ Auth::guard('user')->user()->name }}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Sender Email</label><input type="text" maxlength="100" placeholder="" id="csv_sender_email" value="{{ Auth::guard('user')->user()->email }}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Email Subject</label><input type="text" maxlength="100" placeholder="" id="csv_email_subject" value="" class="form-control">
                                  </div>
                                  <form id="upload-csv" method="post">
                                      <label>Upload a CSV file</label>
                                      <div class="input-group">
                                        <input type="file" name="create_video-inpute-file" accept=".csv,text/csv" id="create_video-inpute-file" class="hide required">
                                        <input type="text" class="form-control" id = "create_video-inpute-file-text" >
                                        <span class="input-group-btn"> 
                                          <label class="btn btn-primary" for = "create_video-inpute-file">Browse</label> 
                                        </span>
                                      </div>  
                                  </form>
                                  <p class = "text-warning" >maximum number of lines : 50</p>
                                  <p class = "text-success hide" ></p>
                                  <div id="csv_mapping"></div>
                                </div>
                                <div class = "col-lg-6" >
                                  <label>Preview</label>
                                  <div class = "create_video-previewbox" id="create_video_previewbox2">
                                  </div>
                                </div>
                                <div class = "col-lg-12" >
                                  <div id="csv-display" class="hide">
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>  
                        <div id="videotemplateModal" class="modal fade">
                          <div class="modal-dialog" style="top:25%">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body" style="background:black;">
                              </div>
                            </div>
                          </div>
                        </div>  
                        <div id="imgModal" class="modal fade">
                          <div class="modal-dialog" style="top:25%">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3>Choose logo image.</h3>
                              </div>
                              <div class="modal-body">
                                <div id="loadingImg" style="display: none;text-align:center">
                                    <div>Loading images for logo.</div>
                                    <img src="{{ asset('assets/theme-new/img/ajax-loader.gif') }}">
                                </div>
                                <table></table>
                              </div>
                            </div>
                          </div>
                        </div>  
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>

@endsection