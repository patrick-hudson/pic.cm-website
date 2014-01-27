@extends('layouts.user')
@section('title', 'Dashboard')
@section('pagetitle', '<h1>Dashboard <small>Uploaded images</small></h1>')

@section('content')
@if( count( $images ))
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <input id="delbut" class="btn btn-danger disabled" type="button" value="Delete selected (0) images"/>
            <span class="btn-group">
                <div class="btn-default btn">Sort By:</div>
                <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'imageid', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'imageid' ? 'active' : '') }}">Upload Date</a>
                <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'imagesize', 'order' => $order)) }}" class="btn-default btn {{ ($sort == 'imagesize' ? 'active' : '') }}">Image Size</a>
                <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => 'full_views', 'order' => $order )) }}" class="btn-default btn {{ ($sort == 'full_views' ? 'active' : '') }}">Image Views</a>
            </span>
            <span class="btn-group">
                <div class="btn-default btn">Order:</div>
                <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'desc')) }}" class="btn-default btn {{ ($order == 'desc' ? 'active' : '') }}">Descending</a>
                <a href="{{ action('UserController@doDashboard', array( 'page' => Input::get('page'), 'sort' => $sort, 'order' => 'asc')) }}" class="btn-default btn {{ ($order == 'asc' ? 'active' : '') }}">Ascending</a>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <form autocomplete="off" id="imgcontainer">
        @foreach ($images as $image)
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 gallery-img" id="img_{{ Helper::ImageID($image->imageid) }}">
            <div class="thumbnail">
                <div class="wrap-image">
                    <a href="/i/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" target="_blank">
                        <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" alt="" class="img-responsive">
                    </a>
                    <input name="fileid[]" class="chkbox checkbox" id="cb" value="{{ Helper::ImageID($image->imageid) }}" type="checkbox" >
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

@section('breadcrumb')

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
        $('a.delete-image').click(function() {
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

        $('.wrap-image .chkbox').bind('click', function() {
            if ($(this).parent().hasClass('selected')) {
                $(this).parent().removeClass('selected').removeClass('selected');
                imgcnt--;
            } else {
                $(this).parent().addClass('selected');
                imgcnt++;
            }
            
            if (imgcnt == 0)
                $('#delbut').addClass('disabled');
            else
                $('#delbut').removeClass('disabled');
            
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
        if (imgcnt >= 1)
            imgcnt--;

        if (imgcnt == 0)
            $('#delbut').addClass('disabled');

        $('#delbut').attr('value', 'Delete selected (' + imgcnt + ') images');
    }
</script>
@stop