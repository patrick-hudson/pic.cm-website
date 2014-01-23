@extends('layouts.user')
@section('title', 'User Uploads')
@section('pagetitle', '<h1>Uploaded images</h1>')

@section('content')
@if( $images = User::getImages(Input::get('userid'), 25) )
@endif
@if(count($images) > 0)
<div class="row">
    <div class="col-sm-12">
        <table class="table table-hover table-bordered">
            @foreach ($images as $image)
            <tr>
                <td class="col-sm-4 col-md-2">
                    <a href="/v/{{ Helper::ImageID($image->imageid) }}">
                        <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" class="img-responsive col-sm-12" />
                    </a>
                </td>
                <td class="col-sm-4 col-md-6">
                    <ul>
                        <li>File size: {{ Helper::formatBytes($image->imagesize) }}</li>
                        <li>Upload Date: {{ $image->uploaddate }}</li>
                        <li>Total Views: {{ $image->full_views }}</li>
                        <li>Thumbnail Views: {{ $image->thumb_views }}</li>
                        <li>Estimated Bandwidth: {{ Helper::formatBytes($image->imagesize * $image->full_views) }}</li>
                    </ul>
                </td>
                <td class="col-sm-4 col-md-4"></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row text-center">
    {{ $images->appends(array('userid' => Input::get('userid')))->links() }}
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
@stop

@section('breadcrumb')
@stop

@section('navright')
@stop

@section('styles')
<style type='text/css'>
    .selected {
        background-color: rgb(255, 153, 152);
    }
</style>    
@stop

@section('scripts')

@stop