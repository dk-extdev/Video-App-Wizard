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