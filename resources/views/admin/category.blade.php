@extends('admin.layouts.home')

@section('title', 'View Categories')

@section('content')

<section class="content-header">
	<h1>
		View Categories
	</h1>
	<ol class="breadcrumb">
    <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Categories</a></li>
    <li class="active">Categories</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">View Categories</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="categoryTable" class="table table-bordered table-striped">
						<cols>
                    		<col width = "10%" >
                    		<col width = "50%" >
                    		<col width = "15%" >
                    		<col width = "15%" >
                    		<col width = "10%" >
                    	</cols>
						<thead>
						<tr>
							<th>ID</th>
							<th>Category Name</th>
							<th>Created</th>
							<th>Updated</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
							@foreach($categorydata as $category) 
							<tr data-id="{{ $category->id }}">
									<td>{{ $category->id }}</td>
									<td>{{ $category->name }}</td>
									<td>{{ $category->created_at }}</td>
									<td>{{ $category->updated_at }}</td>
									<td><a href="{{ route('admin_edit_category', [$category->id]) }}" class="view-video-hyper"><span class="fa fa-edit"></span></a><a href="#" data-id="{{ $category->id }}" class="delete-category-id view-video-hyper"><span class="fa fa-trash"></span></a></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>ID</th>
							<th>Category Name</th>
							<th>Created</th>
							<th>Updated</th>
							<th>Actions</th>
						</tr>
						</tfoot>
					</table>
					<div class="box-footer">
	          			<a href="{{ route('admin_create_category') }}" type="button" class="btn btn-success">Create Category</a>
	        		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
