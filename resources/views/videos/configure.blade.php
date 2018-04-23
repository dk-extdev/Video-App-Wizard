@extends('layouts.home')

@section('title', 'User Login')

@section('content')

	<div class="gt_main_content_wrap">
		<section class="gt_about_bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 margin_top_10">
						<div class="ibox float-e-margins"><div class="ibox-title">
								<h2>
									Configure Video
								</h2>
							</div>
                            <div class="ibox-content" style="text-align: center">
                                <div class="overlay"></div>
                                @if ($video->youtube_id)
                                <video
                                        id="video"
                                        class="video-js vjs-default-skin"
                                        controls
                                        width="972" height="547"
                                        data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v={{ $video->youtube_id }}"}] }'
                                >
                                </video>
                                @else
                                    <video
                                            id="video"
                                            class="video-js vjs-default-skin"
                                            controls
                                            width="972" height="547"
                                            data-setup='{ "techOrder": ["html5"]}'
                                    >
                                        <source src="{{ $video->video_url }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            @if (session()->has('message') || empty($video->youtube_id) )
                                <div class="ibox-content">
                            @else
                                <div class="ibox-content" style="border: none">
                            @endif

								<div class="row">
									<div class="col-md-12">
										@if (session()->has('message'))
											<div class="alert alert-danger alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												{{ session()->get('message') }}
											</div>
										@endif
										@if(Session::has('success'))
											<div class="alert alert-success" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<strong>Success ..! </strong> {{ Session::get('success') }}
											</div>
                                            @elseif(empty($video->youtube_id))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Error ..! </strong> > Upload to  youtube for optimal performance and browser compatibility
                                                </div>
										@elseif(Session::has('error'))
											<div class="alert alert-danger" role="alert">
												<strong>Error ..! </strong> {{ Session::get('error') }}
											</div>
										@elseif(count($errors) > 0)
											<div class="alert alert-danger" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h4 class="text-center"><strong>Error ..! </strong> You have Something Error.</h4>
												<ul class="text-center">
													@foreach($errors->all() as $error)
														<li><p style="color: red">{!! $error !!}</p></li>
													@endforeach
												</ul>
											</div>
										@endif
									</div>
								</div>

								{!! Form::open(['route'=>['my_video_configure_update',$video],'method'=>'POST','data-parsley-validate'=>'']) !!}
                                <h3 class="m-t-none m-b"><i class = "fa "></i>&nbsp;Hotspots</h3>
                                <div class="repeater">
                                    <div data-repeater-list="options[hotspots]">
                                        @foreach($video->options->hotspots as $hotspot)
                                        <div class="row ibox-content" data-repeater-item>
                                            <div class="col-lg-6 wow zoomIn " style="padding: 0">
                                                <div class="row" style="margin: 0" >
                                                    <div style="padding:0" class="col-lg-2 form-group">
                                                        <label>Left</label> <input type="text" placeholder="" class="positionLeft form-control" value="{{$hotspot->left ?? ''}}" name="left" required data-parsley-required-message="Left is required" data-parsley-trigger="change">
                                                    </div>
                                                    <div style="padding:0" class="text-center col-lg-2 form-group"><i onclick="capturePosition(this)" class="fa fa-crosshairs"></i></div>
                                                    <div style="padding:0" class="col-lg-2 form-group">
                                                        <label>Top</label> <input type="text" placeholder="" class="positionTop form-control" value="{{$hotspot->top ?? ''}}" name="top" required data-parsley-required-message="Top is required" data-parsley-trigger="change">
                                                    </div>
                                                    <div style="padding-right:0" class="col-lg-3 wow zoomIn ">
                                                        <div class="form-group"><label>Title</label> <input type="text" placeholder="" class="form-control" value="{{$hotspot->title ?? ''}}" name="title" required data-parsley-required-message="Title is required" data-parsley-trigger="change"></div>
                                                    </div>
                                                    <div style="padding-right:0" class="col-lg-3 wow zoomIn ">
                                                        <div class="form-group"><label>Description</label> <input type="text" placeholder="" class="form-control" value="{{$hotspot->description ?? ''}}" name="description" required data-parsley-required-message="Description is required" data-parsley-trigger="change"></div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin: 0;" >
                                                    <div style="padding:0" class="col-lg-2 form-group">
                                                        <div class="form-group"><label>Start time</label> <input type="text" placeholder="" class="startTime form-control" value="{{$hotspot->start_time ?? ''}}" name="start_time" required data-parsley-required-message="Start time is required" data-parsley-trigger="change"></div>
                                                    </div>
                                                    <div style="padding:0;margin-left:7px;margin-right:-7px" class="text-center col-lg-4 form-group">
                                                        <div class="form-group"><button onclick="fillPosition($(this).closest('.row').find('.startTime'));return false;" style="margin-top: 25px" class="btn btn-primary">Fill Current Position</button></div>
                                                    </div>
                                                    <div style="padding:0;margin-left:14px;margin-right:-14px" class=" col-lg-2 wow zoomIn ">
                                                        <div class="form-group"><label>End time</label> <input type="text" placeholder="" class="endTime form-control" value="{{$hotspot->end_time ?? ''}}" name="end_time" required data-parsley-required-message="End time is required" data-parsley-trigger="change"></div>
                                                    </div>
                                                    <div style="padding:0" class="text-right col-lg-4 wow zoomIn ">
                                                        <div class="form-group"><button onclick="fillPosition($(this).closest('.row').find('.endTime'));return false;" style="margin-top: 25px" class="btn btn-primary">Fill Current Position</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 wow zoomIn">
                                                <div class="">
                                                    <div class="form-group">
                                                        <div class="thumb">
                                                            @if(!empty($hotspot->thumb))<img src="{{$hotspot->thumb}}" style="width:100%" /><br><br>@endif
                                                        </div>
                                                        <label>Upload Image</label>
                                                        <input class="form-control upload-file uploadImgfile" type="file">
                                                        <div class="msgUpload"></div>
                                                        <input type="hidden" class="hotspotThumb" name="thumb" value="{{$hotspot->thumb ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 wow zoomIn">
                                                <div class="">
                                                    <div class="form-group"><label>Url</label> <input type="text" placeholder="" class="form-control" value="{{$hotspot->cartUrl ?? ''}}" name="cartUrl" required data-parsley-required-message="Url is required" data-parsley-trigger="change"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 wow zoomIn">
                                                <div class="">
                                                    <span style="margin-top: 30px" data-repeater-delete class="btn btn-danger btn-sm">
                                                        <span class="glyphicon glyphicon-remove"></span> Delete
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <div style="margin-left:5px" class="col-sm-offset-0 col-sm-11">
                                        <span data-repeater-create class="btn btn-info btn-md">
                                            <span class="glyphicon glyphicon-plus"></span> Add
                                        </span>
                                        </div>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-lg-6 wow zoomIn ">
										<div class="ibox-content">
											<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong><i class="fa fa-check"></i>&nbsp;Update</strong></button>
										</div>
									</div>
									<div class="col-lg-6 wow zoomIn"></div>
								</div>
								{!! Form::close() !!}

							</div><!--ibox-content-->
						</div><!--ibox-->
					</div>


				</div>
			</div>
		</section>

	</div>


@endsection
@section('scripts')
    <script src="/assets/global/plugins/video.min.js"></script>
    <script src="/assets/global/plugins/Youtube.min.js"></script>
    <script src="/assets/global/plugins/jquery.repeater.js"></script>
    <script>
        var targetLeft, targetTop;
        function fillPosition(object) {
            object.val(videojs('video').currentTime());
        }
        $(document).ready(function () {
            $('.repeater').repeater({
                // (Optional)
                // start with an empty list of repeaters. Set your first (and only)
                // "data-repeater-item" with style="display:none;" and pass the
                // following configuration flag
                initEmpty: true,
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function () {
                    $(this).find('.thumb').html('');
                    $(this).slideDown();
                },
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            })
        });
        $('.overlay').click(function(e){
            var left = e.pageX-$(this).offset().left;
            left = left < 15 ? 0 : left - 15;
            var top = e.pageY-$(this).offset().top;
            top = top < 15 ? 0 : top - 15;
            targetLeft.val(left);
            targetTop.val(top);
            $(this).css('display','none');
        });
        function capturePosition(object) {
            targetLeft = $(object).closest('.row').find('.positionLeft');
            targetTop = $(object).closest('.row').find('.positionTop');
            $('.overlay').css('display','block');
        }
    </script>
    <link type="text/css" rel="stylesheet" href="/assets/global/css/video-js.min.css" />
    <style>
        .video-js .vjs-big-play-button {display: none}
        .fa-crosshairs {
            cursor:pointer;
            margin-top:26px;
            font-size: 2em
        }
        #video {
            left:50%;
            margin-left: -486px;
        }
        .overlay {
            display:none;
            background:white;
            opacity:0.5;
            position:absolute;
            z-index:1;
            width:972px;
            height:547px;
            left:50%;
            margin-left:-486px;
            cursor: crosshair;
        }
    </style>
@stop
