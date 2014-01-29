@extends('layouts.user')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')

@section('content')
@if( count( $images ))
<div class="row">
    <div class="col-sm-12">
        <div class="well clearfix">
            <div class="col-xs-12 col-lg-2">
                <span class="btn-group btn-group-justified">
                    <a id="delbut" class="btn btn-danger disabled">Delete selected (0) images</a>
                </span>
            </div>
            <div class="col-sm-12 col-lg-6 hidden-xs">
                <span class="btn-group btn-group-justified">
                    <div class="btn-default btn col-sm-3">Sort By:</div>
                    <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'imageid', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'imageid' ? 'active' : '') }}">Upload Date</a>
                    <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'imagesize', 'order' => $order)) }}" class="btn-default btn {{ ($sort == 'imagesize' ? 'active' : '') }}">Image Size</a>
                    <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'full_views', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'full_views' ? 'active' : '') }}">Image Views</a>
                </span>
            </div>
            <div class=" col-sm-12 col-lg-4 hidden-xs">
                <span class="btn-group btn-group-justified">
                    <div class="btn-default btn col-sm-3">Order:</div>
                    <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'desc')) }}" class="btn-default btn {{ ($order == 'desc' ? 'active' : '') }}">Descending</a>
                    <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'asc')) }}" class="btn-default btn {{ ($order == 'asc' ? 'active' : '') }}">Ascending</a>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <form autocomplete="off" id="imgcontainer">
        @foreach ($images as $image)
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 gallery-img" id="img_{{ Helper::ImageID($image->imageid) }}">
            <div class="thumbnail">
                <div class="wrap-image">
                    <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" alt="" class="img-responsive">
                    <input name="fileid[]" class="chkbox hidden" id="cb" value="{{ Helper::ImageID($image->imageid) }}" type="checkbox" >
                </div>
                <div class="caption">
                    <div class="tools tools-bottom">
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-danger delete-image" id="{{ Helper::ImageID($image->imageid) }}"><i class="glyphicon glyphicon-trash"></i></a>
                            <a href="/v/{{ Helper::ImageID($image->imageid) }}" class="btn btn-default hidden-xs" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
                            <a href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" class="btn btn-default" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}?dl=1" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </form>
</div>
<div class="row text-center">
    {{ $images->appends(array('sort' => $sort, 'order' => $order ))->links() }}
</div>
@else
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="alert alert-warning">
            You don't have any files to show :/<br />
            Create your upload key in the accounts page to get started.
        </div>
    </div>
</div>
@endif
@stop

@section('styles')
<style type="text/css">
.thumbnail img { cursor: pointer; }
.thumbnail.selected { background: #6374AB; }
.tools .btn-group-justified .btn { display:table-cell!important; }
</style>
@stop

@section('navright')
<!--
    <input type="button" id="delbut" class="btn-danger btn btn-small disabled" />
-->
@stop

@section('scripts')
<script>
    var imgcnt = 0;
    $(document).ready(function() {
        $('a.delete-image').bind('click', function() {
            imgid = $(this).attr('id');
            $.ajax({
                url: '/ajax?action=deleteupload',
                method: 'GET',
                data: 'fileid[]=' + imgid
            }).done(function(response) {
                $.each(response, function(idx, file) {
                    removeImage(file.filename);
                });
            }).fail(function() {

            });
        });

        $('.thumbnail img').bind('click', function() {
            $(this).parent().find('input[type=checkbox]').trigger('click');
        });

        $('.wrap-image .chkbox').bind('click', function() {
            if ($(this).parent().parent().hasClass('selected')) {
                $(this).parent().parent().removeClass('selected');
                imgcnt--;
            } else {
                $(this).parent().parent().addClass('selected');
                imgcnt++;
            }

            if (imgcnt == 0)
                $('#delbut').addClass('disabled');
            else
                $('#delbut').removeClass('disabled');

            $('#delbut').html('Delete selected (' + imgcnt + ') images');
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
        if (imgcnt >= 1)
            imgcnt--;

        if (imgcnt == 0)
            $('#delbut').addClass('disabled');

        $('#delbut').html('Delete selected (' + imgcnt + ') images');
    }
</script>
@stop