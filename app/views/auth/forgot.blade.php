
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3 Version: 1.2.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Forgot Password :: Pic.cm</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
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
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login example1">
        <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="logo"><a href="/">Pic<i>.</i>cm</a></div>
            <!-- start: FORGOT BOX -->
            <div class="box-forgot">
                <h3>Forget Password?</h3>
                <p>
                    Enter your e-mail address below to reset your password.
                </p>
                <form class="form-forgot" action="/m/forgot" method="post">
                    <input type="hidden" name="action" value="forgot">
                    <div class="errorHandler alert alert-danger no-display">
                        <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                    </div>
                    @if(Session::has('message'))
                    <div class="alert alert-info">
                        <b>{{ Session::get('message') }}</b>
                    </div>
                    @endif
                    <fieldset>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <i class="fa fa-envelope"></i> </span>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-light-grey go-back">
                                <i class="fa fa-circle-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-bricky pull-right">
                                Submit <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- end: FORGOT BOX -->
            <!-- start: COPYRIGHT -->
            <div class="copyright">

            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
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
        <script>
jQuery(document).ready(function() {
    Main.init();
    Login.init();
});
        </script>
    </body>
    <!-- end: BODY -->
</html>