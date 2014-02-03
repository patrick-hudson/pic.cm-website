<!DOCTYPE html>
<html lang="en">
    <head>
        @section('head')
        <meta charset="utf-8">
        <title>@yield('title', 'Simple image hosting') :: Pic.cm</title>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,400,600,700&amp;lang=en-GB" rel="stylesheet" title="Open Sans Stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link href="/assets/css/global.css" rel="stylesheet">
        <link href="/assets/css/auth.css" rel="stylesheet">
        @yield('styles')
        <link rel="shortcut icon" href="/assets/favicon.ico" />
        @show
    </head>
</head>
<body>
    <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="login-box clearfix">
                    <div class="login-logo">
                        <a href="/"><img src="/assets/images/logo-med.png" /></a>
                    </div>
                    <hr />
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        @if(count(Session::get('error')) > 1)
                        @foreach(Session::get('error') as $error)
                        <b>{{ $error }}</b><br />
                        @endforeach
                        @else
                        <b>{{ Session::get('error') }}</b>
                        @endif
                    </div>
                    @endif
                    @if(Session::has('notice'))
                    <div class="alert alert-info">
                        @if(count(Session::get('notice')) > 1)
                        @foreach(Session::get('notice') as $notice)
                        <b>{{ $notice }}</b><br />
                        @endforeach
                        @else
                        <b>{{ Session::get('notice') }}</b>
                        @endif
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>