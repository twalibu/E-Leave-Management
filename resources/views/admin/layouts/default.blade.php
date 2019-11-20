<!DOCTYPE html>
<html style="min-height: 449px;">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
           e-Leave |
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link rel="shortcut icon" href="{{ asset('images/fevicon.png') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}" />

    <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
            <!--end of page level css-->

<body class="skin-josh">
<header class="header">
    <a style="padding-bottom: 3px;" href="" class="logo">
        <img src="{{ asset('images/e-leave.png') }}" alt="logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                @include('admin.layouts.notification')

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <img src="{{ Gravatar::src(Sentinel::getUser()->email) }}" width="35"
                                 class="img-circle img-responsive pull-left" height="35" alt="riot">

                        <div class="riot">
                            <div>
                                <p style="padding-right: 10px;" class="user_name_max">{{Sentinel::getUser()->userName}}</p>

                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                                <img src="{{ Gravatar::src(Sentinel::getUser()->email) }}"
                                     class="img-responsive img-circle" alt="User Image">

                            <p class="topprofiletext">{{Sentinel::getUser()->userName}}</p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div style="text-align: center">
                                <a  href="{{url('logout')}}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <li>
                            <a href="">
                                <i class="livicon" data-name="chrome" title="chrome" data-loop="true"
                                   data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="livicon" data-name="opera" title="opera" data-loop="true"
                                   data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="livicon" data-name="firefox" title="firefox" data-loop="true"
                                   data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="livicon" data-name="safari" title="safari" data-loop="true"
                                   data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layouts._left_menu')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">



                <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->

</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->


<script src="{{ asset('admin/js/app.js') }}" type="text/javascript"></script>
@yield('footer_scripts')

<!-- end of global js -->
<!-- begin page level js -->
<script>

</script>

        <!-- end page level js -->
<div style="background-color: white;">
    <div class="container">
        <p style=" padding-top:1.5%;text-align: center">Powered by <a href="#" target="_blank">Bizcyclone IT Team.</a></p>
    </div>
</div>
</body>

</html>
