@extends('admin.layouts.home')

@section('title', 'View Email Template')

@section('content')

<section class="content-header">
	<h1>
		View Email Template
	</h1>
	<ol class="breadcrumb">
    <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Email Template</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">View Email Template</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="emailtemplateTable" class="table table-bordered table-striped">
						<cols>
                    		<col width = "5%" >
                    		<col width = "15%" >
                    		<col width = "30%" >
                    		<col width = "45%" >
                    		<col width = "5%" >
                    	</cols>
						<thead>
						<tr>
							<th>ID</th>
							<th>Template Name</th>
							<th>Email Subject</th>
							<th>Email Message</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
							@foreach($emailtemplatedata as $emailtemplate) 
							<tr data-id="{{ $emailtemplate->id }}">
									<td>{{ $emailtemplate->id }}</td>
									<td>{{ $emailtemplate->name }}</td>
									<td>{{ $emailtemplate->email_subject }}</td>
									<td><pre style="border:0">{{$emailtemplate->email_body}}</pre></td>
									<td><a href="{{ route('admin_edit_emailtemplate', [$emailtemplate->id]) }}" class="view-video-hyper"><span class="fa fa-edit"></span></a><a href="#" data-id="{{ $emailtemplate->id }}" class="delete-emailtemplate-id view-video-hyper"><span class="fa fa-trash"></span></a></td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
						<tr>
							<th>ID</th>
							<th>Template Name</th>
							<th>Email Subject</th>
							<th>Email Message</th>
							<th>Actions</th>
						</tr>
						</tfoot>
					</table>
					<div class="box-footer">
	          			<a href="{{ route('admin_create_emailtemplate') }}" type="button" class="btn btn-success">Create Email Template</a>
	        		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
