@extends('layouts.manager')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')

@section('content')
<div class="row">
    <form autocomplete="off" id="imgcontainer">
        @if($images = User::getImages())
        @foreach ($images as $image)
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 gallery-img" id="img_{{ Helper::ImageID($image->imageid) }}">
            <div class="thumbnail">
                <div class="wrap-image">
                    <a href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" target="_blank">
                        <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" alt="" class="img-responsive">
                    </a>
                    <input name="fileid[]" class="chkbox" id="cb" value="{{ Helper::ImageID($image->imageid) }}" type="checkbox">
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
<li class="search-box">
    <input id="delbut" class="btn btn-danger btn-sm" type="button" />
</li>
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

        $('.wrap-image .chkbox').bind('click', function() {
            if ($(this).parent().hasClass('selected')) {
                $(this).parent().removeClass('selected').removeClass('selected');
                imgcnt--;
            } else {
                $(this).parent().addClass('selected');
                imgcnt++;
            }
            $('#delbut').attr('value', 'Delete selected (' + imgcnt + ') images');
        });
    });

    $('#delbut').click(function() {
        $.ajax({
            url: '/ajax?action=deleteupload',
            method: 'GET',
            data: $('#imgcontainer').serialize()
        }).done(function(response) {
            $.each(response, function(idx, file) {
                removeImage(file.filename);
            });
        }).fail(function() {

        });

        return false; // avoid to execute the actual submit of the form.
    });


    function removeImage(imageid) {
        $('#img_' + imageid).fadeOut(500);
    }
</script>
@stop