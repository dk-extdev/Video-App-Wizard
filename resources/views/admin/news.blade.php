@extends('admin.layouts.home')

@section('title', 'View News')

@section('content')

<section class="content-header">
	<h1>
		View News
	</h1>
	<ol class="breadcrumb">
    <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">News</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">View News</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="newsTable" class="table table-bordered table-striped">
						<cols>
                    		<col width = "5%" >
                    		<col width = "15%" >
                    		<col width = "15%" >
                    		<col width = "15%" >
                    		<col width = "45%" >
                    		<col width = "5%" >
                    	</cols>
						<thead>
						<tr>
							<th>ID</th>
							<th>App Name</th>
							<th>News Title</th>
							<th>Support Email</th>
							<th>News Description</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
							@foreach($newsdata as $news) 
							<tr data-id="{{ $news->id }}">
									<td>{{ $news->id }}</td>
									<td>{{ $news->app_name }}</td>
									<td>{{ $news->news_title }}</td>
									<td>{{ $news->support_email }}</td>
									<td>{!! $news->news_description !!}</td>
									<td><a href="{{ route('admin_edit_news', [$news->id]) }}" class="view-video-hyper"><span class="fa fa-edit"></span></a><a href="#" data-id="{{ $news->id }}" class="delete-news-id view-video-hyper"><span class="fa fa-trash"></span></a></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>ID</th>
							<th>App Name</th>
							<th>News Title</th>
							<th>Support Email</th>
							<th>News Description</th>
							<th>Actions</th>
						</tr>
						</tfoot>
					</table>
					<div class="box-footer">
	          			<a href="{{ route('admin_create_news') }}" type="button" class="btn btn-success">Create News</a>
	        		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
