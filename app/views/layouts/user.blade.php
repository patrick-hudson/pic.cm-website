<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <title>@yield('title', 'Simple image hosting') :: Manager :: Pic.cm</title>
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/assets/css/main.css" />
        <link rel="stylesheet" href="/assets/css/main-responsive.css" />
        <link rel="stylesheet" href="/assets/plugins/iCheck/skins/all.css" />
        <link rel="stylesheet" href="/assets/css/manager.css" type="text/css" />
        <link rel="stylesheet" href="/assets/css/print.css" type="text/css" media="print" />
        <!--[if IE 7]>
        <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css">
        <![endif]-->
        <link rel="shortcut icon" href="/assets/favicon.ico" />
        @yield('styles')
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <a class="navbar-brand" href="/user">
                        Pic.cm Manager
                    </a>
                </div>
                <div class="navbar-tools">
                    <ul class="nav navbar-right">
                        @yield('navright')
                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <img src="{{ Helper::get_gravatar(Auth::User()->email, 30) }}" class="circle-img" alt="">
                                <span class="username">{{ Auth::User()->username }}</span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/user/logout">
                                        <i class="clip-exit"></i>
                                        &nbsp;Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-container">
            <div class="navbar-content">
                <div class="main-navigation navbar-collapse collapse">
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>
                    <ul class="main-navigation-menu">
                        <li class="open">
                            <a href="javascript:void(0)"><i class="clip-user"></i>
                                <span class="title"> Dashboard </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>
                            <ul style="display: block;" class="sub-menu">
                                <li>
                                    <a href="{{ action('UserController@doDashboard') }}"><i class="glyphicon glyphicon-home"></i>
                                        <span class="title"> Uploaded Images </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ action('UserController@uploadFiles') }}"><i class="glyphicon glyphicon-upload"></i>
                                        <span class="title"> Upload Image </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ action('UserController@accountSettings') }}"><i class="glyphicon glyphicon-cog"></i>
                                        <span class="title"> Account </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Entrust::hasRole('Administrator'))
                        <li class="open">
                            <a href="javascript:void(0)"><i class="clip-globe"></i>
                                <span class="title"> Administration </span><i class="icon-arrow"></i>
                                <span class="selected"></span>
                            </a>
                            <ul style="display: block;" class="sub-menu">
                                <li>
                                    <a href="{{ action('AdminController@doDashboard') }}"><i class="clip-home-3"></i>
                                        <span class="title"> Dashboard </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@listUsers') }}"><i class="clip-user-2"></i>
                                        <span class="title"> Users </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ action('AdminController@listUserImages', array('userid' => -1)) }}"><i class="clip-bulb"></i>
                                        <span class="title"> All uploads </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                </div>
            </div>

            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                            <div class="page-header">
                                @yield('pagetitle')
                            </div>
                        </div>
                    </div>
                    <noscript>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-center">
                            <div class="alert alert-block alert-danger">
                                Some features of the site will not work with <strong>javascript disabled</strong><br />
                                for the best user experience please <strong>enable javascript</strong>
                            </div>
                        </div>
                    </div>
                    </noscript>
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        @foreach(Session::get('error') as $error)
                        <b>{{ $error }}</b><br />
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('notice'))
                    <div class="alert alert-info">
                        <b>{{ Session::get('notice') }}</b><br />
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
        @section('footer')
        <div class="footer clearfix">
            <div class="footer-inner">
                2014 &copy; {{ link_to('/', 'Pic.cm') }}
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        @show
        <!--[if lt IE 9]>
        <script src="/assets/plugins/respond.min.js"></script>
        <script src="/assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="/assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="/assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="/assets/plugins/less/less-1.5.0.min.js"></script>
        <script>
$(document).ready(function() {
    $windowWidth = $(window).width();
    $windowHeight = $(window).height();
    $pageArea = $windowHeight - $('body > .navbar').outerHeight() - $('body > .footer').outerHeight();
    $('.sidebar-search input').removeAttr('style').removeClass('open');
    mainContainer = $('.main-content > .container');
    mainNavigation = $('.main-navigation');
    if ($pageArea < 760) {
        $pageArea = 760;
    }
    if (mainContainer.outerHeight() < mainNavigation.outerHeight() && mainNavigation.outerHeight() > $pageArea) {
        mainContainer.css('min-height', mainNavigation.outerHeight() - 2);
    } else {
        mainContainer.css('min-height', $pageArea - 2);
    }
});
        </script>

        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        @yield('scripts')
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    </body>
    <!-- end: BODY -->
</html>