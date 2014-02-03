<!DOCTYPE html>
<html lang="en">
    <head>
        @section('head')
        <meta charset="utf-8">
        <title>@yield('title', 'Simple image hosting') :: Pic.cm</title>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,400,600,700&amp;lang=en-GB" rel="stylesheet" title="Open Sans Stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <link href="/assets/css/global.css" rel="stylesheet">
        <link href="/assets/css/site.css" rel="stylesheet">
        @yield('styles')
        <link rel="shortcut icon" href="/assets/favicon.ico" />
        @show
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
                @section('navbar')
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Pic.cm</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            @if(Auth::check())
                            <li><a href="/user">Manager</a></li>
                            <li><a href="/user/logout">Logout</a></li>
                            @else
                            <li><a href="/user/login">Login/Register</a></li>
                            @endif
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container -->
                @show
            </nav>
            <div id="main">
            @yield('content')
            </div>
        </div>
        <footer>
            @section('footer')
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="list-inline">
                            <li><a href="/">Home</a></li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li><a href="/tos">Terms of Service</a></li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li><a href="/dmca">DMCA</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-sm-offset-4">
                        <p class="text-muted">Copyright &copy; Pic.cm {{ date('Y') }}. All Rights Reserved</p>
                    </div>
                </div>
            </div>
            @show
        </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        @yield('scripts')
    </body>
</html>