<!DOCTYPE html>
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Login :: Pic.cm</title>
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        
        <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/fonts/style.css">
        <link rel="stylesheet" href="/assets/css/main.css">
        <link rel="stylesheet" href="/assets/css/main-responsive.css">
        <link rel="stylesheet" href="/assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="/assets/css/manager.css" type="text/css" id="skin_color">
        <link rel="stylesheet" href="/assets/css/print.css" type="text/css" media="print"/>
        <!--[if IE 7]>
        <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
    </head>
    <body class="login" style="background-image: url('/assets/images/bg_2.png');">
        <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="logo"><a href="/">Pic<i>.</i>cm</a></div>
            <div class="box-login">
                @yield('content')
            </div>
            <div class="copyright">

            </div>
        </div>
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="/assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="/assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="/assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="/assets/js/main.js"></script>
        <script src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="/assets/js/login.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        @yield('scripts')
    </body>
</html>