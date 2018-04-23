@extends('admin.layouts.home')

@section('title', 'Edit TemplateVideos')

@section('content')

<section class="content-header">
  <h1>
    Edit Template
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-file-archive-o"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> TemplateVideos</a></li>
    <li class="active">Edit TemplateVideos</li>
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
      {{ Form::open(array('method'=>'POST','route' => array('admin_update_templatevideos', $templatevideo->id))) }}
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Update TemplateVideo</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <colgroup>
                <col width="20%">
                <col width="20%">
                <col width="40%">
                <col width="20%">
              </colgroup>
              <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Url</th>
                <th>Template Group</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select name="category" class="form-control">
                    @foreach($categories as $category) 
                      <option value="{{$category->id}}"
                      @if ($category->id == $templatevideo->category_id)
                          selected="selected"
                      @endif
                      >{{$category->name}}</option>
                    @endforeach
                  </select>
                </td>
                <td><input type="text"  class="form-control" name="templatevideo_name" required value="{{$templatevideo->name}}"></td>
                <td><input type="text"  class="form-control" name="templatevideo_url" required value="{{$templatevideo->url}}"></td>
                <td>
                  <select name="template_group" class="form-control">
                    @foreach($templategroups as $templategroup) 
                      <option value="{{$templategroup->id}}"
                      @if ($templategroup->id == $templatevideo->template_group_id)
                          selected="selected"
                      @endif
                      >{{$templategroup->project}}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" class="news-add btn btn-info pull-right">Update TemplateVideos</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</section>
@endsection