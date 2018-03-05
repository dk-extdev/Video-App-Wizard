@extends('layouts.home')@section('title', 'My Videos')@section('content')
<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
            	<div class="col-lg-12">
                <div class="panel panel-default panel_custom_1">
                    <div class="panel-heading">My Videos</div>
                    <div class="panel-body ibox-content dashboard-video">
                    	<div class="row">
    					<div class="col-lg-12">
	                        <h3 class="panel-sub-heading">PENDING VIDEOS</h3>
	                        <table id="myTable" class="video-page">
	                        	<cols>
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        	</cols>
	                            <thead>
	                                <tr>
	                                    <th>Title</th>
	                                    <th>Customer Email</th>
	                                    <th>Customer Name</th>
	                                    <th>Created</th>
	                                    <th>Status</th>
	                                    <th>Action</th>
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
	                                </tr>
	                                @endforeach                        
	                            </tbody>
	                        </table>
	                        <hr>
	                        <h3 class="panel-sub-heading">COMPLETED VIDEOS</h3>
	                        <table id="myTable2" class="video-page">
	                        	<cols>
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "20%" >
	                        		<col width = "30%" >
	                        		<col width = "20%" >
	                        	</cols>
	                            <thead>
	                                <tr>
	                                    <th>Title</th>
	                                    <th>Customer Email</th>
	                                    <th>Customer Name</th>
	                                    <th>Created</th>
	                                    <th>URL</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($completedvideos as $uservideo)   
	                                <tr>
	                                    <td>{{ $uservideo->project_title }}</td>
	                                    <td>{{ $uservideo->customer_email }}</td>
	                                    <td>{{ $uservideo->customer_first_name.' '.$uservideo->customer_last_name }}</td>
	                                    <td>{{ $uservideo->updated_at }}</td>
	                                    <td><a href="https://youtu.be/{{ $uservideo->youtube_id }}">https://youtu.be/{{ $uservideo->youtube_id }}</a></td>
	                                    <td><button class="btn btn-primary btn-sm del-btn" videoID = "{{$uservideo->id}}"><i class="fa fa-remove"></i> Delete</button></td>
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