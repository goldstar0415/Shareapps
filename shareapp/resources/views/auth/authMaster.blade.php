<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
    <meta charset="utf-8" />
    <title>Share Apps | Promote Mobile Apps - @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ cdn('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ cdn('assets/global/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ cdn('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ cdn('assets/pages/css/login-5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ cdn('css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    @yield('customcss')
    <!-- END THEME LAYOUT STYLES -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{cdn('assets/pages/img/login/favicon1.png')}}">
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5"style="background-color: #000;">
            <div class="row bs-reset">
                <div class="col-md-6 login-container bs-reset loginpage-video-div" style="background-color: #fff;">
                    <div class="login-content col-md-12" style="padding-bottom:20px;">
                      <div class="row">
                        <div class="col-xs-6 col-xs-offset-3" style="text-align:center;margin-bottom:110px;">
                          <img style="width:100px;" src="{{cdn('assets/pages/img/login/favicon.png')}}">
                        </div>
                      </div>
                        @yield('content')
                    </div>
                    <div class="col-md-12 footer-div-new-design-col visibility-hide" style="display: none;">
                      <div class="login-footer" style="padding:10px 20px;">
                        <div class="row bs-reset">
                            <div class="col-sm-12 bs-reset" style="text-align:center;">
                                <div class="login-copyright" style="display:inline-block;padding:0;text-align:center;">
                                    <p><a href="{{url('terms-and-condition')}}" target="_blank">Terms & Conditions</a> | <a href="{{url('privacy-policy')}}" target="_blank"> Privacy policy</a> | <a>How it works</a> | <a href="{{url('about-us')}}" target="_blank">About Us</a> | <a>Contact Us</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="row bs-reset">
                            <div class="col-sm-12 bs-reset" style="text-align:center;">
                                <div class="login-copyright text-right" style="display:inline-block;padding:0;">
                                    <p>Copyright &copy; ShareAd Group - Coremobile Projects.</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-6 bs-reset">
                    <div class="login-bg">
                      <div class="login-page-video-div">
                        <video id="background-video" preload="auto" loop="loop" autoplay="true" style="width:100%;" muted="muted">
                            <source src="{{cdn('assets/pages/video/shareappvideo.mp4')}}" type="video/mp4">
                        </video>
                        <img class="login-register-page-logo" src="{{cdn('assets/pages/img/login/Share_App_Logo.png')}}">
                      </div>
                    </div>
                    <div class="col-md-12 footer-div-new-design-col visibility-show">
                      <div class="login-footer" style="padding:10px 20px;">
                        <div class="row bs-reset">
                            <div class="col-sm-12 bs-reset" style="text-align:center;">
                                <div class="login-copyright" style="display:inline-block;padding:0;text-align:center;">
                                    <p><a href="{{url('terms-and-condition')}}" target="_blank">Terms & Conditions</a> | <a href="{{url('privacy-policy')}}" target="_blank"> Privacy policy</a> | <a>How it works</a> | <a href="{{url('about-us')}}" target="_blank">About Us</a> | <a>Contact Us</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="row bs-reset">
                            <div class="col-sm-12 bs-reset" style="text-align:center;">
                                <div class="login-copyright text-right" style="display:inline-block;padding:0;">
                                    <p>Copyright &copy; ShareAd Group - Coremobile Projects.</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ cdn('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ cdn('assets/global/scripts/app.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ cdn('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
        <script src="{{ cdn('js/custom.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
