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
    @if(Auth::user()->darkmode == 1)
    <style>
body {
  background-color: #333337;
  color: white;
}
.card {
  border: 0px;
  margin-bottom: 30px;
  border-radius: 15px;
  box-shadow: 0px 10px 20px rgba(55, 55, 89, 0.08);
  background: {{dark()}}; }
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(55, 55, 89, 0.1);
    background: {{dark()}};
    padding: 20px;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important; }
  .card-title {
    font-size: 18px;
    margin-bottom: 0px;
    font-weight: 500; }
  .card.transparent {
    background: transparent;
    box-shadow: none; }
    .card.transparent .card-header,
    .card.transparent .card-body {
      background: transparent; }
  .card .card-body {
    padding: 20px;
    background: {{dark()}};
    border-radius: 15px; }

</style>
@else
 <style>
body {
  background-color: white;
  color: black;
}
.card {
  border: 0px;
  margin-bottom: 30px;
  border-radius: 15px;
  box-shadow: 0px 10px 20px rgba(55, 55, 89, 0.08);
  background: #fff; }
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(55, 55, 89, 0.1);
    background: #fff;
    padding: 20px;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important; }
  .card-title {
    font-size: 18px;
    margin-bottom: 0px;
    font-weight: 500; }
  .card.transparent {
    background: transparent;
    box-shadow: none; }
    .card.transparent .card-header,
    .card.transparent .card-body {
      background: transparent; }
  .card .card-body {
    padding: 20px;
    background: #fff;
    border-radius: 15px; }

</style>
@endif
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

        <div class="header" @if(Auth::user()->darkmode != 0) style="background-color: #000" @else  style="background-color: #fff" @endif ><!--   style="background-color: {{$general->bclr}}"-->
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar">

                            <div class="header-search d-flex align-items-center">
                                <a class="brand-logo mr-3" href="{{url('/')}}">
                                 @if(Auth::user()->darkmode == 1)
                                    <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="50">
                                 @else
                                    <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="50">
                                @endif
                                </a>
                                <form action="#">
                                    <div class="input-group">
                                       <div class="input-group-append">
                                          <!--  @if(Auth::user()->darkmode == 1)
                                            <a href="{{route('user.lightmode')}}"><span class="input-group-text" id="basic-addon2"><i class="fa fa-moon-o"></i></span></a>
                                            @else
                                             <a href="{{route('user.darkmode')}}"><span class="input-group-text" id="basic-addon2"><i class="fa fa-sun-o"></i></span></a>
                                            @endif-->
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

                                            <a href="{{route('user.change-password')}}" class="dropdown-item">
                                                <i class="la la-lock"></i> Security
                                            </a>
                                            <a href="{{route('user.logout')}}" class="dropdown-item logout">
                                                <i class="fa fa-power-off"></i> Logout
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
            <a class="brand-logo" href="{{url('/')}}">
                <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="100" alt="">
                <span class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->sitename}} </span></a>
            <div class="menu">
                <ul>
                    <li>
                        <a href="{{route('user.home')}}">
                            <span><i class="mdi mdi-home"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.swapcoin')}}">
                            <span><i class="mdi mdi-repeat"></i></span>
                            <span class="nav-text">Swap</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.edit-profile')}}">
                            <span><i class="mdi mdi-account"></i></span>
                            <span class="nav-text">Account</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.deposit')}}">
                            <span><i class="mdi mdi-bank"></i></span>
                            <span class="nav-text">Deposit</span>
                        </a>
                    </li>
                    <li><a href="{{route('user.withdraw.money')}}">
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
                         <!--   <?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("af");
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
                           ,-->
                                <p> {{$page_title}}</p>

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
    <script>
function myModeFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}
</script>
     @yield('javascript')

        @include('partials.notify-js')
</body>

</html>
