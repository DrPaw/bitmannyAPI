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

    <link rel="stylesheet" href="{{url('/')}}/back/user/css/style.css">
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

@yield('content')



    <script src="{{url('/')}}/back/user/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/back/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="{{url('/')}}/back/user/vendor/validator/jquery.validate.js"></script>
    <script src="{{url('/')}}/back/user/vendor/validator/validator-init.js"></script>

    <script src="{{url('/')}}/back/user/js/scripts.js"></script>
    @include('partials.notify-js')
    @yield('javascript')



</body>

</html>
