@extends('layouts.user')
@section('title', 'Admin Dashboard')
@section('pagetitle', '<h1>Admin Dashboard</h1>')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-book"></i>
                    Image Stats
                </div>
                <div class="panel-body">
                    @if($stats = User::userStats())
                    <table class='table table-bordered table-stripe'>
                        <tr>
                            <th class="col-md-4">Total Images</th>
                            <td>{{ $stats[0]->totalimg }}</td>
                        </tr>
                        <tr>
                            <th>Space Used</th>
                            <td>{{ Helper::formatBytes($stats[0]->totalsize) }}</td>
                        </tr>
                        <tr>
                            <th>Total Thumbnail Views</th>
                            <td>{{{ $stats[0]->totalthmbviews ? $stats[0]->totalthmbviews : '0' }}}</td>
                        </tr>
                        <tr>
                            <th>Total Image Views</th>
                            <td>{{{ $stats[0]->totalimgviews ? $stats[0]->totalimgviews : '0' }}}</td>
                        </tr>
                        <tr>
                            <th>Estimated Bandwidth</th>
                            <td>{{{ $stats[0]->totalimgviews ? Helper::formatBytes($stats[0]->totalsize * $stats[0]->totalimgviews) : '0 Bytes' }}}</td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-arrow-up"></i>
                    Last 5 Uploads
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($images as $image)
                        <li class="list-group-item clearfix">
                            <div class="col-sm-3">
                                <a href="/v/{{ Helper::ImageID($image->imageid) }}">
                                    <img src="/t/{{ Helper::ImageID($image->imageid) }}.{{ $image->mimetype }}" class="img-responsive" style="max-width: 100px;" />
                                </a>
                            </div>
                            <div class="col-sm-9">
                                <ul>
                                    <li>Uploaded by: {{ $image->username }} <small>({{long2ip($image->address)}})</small></li>
                                    <li>Time Uploaded: {{ $image->uploaddate }} <small>UTC</small></li>
                                    <li>File Size: {{ Helper::formatBytes($image->imagesize) }}</li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop