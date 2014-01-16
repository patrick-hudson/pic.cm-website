@extends('layouts.manager')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')

@section('content')
<div class="row">
    <form action="/ajax?action=deleteupload" autocomplete="off">
        @if($images = User::getImages())
        @foreach ($images as $image)
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 gallery-img" id="gal{{ Helper::ImageID($image->imageid) }}">
            <div class="thumbnail" id="img{{$image->imageid}}">
                <div class="wrap-image" id="wrap{{$image->imageid}}">
                    <a class="cboxElement" href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" target="_blank">
                        <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" alt="" class="img-responsive">
                    </a>
                    <input class="chkbox" type="checkbox" name="fileid[]" id="{{$image->imageid}}" value="{{ Helper::ImageID($image->imageid) }}" />
                </div>
                <div class="caption">
                    <div class="tools tools-bottom">
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-danger delete-image" id="{{ Helper::ImageID($image->imageid) }}"><i class="glyphicon glyphicon-trash"></i></a>
                            <a href="/v/{{ Helper::ImageID($image->imageid) }}" class="btn btn-default" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}?dl=1" class="btn btn-default"><i class="glyphicon glyphicon-download"></i></a>
                        </div>
                    </div>
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

@section('navright')
<!--
    <input type="button" id="delbut" class="btn-danger btn btn-small disabled" />
-->
@stop

@section('styles')
<style type='text/css'>
    .selected {
        background-color: rgb(255, 153, 152);
    }
</style>    
@stop

@section('scripts')
<script>
    var imgcnt = 0;
    $(document).ready(function() {
        $('#delbut').attr('value', 'Delete selected (' + imgcnt + ') images');

        $('a.delete-image').click(function() {
            imgid = $(this).attr('id');
            removeImage(imgid);
        });

        $('.chkbox').change(function() {
            if ($(this).is(":checked")) {
                $('#img' + $(this).attr('id')).addClass('selected');
                $('#wrap' + $(this).attr('id')).addClass('selected');
                imgcnt++;
            }
            else {
                $('#img' + $(this).attr('id')).removeClass('selected');
                $('#wrap' + $(this).attr('id')).removeClass('selected');
                imgcnt--;
            }

            if (imgcnt > 0) {
                $('#delbut').attr('value', 'Delete selected (' + imgcnt + ') images').removeClass('disabled');
            } else {
                $('#delbut').attr('value', 'Delete selected (' + imgcnt + ') images').addClass('disabled');
                ;
            }
        });
    });


    function removeImage(imageid) {
        $('#gal' + imageid).fadeOut(500);
    }
</script>
@stop