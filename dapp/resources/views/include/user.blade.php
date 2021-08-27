<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename($page_title) }}</title>
    @include('partials.seo')
    <link rel="icon" href="{{get_image(config('constants.logoIcon.path') .'/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" type="image/png" href="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}"/>

    <!-- Custom Stylesheet -->
    @include('partials.notify-css')
    <!-- Custom Stylesheet -->

    <link rel="stylesheet" href="{{url('/')}}/back/user/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{url('/')}}/back/user/css/style.css">
    <script src="{{url('/')}}/back/user/countries.js"></script>
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="header"   style="background-color: {{$general->bclr}}" >
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar">

                            <div class="header-search d-flex align-items-center">
                                <a class="brand-logo mr-3" href="{{url('/')}}">
                                    <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="50">
                                </a>
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="dashboard_log">
                                <div class="d-flex align-items-center">
                                    <div class="profile_log dropdown">
                                        <div class="user" data-toggle="dropdown">
                                            <span class="thumb"><i class="mdi mdi-account"></i></span>
                                            <span class="name">{{Auth::user()->firstname . Auth::user()->lastname}}</span>
                                            <span class="arrow"><i class="la la-angle-down"></i></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('user.edit-profile')}}" class="dropdown-item">
                                                <i class="mdi mdi-account"></i> Account
                                            </a>
                                            <a href="{{route('user.sessionlog')}}" class="dropdown-item">
                                                <i class="la la-book"></i> History
                                            </a>
                                            <a href="{{route('user.kyc')}}" class="dropdown-item">
                                                <i class="la la-cog"></i> Setting
                                            </a>
                                            <a href="{{route('user.change-password')}}" class="dropdown-item">
                                                <i class="la la-lock"></i> Lock
                                            </a>
                                            <a href="{{route('user.logout')}}" class="dropdown-item logout">
                                                <i class="la la-sign-out"></i> Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <a class="brand-logo" href="index.html">
                <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="100" alt="">
                <span>{{$general->sitename}} </span></a>
            <div class="menu">
                <ul>
                    <li>
                        <a href="{{route('user.home')}}">
                            <span><i class="mdi mdi-view-dashboard"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.buy')}}">
                            <span><i class="mdi mdi-repeat"></i></span>
                            <span class="nav-text">Trade</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.edit-profile')}}">
                            <span><i class="mdi mdi-account"></i></span>
                            <span class="nav-text">Account</span>
                        </a>
                    </li>
                    <li><a href="#">
                            <span><i class="mdi mdi-bank"></i></span>
                            <span class="nav-text">Deposit</span>
                        </a>
                    </li>
                    <li><a href="#">
                            <span><i class="mdi mdi-cart"></i></span>
                            <span class="nav-text">Withdraw</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <div class="social">
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </div>
                <div class="copy_right">
                    ©
                    <script>
                        var CurrentYear = new Date().getFullYear()
                        document.write(CurrentYear)
                    </script>
                </div>
            </div>
        </div>

         <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page_title-content">
                            <p>
                            <?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        echo "Good morning";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        echo "Good afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        echo "Good evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        echo "Good night";
    }
    ?>
                            ,
                                <span> {{Auth::user()->firstname . ' '.Auth::user()->lastname}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
         </div>

@yield('content')



    <script src="{{url('/')}}/back/user/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/back/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!--  <script src="{{url('/')}}/back/user/vendor/toastr/toastr.min.js"></script>
    <script src="{{url('/')}}/back/user/vendor/toastr/toastr-init.js"></script>-->

    <script src="{{url('/')}}/back/user/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{url('/')}}/back/user/vendor/circle-progress/circle-progress-init.js"></script>


    <!--  flot-chart js -->
    <script src="{{url('/')}}/back/user/vendor/apexchart/apexcharts.min.js"></script>
    <script src="{{url('/')}}/back/user/vendor/apexchart/apexchart-init.js"></script>
    <script src="{{url('/')}}/back/user/vendor/apexchart/apexchart2-init.js"></script>


    <script src="{{url('/')}}/back/user/js/scripts.js"></script>
     @yield('javascript')

        @include('partials.notify-js')
</body>

</html>
