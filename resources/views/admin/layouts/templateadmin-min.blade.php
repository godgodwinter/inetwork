<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from colorlib.com//polygon/adminty/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jan 2019 06:19:49 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>{{ ucfirst(config('app.name'))}} @yield('title') </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="https://colorlib.com//polygon/adminty/files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset("admin-style/") }}/files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset("admin-style/") }}/files/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("admin-style/") }}/files/assets/css/style.css">

    @yield('csshere')
</head>
<body>
    {{-- <script>
        swal("Hello world!");
    </script> --}}
    {{-- <script>
        $(document).ready(function(){
            $("button").click(function(){
              if (typeof jQuery != 'undefined') {
                alert(jQuery.fn.jquery);
                alert($().jquery);
                alert($()['jquery']);
                alert($.ui.version);
              }
            });
        });
      </script>
    <button>Check jQuery version</button> --}}
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
                @yield('nav_head')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                        @yield('menu')
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    @yield('headernav')
                                    @yield('notif')
                                    @yield('container')
                                </div>
                                {{-- <div id="styleSelector">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/jquery/js/jquery.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/popper.js/js/popper.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    @yield('jshere')
    <!-- j-pro js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/jquery.ui.min.js">
    </script>

    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/assets/pages/j-pro/js/custom/currency-form.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/modernizr/js/modernizr.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/modernizr/js/css-scrollbars.js"></script>

    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/i18next/js/i18next.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset("admin-style/") }}/files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script src="{{ asset("admin-style/") }}/files/assets/pages/data-table/js/data-table-custom.js"></script>
    <!-- notification js -->
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/js/bootstrap-growl.min.js"></script>

    <script src="{{ asset("admin-style/") }}/files/assets/js/pcoded.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/js/vartical-layout.min.js"></script>
    <script src="{{ asset("admin-style/") }}/files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/js/script.js"></script>
</body></html>
