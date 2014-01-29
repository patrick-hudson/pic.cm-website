<!DOCTYPE html>
<html lang="en">
    <head>
        @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title', 'Simple image hosting') :: Pic.cm</title>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,400,600,700&amp;lang=en-GB" rel="stylesheet" title="Open Sans Stylesheet">
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="/assets/js/bootstrap.js"></script>
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
            @yield('content')
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
    </body>
</html>