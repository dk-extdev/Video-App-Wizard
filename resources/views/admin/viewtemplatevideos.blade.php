@extends('admin.layouts.home')

@section('title', 'ViewTemplateVideos')

@section('content')

<section class="content-header">
	<h1>
		View Template
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-file-archive-o"></i> TemplateVideos</a></li>
		<li class="active">View TemplateVideos</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">View TemplateVideos</h3>
				</div>
				<div class="box-body">
					<table id="templatevideosTable" class="table table-bordered table-striped">
						<cols>
                    		<col width = "10%" >
                    		<col width = "20%" >
                    		<col width = "20%" >
                    		<col width = "30%" >
                    		<col width = "10%" >
                    		<col width = "10%" >
                    	</cols>
						<thead>
						<tr>
							<th>ID</th>
							<th>Category</th>
							<th>Name</th>
							<th>Url</th>
							<th>Template Group</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
							@foreach($templatevideos as $templatevideo) 
							<tr data-id="{{ $templatevideo->id }}">
									<td>{{ $templatevideo->id }}</td>
									<td>{{ $templatevideo->category->name }}</td>
									<td>{{ $templatevideo->name }}</td>
									<td>{{ $templatevideo->url }}</td>
									<td>{{ $templatevideo->group->project }}</td>
									<td><a href="{{ route('admin_edit_templatevideos', [$templatevideo->id]) }}" class="view-video-hyper"><span class="fa fa-edit"></span></a><a data-id="{{ $templatevideo->id }}" class="delete-templatevideo-id view-video-hyper"><span class="fa fa-trash"></span></a></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>ID</th>
							<th>Category</th>
							<th>Name</th>
							<th>Url</th>
							<th>Template Group</th>
							<th>Action</th>
						</tr>
						</tfoot>
					</table>
					<div class="box-footer">
	          			<a href="{{ route('admin_create_templatevideos') }}" type="button" class="btn btn-success">Create Template Videos</a>
	        		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
