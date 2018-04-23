@extends('admin.layouts.home')

@section('title', 'Create Category')

@section('content')

<section class="content-header">
  <h1>
    Create Category
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-file-archive-o"></i> Home</a></li>
    <li class="active">Create Category</li>
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
          <h3 class="box-title">Create Category</h3>
        </div>
        <div class="box-body">
          <div class="container-fluid">
            <div class="row">
              <table id="newCategory" class="table">
                <thead>
                  <tr>
                    <th>Category Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="text" required="true" class="form-control">
                    </td>
                    <td>
                      <button type="button" id="addCategory" class="form-control add-row btn btn-block btn-info" ><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button id="btnAddCategory" class="btn btn-info pull-right">Add Category</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection