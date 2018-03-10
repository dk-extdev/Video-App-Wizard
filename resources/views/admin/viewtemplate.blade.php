@extends('admin.layouts.home')

@section('title', 'ViewTemplate')

@section('content')

<section class="content-header">
	<h1>
		View Template
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#"><i class="fa fa-file-archive-o"></i> Template</a></li>
		<li class="active">View Template</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">View Template</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="templateTable" class="table table-bordered table-striped">
						<cols>
                    		<col width = "10%" >
                    		<col width = "20%" >
                    		<col width = "60%" >
                    		<col width = "10%" >
                    	</cols>
						<thead>
						<tr>
							<th>ID</th>
							<th>Project</th>
							<th>Fields</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
							@foreach($template_groups as $template_group) 
							<tr data-id="{{ $template_group->id }}">
									<td>{{ $template_group->id }}</td>
									<td>{{ $template_group->project }}</td>
									<td>
										@foreach($template_fields as $template_field)
											@if ($template_field->template_group_id == $template_group->id){
												{{$template_field->html_label}}
											}
											@endif
										@endforeach 
									</td>
									<td><a href="{{ route('admin_edit_template', [$template_group->id]) }}" class="view-video-hyper"><span class="fa fa-edit"></span></a><a href="#" data-id="{{ $template_group->id }}" class="delete-template-id view-video-hyper"><span class="fa fa-trash"></span></a></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>ID</th>
							<th>Project</th>
							<th>Fields</th>
							<th>Action</th>
						</tr>
						</tfoot>
					</table>
					<div class="box-footer">
	          			<a href="{{ route('admin_create_template') }}" type="button" class="btn btn-success">Create Template</a>
	        		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
