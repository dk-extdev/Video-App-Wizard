@extends('layouts.home')

@section('title', 'User Login')

@section('content')

<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin_top_10">
                    <div class="ibox float-e-margins"><div class="ibox-title">
                        <h2>
                            My Purchases
                        </h2>
                    </div>
                    <div class="ibox-content">

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

                        <div class="row">
                            <div class="col-lg-2 wow zoomIn ">
                                <h3 class="m-t-none m-b"><i class="fa fa-user"></i>&nbsp;Youtube</h3>
                                <h3 style="margin-left:16px" class="m-t-none m-b"><a target="_blank" href="{{$youtube}}">@if ($googleInfo) Relink @else Link @endif</a></h3>
                            </div>
                            @if (isset ($googleInfo))
                            <div class="col-lg-1 text-right" style="padding-right:0; margin-left:-100px; margin-top:13px">
                                @if (isset($googleInfo->link))
                                    <a style="border-radius:50%;height:36px;width:36px;display: inline-block;overflow: hidden" target="_blank" href="{{$googleInfo->link}}"><img height="36" width="36" src="{{$googleInfo->picture}}" /></a>
                                @else
                                    <img style="border-radius:50%;height:36px;width:36px;overflow: hidden" height="36" width="36" src="{{$googleInfo->picture}}" />
                                @endif
                            </div>
                            <div class="col-lg-2 wow zoomIn" style="margin-top:10px">
                                {{$googleInfo->name}}<br>
                                {{$googleInfo->email}}
                            </div>
                                @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 wow zoomIn ">
                              <h3 class="m-t-none m-b"><i class="fa fa-user"></i>&nbsp;My Profile</h3>
                              <div class="ibox-content">
                                  {!! Form::open(['route'=>'update_user_info','method'=>'POST','data-parsley-validate'=>'']) !!}
                                  <div class="form-group"><label>Full name</label> <input type="text" placeholder="Full name" class="form-control" value="{{ $current_user_info->name }}" name="full_name" required data-parsley-required-message="Full name is required" data-parsley-trigger="change"></div>
                                  <div class="form-group"><label>Email address</label> <input type="email" placeholder="Enter email" class="form-control" value="{{ $current_user_info->email }}" readonly=""  name="email" required></div>
                                  <div class="form-group"><label>Phone number</label> <input type="text" placeholder="Phone number" class="form-control" value="{{ $current_user_info->phone }}"  name="phone" required data-parsley-required-message="Phone number is required" data-parsley-trigger="change"></div>
                                  <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong><i class="fa fa-check"></i>&nbsp;Update</strong></button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-lg-6 wow zoomIn">
                          <h3 class="m-t-none m-b"><i class="fa fa-lock"></i>&nbsp;Change Password</h3>
                          <div class="ibox-content">
                              {!! Form::open(['route'=>'update_user_password','method'=>'POST','data-parsley-validate'=>'']) !!}
                              <div class="form-group"><label>Current password</label> <input type="password" class="form-control"  name="old_password" required data-parsley-required-message="Current password is required" data-parsley-trigger="change"></div>
                              <div class="form-group"><label>New password</label> <input id="new_password" type="password" class="form-control" name="new_password" required data-parsley-required-message="New password is required" data-parsley-trigger="change"></div>
                              <div class="form-group"><label>New password confirm</label> <input type="password" class="form-control" name="conf_password" required data-parsley-required-message="New password confirm is required" data-parsley-equalto="#new_password" data-parsley-equalto-message="New password confirm should be equal to New Password"></div>
                              <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong><i class="fa fa-check"></i>&nbsp;Update</strong></button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div><!--ibox-content-->
        </div><!--ibox-->
    </div>


</div>
</div>
</section>

</div>


@endsection