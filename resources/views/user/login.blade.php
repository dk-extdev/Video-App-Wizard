@extends('layouts.auth')

@section('title', 'User Login')

@section('content')


<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="video-platform-logo">
        </div>
        <h3>Welcome to Video Platform</h3>
        <p>Hello there! Sign in and start becoming a Video Platform!
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Login in. To see it in action.</p>

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

        {!! Form::open(['route'=>'user_login','method'=>'POST']) !!}
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

        <a href="{{ route('user-forget-password') }}"><small>Forgot password?</small></a>
        {!! Form::close() !!}
        <p class="m-t"> <small><strong>Copyright</strong> Video Platform&copy; 2018</small> </p>
    </div>
</div>
@endsection