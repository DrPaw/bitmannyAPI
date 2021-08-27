
@extends('include.front')
@section('content')

<!-- Banner Section Starts -->
	<section class="banner" id="home"  style="background-color: {{$general->bclr}}">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<!-- Header content start -->
					<div class="header-content wow fadeInUp">
						<h2><span>@php echo  __($homeContent->value->title) @endphp</span></h2>
						<p>@php echo  __($homeContent->value->details) @endphp</p>
						<div class="download-button">
							<a href="#" class="btn-download btn-apple"><i class="fa fa-apple"></i> <span>Download on the</span>App Store</a>
							<a href="#" class="btn-download btn-android"><i class="fa fa-android"></i> <span>Get in on</span>Google Play</a>
						</div>
					</div>
					<!-- Header content end -->
				</div>
				<div class="col-lg-4 offset-lg-2">
					<div class="registration wow fadeInRight">
						<h3>Fastest Trade</h3>
						<div class="">
						<img src="{{asset('assets/images/frontend/'.$homeContent->value->image)}}" class="img-fluid"  alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>
	<!-- Banner Section Ends -->
	<!-- Currency Price box starts -->
	<div class="currency-price">
		<div class="container table-responsive"> 
			  <!--  <div  style="background-color: {{$general->bclr}}" style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 100%;"><div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div  style="background-color: {{$general->bclr}}" style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="#" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Market Trend</a></div></div>-->
		 
		 
		 
		 
		 <table class="MainToken__Table_DlVUG " style=" width: 100%;" ><thead><tr><th class="MainToken__Table--miniHide_2aiQs" style="padding-left: 20px;">
          Name
        </th> <th width="20%" class="MainToken__Table--miniHide_2aiQs">
          Last Price
        </th> <th width="18%" class="MainToken__Table--miniHide_2aiQs">
          Change
        </th> <th class="MainToken__Table--miniHide_2aiQs">
          Trade
        </th></tr></thead> <tbody> 
        @php $ourcoin = App\Currency::whereStatus(1)->get();
        GetCoinPriceHome();
        @endphp
        
        @foreach($ourcoin as $data)
        @php
        $increase = $data->price - $data->lastprice;
        $percent = $increase/@$data->lastprice*100; 
        @endphp
        <tr class="MainToken__Table--TR_1cNw3"><td><img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$data->image}}" width="40"> <span class="MainToken__Table--t1_wyIo6">{{$data->symbol}}/USD</span> <small><b>{{$data->name}}</b></small></td> <td class="MainToken__Table--miniHide_2aiQs MainToken__Table--c_1lB97">
          ${{number_format($data->lastprice,2)}}
          <small>USD</small>
        </td> <td class="MainToken__Table--priceTD_1DDA1">
            ${{number_format($data->price,2)}}<br>
          
          <small  @if($data->price > $data->lastprice) class="text-success" @else class="text-danger" @endif> @if($data->price > $data->lastprice) + @endif {{@number_format($percent,2)}}%</small>
         </td> 
           <td class="MainToken__Table--miniHide_2aiQs"><a href="#" class="btn btn-md btn-info">
            Trade
          </a></td></tr>
          @endforeach
          </tbody></table>
          
          
		</div>
	</div>
	<!-- Currency Price box ends -->
	<!-- About section starts -->
	<section class="aboutus" id="about">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>@php echo  __($homeContent->value->abouthead) @endphp</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-6">
					<!-- About Information start -->
					<div class="about-entry">
						<p>@php echo  __($homeContent->value->aboutsubhead) @endphp</p>
					</div>
					<!-- About Information end -->
				</div>
				<div class="col-md-6">
					<!-- About Mission start -->
					<div class="about-mission wow fadeInUp">
						<h3>Swap, Invest and Earn Interest on Your Crypto</h3>
						<p>With your {{$general->sitename}} account you have the power over any cryptocurrency at your finger tips. Why not join us today</p>
					</div>
					<!-- About Mission end -->
				</div>
			</div>
		</div>
	</section>
	<!-- About section ends -->
	<!-- Buy Step section starts -->
	<div class="buy-step">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Easy to buy crypto currency</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="buy-step-single right-arrow wow fadeInUp" data-wow-delay="0.2s">
						<span>1</span>
						<p><a href="#">Register</a> your <br />trading account.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="buy-step-single right-arrow wow fadeInUp" data-wow-delay="0.4s">
						<span>2</span>
						<p><a href="#">Deposit funds </a> in the <br />one hours</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="buy-step-single wow fadeInUp" data-wow-delay="0.6s">
						<span>3</span>
						<p>Start <a href="#">Buy & Sell</a> any <br />Cryptocurrency</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Buy Step section ends -->
	<!-- Why choose us section starts -->
	<section class="why-choose-us" id="feature">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Why choose us?</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="0.2s">
						<h3>Best UI</h3>
						<div class="icon-box">
							<i class="flaticon-mixer"></i>
						</div>
						<p>Clean and easy to use interface for users.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="0.4s">
						<h3>Fast</h3>
						<div class="icon-box">
							<i class="flaticon-startup"></i>
						</div>
						<p>Fastest delivery of transactions.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="0.6s">
						<h3>Secure</h3>
						<div class="icon-box">
							<i class="flaticon-locked"></i>
						</div>
						<p>Most secure and trasparent payment.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="0.8s">
						<h3>Multicoin</h3>
						<div class="icon-box">
							<i class="flaticon-coins"></i>
						</div>
						<p>We support multiple currencies thereby giving you flexibility of choice.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="1.0s">
						<h3>Online Payment</h3>
						<div class="icon-box">
							<i class="flaticon-wallet"></i>
						</div>
						<p>Make payment on the go with {{$general->sitename}} easily.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="1.2s">
						<h3>Legal</h3>
						<div class="icon-box">
							<i class="flaticon-law"></i>
						</div>
						<p>We are legit and covers a wide range of countries across the globe.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="1.4s">
						<h3>Commisions</h3>
						<div class="icon-box">
							<i class="flaticon-percent"></i>
						</div>
						<p>No hidden charges and earn commsion for referring people to {{$general->sitename}}.</p>
					</div>
				</div>
				<!-- Why us box end -->
				<!-- Why us box start -->
				<div class="col-lg-3 col-md-6">
					<div class="why-us-box wow fadeInUp" data-wow-delay="1.6s">
						<h3>Withdraw</h3>
						<div class="icon-box">
							<i class="flaticon-withdraw"></i>
						</div>
						<p>Safe and fast withdrawal to any account of choice.</p>
					</div>
				</div>
				<!-- Why us box end -->
			</div>
		</div>
	</section>
	<!-- Why choose us section ends -->
	<!-- How it work section starts -->
	<section class="how-it-works">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<!-- How it work video start -->
					<div class="video-box wow zoomIn">
						<figure>
							<img src="{{asset('assets/images/frontend/'.$homeContent->value->aboutimage)}}" alt="" />
						</figure>
						<a href="https://www.youtube.com/watch?v=SSo_EIwHSd4" class="video-btn popup-video"><i class="flaticon-play-button"></i></a>
					</div>
					<!-- How it work video end -->
				</div>
				<div class="col-lg-5">
					<!-- How it work entry start -->
					<div class="how-it-work-entry">
						<h2>How to buy sell <br />Crypto Currency?</h2>
						<p>Login to your {{$general->sitename}} if you have one and if you dont, create a new account on {{$general->sitename}} and proceed to login. Click on the trade icon from the menu and proceed to select any cryptocurrency of choice before you continue. Enter an amount to buy and proceed to make payment. Its as easy as ABC!!!!!</p>
					</div>
					<!-- How it work entry end -->
				</div>
			</div>
		</div>
	</section>
	<!-- How it work section ends -->
	<!-- Portfolio section starts -->
	<section class="portfolio" id="dashboard">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Create your Wallet</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-5">
					<!-- Portfolio step start -->
					<div class="portfolio-step wow fadeInLeft" data-wow-delay="0.2s">
						<div class="portfolio-step-header">
							<div class="icon-box">
								<i class="flaticon-briefcase"></i>
							</div>
							<h3>Manage Wallet</h3>
						</div>
						<p>Create & Manage Your Cryptocurrency Wallet
					</div>
					<!-- Portfolio step end -->
					<!-- Portfolio step start -->
					<div class="portfolio-step wow fadeInLeft" data-wow-delay="0.4s">
						<div class="portfolio-step-header">
							<div class="icon-box">
								<i class="flaticon-secure-shield"></i>
							</div>
							<h3>Vault Protections</h3>
						</div>
						<p>Safe and secure crypto vault investment</p>
					</div>
					<!-- Portfolio step end -->
					<!-- Portfolio step start -->
					<div class="portfolio-step wow fadeInLeft" data-wow-delay="0.6s">
						<div class="portfolio-step-header">
							<div class="icon-box">
								<i class="flaticon-smartphone"></i>
							</div>
							<h3>Mobile App</h3>
						</div>
						<p>We are Mobile!!! download our mobile App for easy access</p>
					</div>
					<!-- Portfolio step end -->
				</div>
				<div class="col-md-7">
					<!-- Portfolio image start -->
					<div class="portfolio-img wow fadeInRight">
						<figure>
							<img src="{{url('/')}}/html-preview/cc-ico/layout2/images/portfolio.jpg" alt="" />
						</figure>
					</div>
					<!-- Portfolio image end -->
				</div>
			</div>
		</div>
	</section>
	<!-- Portfolio section ends -->
	<!-- Buy Cryptocurrency section starts -->
	<section class="buy-cryptocurrency" id="buynow">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Buy Cryptocurrency</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- Buy Crypto Currency Note start -->
					<div class="buying-note wow fadeInUp">
						<h3>Buy and sell Coins at {{$general->sitename}}<br />
						without additional fees</h3>
						<p>Buy now and get +40% extra bonus Minimum pre-sale amount 25 Crypto Coin. We accept BTC crypto-currency.</p>
					</div>
					<!-- Buy Crypto Currency Note end -->
					<!-- Buy Crypto Currency Form start -->
					<div class="buy-form wow zoomIn" data-wow-delay="0.4s">
						
						<div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by {{$general->sitename}}</div></div>
						
					</div>
					<!-- Buy Crypto Currency Form start -->
					<!-- Download App Form start -->
					<div class="download-app-form">
						<h3>Subscribe To Newsletters</h3>
						<form class="subscribe-form" action="{{route('home.subscribe')}}" method="post">
                    @csrf


                            <input class="txt-app"  type="email" name="email" placeholder="@lang('Subscribe For Newsletter')" required value="{{old('email')}}">
                            <input type="submit" value="Get Started" class="btn-app" />
                        </form>
                        
						
					</div>
					<!-- Download App Form end -->
				</div>
			</div>
		</div>
	</section>
	<!-- Buy Cryptocurrency section ends -->
 
	<!-- Testimonial section starts -->
	<section class="faq" id="testimonial">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Testimonial</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="testimonial-slider-wrapper">
						<div class="swiper-container testimonial-slider">
							<div class="swiper-wrapper">
							    @foreach($testimonial as $data)
								<!-- Testimonial slide start -->
								<div class="swiper-slide">
									<div class="testimonial-slide">
										<div class="testimonial-quote">
											<p>{{@$data->data_values->quote}}</p>
										</div>
										<div class="testimonial-author">
											<i class="fa fa-quote-left"></i>
											<h3>{{@$data->data_values->author}}</h3>
											<p>{{@$data->data_values->designation}}</p>
										</div>
									</div>
								</div>
								@endforeach
								<!-- Testimonial slide end -->
							</div>
							<!-- Testimonial Pagination start -->
							<div class="testimonial-pagination"></div>
							<!-- Testimonial Pagination end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Testimonial section ends -->







@endsection
