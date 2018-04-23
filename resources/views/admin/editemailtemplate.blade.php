@extends('admin.layouts.home')

@section('title', 'Edit Email Template')

@section('content')

<section class="content-header">
  <h1>
    Edit News
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-newspaper"></i> Email Template</a></li>
    <li class="active">Edit Email Template</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Success ..! </strong> {{ Session::get('success') }}
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
      {{ Form::open(array('method'=>'POST','route' => array('admin_update_emailtemplate', $emailtemplatedata->id))) }}
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Update Email Template</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <colgroup>
                <col width="10%">
                <col width="40%">
                <col width="50%">
              </colgroup>
              <tr>
                <th>Field</th>
                <th>Value</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Template Name</td>
                <td><input type="text"  class="form-control" name="email_template_name" required value="{{$emailtemplatedata->name}}"></td>
              </tr>
              <tr>
                <td>Email Subject</td>
                <td><input type="text"  class="form-control" name="email_subject" required value="{{$emailtemplatedata->email_subject}}"></td>
              </tr>
              <tr>
                <td>Email Message</td>
                <td><textarea class="form-control" rows="5" name="email_body" required>{{$emailtemplatedata->email_body}}</textarea></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" class="news-add btn btn-info pull-right">Update Email Template</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    
  </div>
</section>
@endsection