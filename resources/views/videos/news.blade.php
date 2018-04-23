@extends('layouts.home')

@section('title', 'Lastest News&Updates')

@section('content')

<div class="gt_main_content_wrap">
    <section class="gt_about_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel_custom_1">
                        <div class="panel-heading">WELCOME TO VIDEOPLATFORM</div>
                        <div class="panel-body">
                            <table id="newsTable" class="listing_front_tbl ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usernews as $usernews)
                                    <tr class="search-result">
                                        <td><h3>{{ $usernews->news_title }}</h3></td>
                                        <td>{!! $usernews->news_description !!}</td>
                                        <td>{{ $usernews->updated_at }} by <a href="mailto:{{ $usernews->support_email }}" target="_top">{{ $usernews->app_name }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <iframe src="https://player.vimeo.com/video/261272493" width="640" height="346" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

</div>


@endsection