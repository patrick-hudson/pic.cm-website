@extends('layouts.manager')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')
@section('content')
<div class="row">
    @if($images = User::getImages())
    @foreach ($images as $image)
    <div class="col-md-3 col-sm-4 gallery-img">
        <div class="wrap-image">
            <a class="group1" href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}">
                <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" alt="" class="img-responsive">
            </a>
            <div class="tools tools-bottom">
                <a href="#"><i class="clip-close-2"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@stop

@section('breadcrumb')
<li>You currently have {{ count($images); }} files</li>
@stop