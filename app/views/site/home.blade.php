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
        <div class="col-lg-6">
            <h2 id="type-blockquotes">Latest Tweets</h2>
            <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
            </blockquote>
        </div>
        <div class="col-lg-6">
            <div class="bs-example">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">List group item heading</h4>
                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop