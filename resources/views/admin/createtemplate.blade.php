@extends('admin.layouts.home')

@section('title', 'Create Template')

@section('content')

<section class="content-header">
  <h1>
    Create Template
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-file-archive-o"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Template</a></li>
    <li class="active">Create Template</li>
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
          <h3 class="box-title">Create Template</h3>
        </div>
        <div class="box-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Project:</label>
                  <input type="text" id="project" name="project" required="true" class="form-control">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" checked value="" id="template_flag">
                  <label class="form-check-label" for="template_flag">
                    Flag(Show Template)
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="box-header">
                <h4 class="box-title">Template Fields</h4>
              </div>
              <table id="newTemplate" class="table">
                <cols>
                  <col width = "20%" >
                  <col width = "20%" >
                  <col width = "15%" >
                  <col width = "15%" >
                  <col width = "30%" >
                </cols>
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Html Label</th>
                    <th>Type</th>
                    <th>Validation Rules</th>
                    <th>Default Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <select class="form-control color-picker">
                        <option >Text</option>
                        <option >File</option>
                        <option >File Video</option>
                        <option >File Music</option>
                        <option >Color Picker</option>
                        <option >Outro</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <button type="button" id="addTemplate" class="form-control add-row btn btn-block btn-info" ><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button id="btnAddTemplate" class="btn btn-info pull-right">Add Template</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection