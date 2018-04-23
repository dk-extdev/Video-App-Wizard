<script src="/assets/theme-new/js/jquery-2.1.1.js"></script>
@if ($iframe)
<style>
    body { margin: 0 }
</style>
@else
    <link href="/assets/global/css/hotspots.css" type="text/css" rel="stylesheet" />
@endif
<div class="wrapper">
	<div id="canvas">
		<div style="position: absolute; visibility: hidden" id="hotspots">
			@foreach($video->options->hotspots as $key=>$hotspot)
				<div id="hotspot-{{$key}}" class="red_hotspot" style="left:{{$hotspot->left}}px;top:{{$hotspot->top}}px;">
                    <i class="icon-pointer"></i>
				</div>
                <div id="hotspot-content{{$key}}" class="hotspot-content text-center" style="left:{{$hotspot->left+20}}px;top:{{$hotspot->top+20}}px;">
                    <h2 class="hotspot-title">{{$hotspot->title}}</h2>
                    @if ($hotspot->thumb)<img src="{{$hotspot->thumb}}" />@endif
                    <p>{{$hotspot->description}}</p>
                    <p class="text-center">
                        <a target="_blank" href="{{$hotspot->cartUrl}}" class="button">Check it out</a>
                    </p>
                </div>
			@endforeach
		</div>
        @if ($video->youtube_id)
        <video
                id="video"
                class="video-js vjs-default-skin"
                controls
                autoplay
                width="972" height="547"
                data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v={{ $video->youtube_id }}"}] }'
        >
        </video>
        @else
            <video
                    id="video"
                    class="video-js vjs-default-skin"
                    controls
                    autoplay
                    width="972" height="547"
                    data-setup='{ "techOrder": ["html5"]}'
            >
                <source src="{{ $video->video_url }}" type="video/mp4">
            </video>
        @endif
	</div>
</div>
<script src="/assets/global/plugins/video.min.js"></script>
<script src="/assets/global/plugins/Youtube.min.js"></script>
<script type='text/javascript'>
    var state = [];
    $(document).ready(function(){
        if ('{{$imgCount}}' == 0) {
            console.log('No images to load');
            initialize();
        } else {
            var imgLoadCount = 0;
            $('img').load(function(){
                imgLoadCount++;
                if (imgLoadCount == '{{$imgCount}}') {
                    console.log('Finished loading images');
                    initialize();
                }
            });
            $.each($('img'), function (k, v) {
                if ($(v).height()) {
                    imgLoadCount++;
                    if (imgLoadCount == '{{$imgCount}}') {
                        console.log('Finished loading images');
                        initialize();
                    }
                }
            });
        }
    });
    function initialize() {
        @foreach($video->options->hotspots as $key=>$hotspot)
            state[{{$key}}] = 'hidden';
            if({{$hotspot->top}}+20+$("#hotspot-content{{$key}}").height()>547) {
                $("#hotspot-content{{$key}}").css({'margin-top':-$("#hotspot-content{{$key}}").height()})
            }
            if({{$hotspot->left}}+20+$("#hotspot-content{{$key}}").width()>972) {
                $("#hotspot-content{{$key}}").css({'margin-left':-$("#hotspot-content{{$key}}").width()})
            }
        @endforeach
        $('#hotspots').css({'position':'static', 'visibility':'visible'}).children('div').hide();
        videojs('video').ready(function() {
            console.log('starting checking position');
            checkPosition();
        });
    }
    function checkPosition() {
        var currentTime = videojs('video').currentTime();
        @foreach($video->options->hotspots as $key=>$hotspot)
            if (state[{{$key}}] == 'shown') {
                if (currentTime<{{$hotspot->start_time}} || currentTime>{{$hotspot->end_time}})  {
                    $('#hotspot-{{$key}},#hotspot-content{{$key}}').hide();
                    state[{{$key}}] = 'hidden';
                }
            }
            if (state[{{$key}}] == 'hidden') {
                if (currentTime>={{$hotspot->start_time}} && currentTime<={{$hotspot->end_time}})  {
                    $('#hotspot-{{$key}},#hotspot-content{{$key}}').show();
                    state[{{$key}}] = 'shown';
                }
            }
        @endforeach
        setTimeout(checkPosition, 100);
    }
</script>
<link type="text/css" rel="stylesheet" href="/assets/global/css/video-js.min.css" />
<style>
    .video-js .vjs-big-play-button {display: none}
    .red_hotspot, .red_hotspot:hover {
        position: absolute;
        z-index: 3;
        border-radius: 50%;
        background: none !important;
        border:1px solid #fff;
        width: 19px;
        height: 19px;
        padding: 10px;
        -webkit-animation-name:pointerAnimation;
        -webkit-animation-timing-function: linear;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-duration: 1.5s;
        -webkit-transform: scale(1);
        -webkit-text-size-adjust: 100%;

    }
    .red_hotspot:hover:after {
        background: none;
        box-shadow: none;
    }
    .icon-pointer {
        border-radius: 50%;
        background: #b42b2e;
        width: 15px;
        height: 15px;
        border: 2px solid #000;
        display: block;
    }
    .hotspot-content {
        color: black;
        position: absolute;
        z-index: 2;
        opacity: 0;
        width: 180px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.75);
        background: linear-gradient(to bottom, white 0%, #ababab 100%)
    }
    body {
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
    }
    .hotspot-content img {
        max-width: 100%;
    }
    .red_hotspot:hover + .hotspot-content {
        opacity: 1;
    }
    .hotspot-content:hover {
        opacity: 1;
    }
    .text-center {
        text-align: center
    }
    .button {
        display: inline-block;
        padding: 5px 1em;
        border-radius: 3px;
        color: #fff;
        text-decoration: none;
        font-family: "pragmatica-web-condensed",sans-serif;
        font-size: 1em;
        font-weight: 600;
        text-transform: uppercase;
        border: 1px solid #444;
        box-shadow: 0px 1px 1px 0 rgba(0, 0, 0, 0.5), 0 0 3px 0 rgba(255, 255, 255, 0.15) inset;
        background: #575757;
        background: -moz-linear-gradient(top, #575757 0%, #3d3d3d 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #575757), color-stop(100%, #3d3d3d));
        background: -webkit-linear-gradient(top, #575757 0%, #3d3d3d 100%);
        background: -o-linear-gradient(top, #575757 0%, #3d3d3d 100%);
        background: -ms-linear-gradient(top, #575757 0%, #3d3d3d 100%);
        background: linear-gradient(to bottom, #575757 0%, #3d3d3d 100%);
    }
    a:hover {
        text-decoration: underline;
    }
    .button:hover {
        text-decoration: none;
        background: #575757;
    }
    @-webkit-keyframes pointerAnimation{0%,100%{-webkit-transform:scale(1);transform:scale(1)}50%{-webkit-transform:scale(1.2);transform:scale(1.2)}}
    @-webkit-keyframes pointerAnpointerAnimationReverse{0%,100%{-webkit-transform:scale(1.2);transform:scale(1.2)}50%{-webkit-transform:scale(1);transform:scale(1)}}
    .hotspot .hotspot-content {
        -webkit-animation-name: pointerAnimationReverse;
    }
</style>