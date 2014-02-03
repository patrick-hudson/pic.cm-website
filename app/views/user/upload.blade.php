@extends('layouts.user')
@section('title', 'Ypload Files')
@section('pagetitle', '<h1>Upload Files</h1>')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 list-group">

        </div>
        <form action="/ajax?action=webupload&ajax=true" class="dropzone col-md-9">
            
        </form>
    </div>
</div>
@stop

@section('styles')

@stop

@section('scripts')
<script src="/assets/js/upload.js"></script>
<script>
    var Dropzone = function() {
        var runDropzone = function() {
            $(".dropzone").dropzone({
                paramName: "file",
                maxFilesize: 5.0
            });
        };
        return {
            init: function() {
                runDropzone();
            }
        };
    }();
</script>
@stop
