@extends('admin.layouts.home')

@section('title', 'Create TemplateVideos')

@section('content')

<section class="content-header">
  <h1>
    Create TemplateVideos
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-file-archive-o"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> TemplateVideos</a></li>
    <li class="active">Create TemplateVideos</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success" style="display:none;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Success ..! </strong> {{ Session::get('success') }}
      </div>
      @if(Session::has('error'))
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
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Create TemplateVideos</h3>
        </div>
        <div class="box-body">
          <div class="container-fluid">
            <div class="row">
              <table id="newTemplateVideos" class="table">
                <thead>
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
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <select name="template_group" class="form-control">
                        @foreach($templategroups as $templategroup) 
                          <option value="{{$templategroup->id}}"
                          >{{$templategroup->project}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <button type="button" id="addTemplateVideos" class="form-control add-row btn btn-block btn-info" ><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button id="btnAddTemplateVideos" class="btn btn-info pull-right">Add TemplateVideos</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection