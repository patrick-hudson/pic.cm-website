@extends('layouts.site')
@section('title', 'Home')
@section('content')
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>Pic.cm</h1>
                    <h3>Share Instantly</h3>
                    <hr class="intro-divider">
                    <a href="/download?os=win" class="btn btn-success btn-lg">
                        Download for windows (Vista/7/8/9)
                    </a>
                </div>	
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @for ($i = 99500; $i < 100000; $i++)
        <div class="col-md-2 panel-default">
            <div class="panel-body">
                Image ID: {{ Helper::alphaID($i) }} <br /> Numeric ID: {{ Helper::alphaID(Helper::alphaID($i), true) }}
            </div>
        </div>
        @endfor
    </div>
</div>
@stop