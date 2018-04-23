@extends('layouts.home')@section('title', 'My Videos')@section('content')
<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
            	<div class="col-lg-12">
                <div class="panel panel-default panel_custom_1">
                    <div class="panel-heading">My Videos | <a href="/hotspot_videos">Hotspot Videos</a></div>
                    <div class="panel-body ibox-content dashboard-video">
                    	<div class="row">
    					<div class="col-lg-12">
	                        <h3 class="panel-sub-heading">PENDING VIDEOS</h3>
	                        <table id="myTable" class="video-page">
	                        	<cols>
	                        		<col width = "20%" >
	                        		<col width = "30%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "10%" >
	                        		<col width = "0%" >
	                        	</cols>
	                            <thead>
	                                <tr>
	                                    <th>Title</th>
	                                    <th>Customer Email</th>
	                                    <th>Customer Name</th>
	                                    <th>Created</th>
	                                    <th>Status</th>
	                                    <th>Action</th>
	                                    <th style="display:none;"></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($pendingvideos as $uservideo) 
	                                <tr>
	                                    <td>{{ $uservideo->project_title }}</td>
	                                    <td>{{ $uservideo->customer_email }}</td>
	                                    <td>{{ $uservideo->customer_first_name.' '.$uservideo->customer_last_name }}</td>
	                                    <td>{{ $uservideo->created_at }}</td>
	                                    <td>{{ $uservideo->status }}</td>
	                                    <td><button class="btn btn-primary btn-sm del-btn" videoID = "{{$uservideo->id}}">Cancel</button></td>
	                                    <td style="display:none;">{{ $uservideo->project_id }}</td>
	                                </tr>
	                                @endforeach                        
	                            </tbody>
	                        </table>
	                        <hr>
	                        <h3 class="panel-sub-heading">COMPLETED VIDEOS</h3>
	                        <table id="myTable2" class="video-page">
	                        	<cols>
	                        		<col width = "10%" >
	                        		<col width = "15%" >
	                        		<col width = "15%" >
	                        		<col width = "20%" >
	                        		<col width = "25%" >
	                        		<col width = "25%" >
	                        		<col width = "20%" >
	                        		<col width = "0%" >
	                        	</cols>
	                            <thead>
	                                <tr>
	                                    <th>Title</th>
	                                    <th>Customer Email</th>
	                                    <th>Customer Name</th>
	                                    <th>Completed</th>
	                                    <th>Download Link</th>
	                                    <th>Youtube URL</th>
	                                    <th>Action</th>
	                                    <th style="display:none;"></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($completedvideos as $uservideo)   
	                                <tr>
	                                    <td>{{ $uservideo->project_title }}</td>
	                                    <td>{{ $uservideo->customer_email }}</td>
	                                    <td>{{ $uservideo->customer_first_name.' '.$uservideo->customer_last_name }}</td>
	                                    <td>{{ $uservideo->updated_at }}</td>
	                                    <td><a class="directly-download"  href="{{ $uservideo->video_url }}" download>{{ $uservideo->video_url }}</a></td>
	                                    <td>@if(isset($uservideo->youtube_id) && !empty($uservideo->youtube_id))
	                                    		<a href="https://youtu.be/{{ $uservideo->youtube_id }}" target="_blank">https://youtu.be/{{ $uservideo->youtube_id }}</a>
	                                    	@endif
	                                    </td>
										<td><button class="btn btn-primary btn-sm del-btn" videoID = "{{$uservideo->id}}"><i class="fa fa-remove"></i> Delete</button>
											<a onclick="shareIframe({{$uservideo->id}});return false;" class="btn btn-primary btn-sm del-btn" href="#"><i class="fa fa-code"></i> </a>
											<a target="_blank" class="btn btn-primary btn-sm del-btn" href="http://creativevideodemo.com/video/{{$uservideo->id}}"><i class="fa fa-share-alt"></i> </a>
											<br><br>
											<a target="_blank" class="btn btn-primary btn-sm del-btn" href="/video/configure/{{$uservideo->id}}"><i class=""></i> Configure Hotspot</a></td>
										<td style="display:none;">{{ $uservideo->project_id }}</td>
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
