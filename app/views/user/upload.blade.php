@extends('layouts.user')
@section('title', 'upload Files')
@section('pagetitle', '<h1>Upload Files</h1>')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <form action="/ajax?action=webupload&ajax=true" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" />
                <input type="submit" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>
@stop

@section('styles')
<link rel="stylesheet" href="/assets/plugins/dropzone/css/dropzone.css">
@stop

@section('scripts')
<script src="/assets/plugins/dropzone/dropzone.js"></script>
<script>
    $(document).ready(function() {
        $(".dropzone").dropzone({
            paramName: 'file',
            addRemoveLinks: true,
            maxFilesize: 10.0
        });
    });
</script>
@stop
