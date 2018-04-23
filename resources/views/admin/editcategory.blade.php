@extends('admin.layouts.home')

@section('title', 'Edit Category')

@section('content')

<section class="content-header">
  <h1>
    Edit Category
  </h1>
  <ol class="breadcrumb">
    <li class="treeview menu-open"><a href="{{ route('admin_dashboard') }}"><i class="fa fa-file-archive-o"></i> Home</a></li>
    <li class="active">Edit Category</li>
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
      {{ Form::open(array('method'=>'POST','route' => array('admin_update_category', $category->id))) }}
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Update Category</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <colgroup>
                <col width="80%">
              </colgroup>
              <tr>
                <th>Category Name</th>
            </thead>
            <tbody>
              <tr>
                <td><input type="text"  class="form-control" name="category_name" required value="{{$category->name}}"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" class="news-add btn btn-info pull-right">Update Category</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</section>
@endsection