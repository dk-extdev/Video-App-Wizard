@extends('layouts.home')

@section('title', 'Insert Video')

@section('content')
<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>
                            <a href="/create_videos">Create Video</a> | Insert Video
                        </h2>
                    </div>
                    @if (session()->has('error'))
                        <div class="ibox-content">
                    @else
                        <div>
                    @endif
                        <div class="row">
                            <div class="col-md-12">
                                @if (session()->has('message'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
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
                            </div>
                        </div>
                    </div>

                    <div class="ibox-content ">
                        {!! Form::open(['route'=>'insert_video','method'=>'POST','data-parsley-validate'=>'']) !!}
                        <div class="row">
                            <div class="col-lg-4 text-right" style="padding-top:6px">
                                <label>Youtube Url</label>
                            </div>
                            <div class="col-lg-3 wow zoomIn ">
                                <div class="form-group"><input id="startTime" type="text" placeholder="" class="form-control" value="" name="youtubeUrl" required data-parsley-required-message="Start time is required" data-parsley-trigger="change"></div>
                            </div>
                            <div class="col-lg-1 text-left " style="padding-top:6px">
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong><i class="fa fa-check"></i>&nbsp;Insert</strong></button>
                            </div>
                            <div class="col-lg-4 wow zoomIn ">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>

@endsection