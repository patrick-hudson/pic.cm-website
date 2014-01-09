
<!DOCTYPE html>
<html lang="en">
    <head>
        @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Landing Page Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">

        <!-- Custom Google Web Font -->
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        @show
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Piccm</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/register">Register</a></li>
                        <li><a href="/manage">Manage</a></li>
                        <li><a href="/download">Download</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
        @yield('content', 'Container content not set')
        <footer>
            @section('footer')
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-inline">
                            <li><a href="/">Home</a></li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li><a href="/tos">Terms of Service</a></li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li><a href="/dmca">DMCA</a></li>
                        </ul>
                        <p class="copyright text-muted small">Copyright &copy; Your Company 2013. All Rights Reserved</p>
                    </div>
                </div>
            </div>
            @show
        </footer>

        <!-- JavaScript -->
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="/assets/js/bootstrap.js"></script>

    </body>
</html>