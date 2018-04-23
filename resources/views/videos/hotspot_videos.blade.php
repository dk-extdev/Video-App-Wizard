@extends('layouts.home')@section('title', 'My Videos')@section('content')
<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
            	<div class="col-lg-12">
                <div class="panel panel-default panel_custom_1">
                    <div class="panel-heading"><a href="/my_videos">My Videos</a> | Hotspot Videos</div>
                    <div class="panel-body ibox-content dashboard-video">
                    	<div class="row">
    					<div class="col-lg-12">
	                        <table id="myTable2" class="video-page">
	                        	<cols>
	                        		<col width = "50%" >
	                        		<col width = "50%" >
	                        	</cols>
	                            <thead>
	                                <tr>
	                                    <th>URL</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($hotspotvideos as $hotspotvideo)
	                                <tr>
	                                    @if(isset($hotspotvideo->youtube_id) && !empty($hotspotvideo->youtube_id))
	                                    	<td><a href="https://youtu.be/{{ $hotspotvideo->youtube_id }}">https://youtu.be/{{ $hotspotvideo->youtube_id }}</a></td>
	                                	@else
	                                		<td><a class="directly-download"  href="{{ $hotspotvideo->video_url }}" download>{{ $hotspotvideo->video_url }}</a></td>
	                                	@endif
										<td><button class="btn btn-primary btn-sm del-btn" videoID = "{{$hotspotvideo->id}}"><i class="fa fa-remove"></i> Delete</button>
											<a target="_blank" class="btn btn-primary btn-sm del-btn" href="/video/configure/{{$hotspotvideo->id}}"><i class=""></i> Configure Hotspot</a>
											<a onclick="shareIframe({{$hotspotvideo->id}});return false;" class="btn btn-primary btn-sm del-btn" href="#"><i class="fa fa-code"></i> </a>
											<a target="_blank" class="btn btn-primary btn-sm del-btn" href="http://creativevideodemo.com/video/{{$hotspotvideo->id}}"><i class="fa fa-share-alt"></i> </a>
	                                </tr>
	                                @endforeach
	                            </tbody>
	                        </table>
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
@section('scripts')
	<script>
		function shareIframe(id) {
			prompt("Please copy your iframe code", '<iframe frameborder="0" width="972" height="547" src="//creativevideodemo.com/showcase/'+id+'"></iframe>');
		}
	</script>
@stop
