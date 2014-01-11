@extends('layouts.manager')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')
@section('content')
<div class="col-md-3 col-sm-4 gallery-img">
    <div class="wrap-image">
        <a class="group1" href="assets/images/image01.jpg" title="Clip-One Business Card">
            <img src="assets/images/image01.jpg" alt="" class="img-responsive">
        </a>
        <div class="chkbox"></div>
        <div class="tools tools-bottom">
            <a href="#">
                <i class="clip-link-4"></i>
            </a>
            <a href="#">
                <i class="clip-pencil-3 "></i>
            </a>
            <a href="#">
                <i class="clip-close-2"></i>
            </a>
        </div>
    </div>
</div>

@stop