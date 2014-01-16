@extends('layouts.site')
@section('title', $imageid . ' :: Viewing image')
@section('content')
<div class="viewer-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <center>
                    <a href="/i/{{ $imageid }}.{{ $image[0]->mimetype }}">
                        <img src="/i/{{ $imageid }}.{{ $image[0]->mimetype }}" class="thumbnail">
                    </a>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_stumbleupon"></a>
                <a class="addthis_button_google_plusone_share"></a>
                <a class="addthis_button_blogger"></a>
                <a class="addthis_button_reddit"></a>
                <a class="addthis_button_tumblr"></a>
                <a class="addthis_button_pinterest_share"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52d6a30a31d9c832"></script>
            <!-- AddThis Button END -->
        </div>
        <div class="col-sm-4">
            Views: {{ $image[0]->full_views }} - Estimated Bandwidth: {{ Helper::formatBytes(($image[0]->imagesize * $image[0]->full_views), 2) }}
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-6 form-horizontal">
            <h4>Direct Share Links</h4>
            <div class="form-group">
                <label for="linkImageDirect" class="col-sm-3 control-label">Full Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="linkDirect" value="{{ url('/i/'. $imageid .'.'. $image[0]->mimetype) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="linkThumbDirect" class="col-sm-3 control-label">Thumbnail Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="linkThumbDirect" value="{{ url('/i/'. $imageid .'.'. $image[0]->mimetype) }}">
                </div>
            </div>
        </div>
        <div class="col-sm-6 form-horizontal">
            <h4>HTML Embed Code</h4>
            <div class="form-group">
                <label for="htmlImage" class="col-sm-3 control-label">Full Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="htmlImage" value="<a href=&quot;{{ url('/v/'. $imageid) }}&quot;><img src=&quot;{{ url('/i/'. $imageid .'.'. $image[0]->mimetype) }}&quot; alt=&quot;{{ $imageid .'.'. $image[0]->mimetype }}&quot; border=&quot;0&quot; /></a>">
                </div>
            </div>
            <div class="form-group">
                <label for="htmlThumb" class="col-sm-3 control-label">Thumbnail Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="htmlThumb" value="<a href=&quot;{{ url('/v/'. $imageid) }}&quot;><img src=&quot;{{ url('/t/'. $imageid .'.'. $image[0]->mimetype) }}&quot; alt=&quot;{{ $imageid .'.'. $image[0]->mimetype }}&quot; border=&quot;0&quot; /></a>">
                </div>
            </div>
        </div>
        <div class="col-sm-6 form-horizontal">
            <h4>BBCode Embed Code</h4>
            <div class="form-group">
                <label for="bbImage" class="col-sm-3 control-label">Full Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="bbImage" value="[URL={{ url('/v/'. $imageid) }}][IMG]{{ url('/i/'. $imageid .'.'. $image[0]->mimetype) }}[/IMG][/URL]">
                </div>
            </div>
            <div class="form-group">
                <label for="bbThumb" class="col-sm-3 control-label">Thumbnail Image</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="bbThumb" value="[URL={{ url('/v/'. $imageid) }}][IMG]{{ url('/t/'. $imageid .'.'. $image[0]->mimetype) }}[/IMG][/URL]">
                </div>
            </div>
        </div>
    </div>
</div>
@stop