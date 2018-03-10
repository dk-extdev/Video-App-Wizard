@extends('admin.layouts.home')

@section('title', 'Edit Customer')

@section('content')

<section class="content-header">
  <h1>
    Edit News
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-newspaper"></i> News</a></li>
    <li class="active">Edit News</li>
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
      {{ Form::open(array('method'=>'POST','route' => array('admin_update_news', $newsdata->id))) }}
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Update News</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <colgroup>
                <col width="20%">
                <col width="30%">
                <col width="50%">
              </colgroup>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>value</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><i>app_name</i></td>
                <td>Application Name</td>
                <td><input type="text"  class="form-control" name="app_name" required value="{{$newsdata->app_name}}"></td>
              </tr>
              <tr>
                <td><i>news_title</i></td>
                <td>News Title</td>
                <td><input type="text" class="form-control" name="news_title" required value="{{$newsdata->news_title}}"></td>
              </tr>
              <tr>
                <td><i>news_description</i></td>
                <td>News Description</td>
                <td><input type="hidden" name="editor_note" id="editor_note"><div id="summernote">{!! $newsdata->news_description !!}</div></td>
              </tr>
              <tr>
                <td><i>support_email</i></td>
                <td>Support Email</td>
                <td><input type="email" class="form-control" name="support_email" required placeholder="Support Email" value="{{$newsdata->support_email}}"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" class="news-add btn btn-info pull-right">Update News</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    
  </div>
</section>
@endsection