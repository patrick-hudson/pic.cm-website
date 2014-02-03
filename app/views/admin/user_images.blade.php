@extends('layouts.user')
@section('title', 'User Uploads')
@section('pagetitle', '<h1>Uploaded images</h1>')

@section('content')

@if(count($images) > 0)
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="well clearfix">
                <div class="col-sm-12 col-lg-7 hidden-xs">
                    <span class="btn-group btn-group-justified">
                        <div class="btn-default btn col-sm-3">Sort By:</div>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => Input::get('userid'), 'page' => Input::get('page'), 'sort' => 'imageid', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'imageid' ? 'active' : '') }}">Upload Date</a>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => Input::get('userid'), 'page' => Input::get('page'), 'sort' => 'imagesize', 'order' => $order)) }}" class="btn-default btn {{ ($sort == 'imagesize' ? 'active' : '') }}">Image Size</a>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => Input::get('userid'), 'page' => Input::get('page'), 'sort' => 'full_views', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'full_views' ? 'active' : '') }}">Image Views</a>
                    </span>
                </div>
                <div class=" col-sm-12 col-lg-5 hidden-xs">
                    <span class="btn-group btn-group-justified">
                        <div class="btn-default btn col-sm-3">Order:</div>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => Input::get('userid'), 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'desc')) }}" class="btn-default btn {{ ($order == 'desc' ? 'active' : '') }}">Descending</a>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => Input::get('userid'), 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'asc')) }}" class="btn-default btn {{ ($order == 'asc' ? 'active' : '') }}">Ascending</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <ul class="list-group">
                @foreach ($images as $image)
                <li class="list-group-item clearfix">
                    <div class="col-sm-4 col-md-2">
                        <a href="/v/{{ Helper::ImageID($image->imageid) }}">
                            <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" class="img-responsive col-sm-12" />
                        </a>
                    </div>
                    <div class="col-sm-8 col-md-10">
                        <div class="col-sm-4">
                            <ul>
                                <li>File size: {{ Helper::formatBytes($image->imagesize) }}</li>
                                @if(Input::get('userid') == -1)
                                <li>Uploaded by: <a href="{{ action('AdminController@listUserImages', array('userid' => $image->userid)) }}">{{ User::find($image->userid)->username }}</a></li>
                                @endif
                                <li>Upload Date: {{ $image->uploaddate }}</li>
                                <li>Total Views: {{ $image->full_views }}</li>
                                <li>Estimated Bandwidth: {{ Helper::formatBytes($image->imagesize * $image->full_views) }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-8">
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row text-center">
        {{ $images->appends(array('userid' => Input::get('userid'), 'sort' => $sort, 'order' => $order ))->links() }}
    </div>
    @else
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="alert alert-warning">
                This user has no images to display
            </div>
        </div>
    </div>
    @endif
</div>
@stop

@section('styles')

@stop

@section('scripts')

@stop