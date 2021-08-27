<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>{{ $general->sitename($page_title) }}</title>
    @include('partials.seo')
    <link rel="icon" href="{{get_image(config('constants.logoIcon.path') .'/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" type="image/png" href="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}"/>

    <!-- Custom Stylesheet -->
     @include('partials.notify-css')
	<!-- Google Fonts css-->
	<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,700,700i,900%7CPoppins:300,400,500,600,700,800,900" rel="stylesheet">
	<!-- Bootstrap css -->
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- Font Awesome icon css-->
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/flaticon.css" rel="stylesheet" media="screen">
	<!-- Swiper's CSS -->
	<link rel="stylesheet" href="{{url('/')}}/html-preview/cc-ico/layout2/css/swiper.min.css">
	<!-- Animated css -->
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/animate.css" rel="stylesheet">
	<!-- Magnific Popup CSS -->
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/magnific-popup.css" rel="stylesheet">
	<!-- Slick nav css -->
	<link rel="stylesheet" href="{{url('/')}}/html-preview/cc-ico/layout2/css/slicknav.css">
	<!-- Main custom css -->
	<link href="{{url('/')}}/html-preview/cc-ico/layout2/css/custom.css" rel="stylesheet" media="screen">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-target="#navigation" data-offset="71">
	<!-- Preloader starts -->
	<div class="preloader">
		<div class="loader"></div>
	</div>
	<!-- Preloader Ends -->
	<!-- Header Section Starts-->
	<header>
		<nav class="navbar navbar-toggleable-md navbar-light fixed-top" id="navigation">
			<div class="container">
				<a class="navbar-brand" href="{{url('/')}}"><img  style="width:40px;height:40px;" src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" />&nbsp;<strong class="text-white">{{$general->sitename}}</strong></a>
				<ul class="navbar-nav ml-auto" id="main-menu">
					<li class="nav-item"><a class="nav-link active" href="{{route('home')}}">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('home.about')}}">About</a></li>
					
					
					<li class="nav-item"><a class="nav-link" href="{{route('home.faq')}}">Faq</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('home.contact')}}">contact us</a></li>
					
					@guest
					<li class="nav-item"><a class="nav-link" href="{{route('user.login')}}">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('user.register')}}">Register</a></li>
					@else
					<li class="nav-item"><a class="nav-link" href="{{route('user.home')}}">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('user.logout')}}">Logout</a></li>
					@endif
				</ul>
				<div class="navbar-toggle"></div>
				<div id="responsive-menu"></div>
			</div>
		</nav>
	</header>
	<!-- Header Section ends -->

@yield('content')

  <!-- Footer Section starts -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<!-- Footer social link start -->
					<div class="footer-social-link">
					 
                     @foreach($socials as $data)
						<a href="{{$data->value->url}}" target="_blank">@php echo $data->value->icon  @endphp</a>
					 @endforeach
						
					</div>
					<!-- Footer social link end -->
					<!-- Footer Menu start -->
					<div class="footer-menu">
						<ul>
							@foreach($company_policy as $policy)
							<li><a href="{{route('home.policy',[$policy, str_slug($policy->value->title)])}}">{{__($policy->value->title)}}</a></li>
                            @endforeach
							
							<li><a href="{{route('home.blog')}}">Blog</a></li>
							<li><a href="{{route('home.rules')}}">Rules</a></li>
							<li><a href="{{route('home.faq')}}">Faq</a></li>
							<li><a href="{{route('home.contact')}}">contact us</a></li>
						</ul>
					</div>
					<!-- Footer Menu end -->
					<!-- Footer contact info start -->
					<div class="footer-contact-info">
						<a href="#"><i class="fa fa-envelope-o"></i> @php echo  $contact->value->email_address @endphp</a>
						<a href="#"><i class="fa fa-phone"></i> @php echo  $contact->value->contact_number @endphp</a>
					</div>
					
					
					
					
				
                    
                    
					<!-- Footer contact info end -->
				</div>
				
			</div>
		</div>
	</footer>
	<!-- Footer Section ends -->
	<!-- Jquery Library File -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/jquery-1.12.4.min.js"></script>
	<!-- Bootstrap js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/tether.min.js"></script>
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/bootstrap.min.js"></script>
	<!-- Bootstrap form validator -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/validator.min.js"></script>
	<!-- Wow js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/wow.js"></script>
	<!-- Swiper Carousel js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/swiper.min.js"></script>
	<!-- Counterup js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/waypoints.min.js"></script>
    <script src="{{url('/')}}/html-preview/cc-ico/layout2/js/jquery.counterup.min.js"></script>
	<!-- Magnific Popup core JS file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/jquery.magnific-popup.min.js"></script>
	<!-- Slick Nav js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/jquery.slicknav.js"></script>
	<!-- SmoothScroll -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/smoothscroll.js"></script>
    <!-- Main Custom js file -->
	<script src="{{url('/')}}/html-preview/cc-ico/layout2/js/function.js"></script> 
	@include('partials.notify-js')
@yield('script')
@yield('javascript')
@stack('js')
<script>
    $(document).on("change", ".langSel", function() {
        window.location.href = "{{url('/')}}/change-lang/"+$(this).val() ;

    });
</script>


@php
    if($plugins[1]->status == 1){
        $appKeyCode = $plugins[1]->shortcode->app_key->value;
        $twakTo = str_replace("{{app_key}}",$appKeyCode,$plugins[1]->script);
        echo $twakTo;
    }
@endphp
</body>
</html>
