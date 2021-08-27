
@extends('include.front')
@section('content')



    <div class="intro2 section-padding bg-darkd"  style="background-color: {{$general->bclr}}" id="intro">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="intro-content">
                    <h1 class="text-white">@php echo  __($homeContent->value->title) @endphp</h1>
                    <p class="text-white">@php echo  __($homeContent->value->details) @endphp</p>
                    <div class="intro-form">
                        <form class="subscribe-form" action="{{route('home.subscribe')}}" method="post">
                    @csrf


                            <input class="form-control"  type="email" name="email" placeholder="@lang('Subscribe For Newsletter')" required value="{{old('email')}}">
                            <button type="submit">
                                <i class="la la-arrow-right first"></i>
                                <i class="la la-arrow-right second"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
             <div class="intro-app-img">
                    <img src="{{asset('assets/images/frontend/'.$homeContent->value->image)}}" class="img-fluid"  alt="...">

                </div>

            </div>
        </div>
    </div>
</div>



    <div class="market section-padding page-section" data-scroll-index="1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>@php echo  __($homeContent->value->abouthead) @endphp</h2>
                    <p>@php echo  __($homeContent->value->aboutsubhead) @endphp</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="market-table">
                    <div class="table-responsive">
                        <table class="table mb-0 table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Coin</th>
                                    <th>Seller</th>
                                    <th>Country</th>
                                    <th>Rate</th>
                                    <th>Market Cap</th>
                                    <th>Payment Method</th>
                                    <th>Trade</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($offer as $data)
                                <tr>
                                    <td>1</td>
                                    <td class="coin_icon">
                                       <img src="{{url('/')}}/back/images/crypto-currencies/square-color/{{App\Currency::whereId($data->coin_id)->first()->image ?? ''}}" width="20" alt="img" class="h-6 w-6">
                                        <span>&nbsp;{{App\Currency::whereId($data->coin_id)->first()->name ?? ""}}</span>
                                    </td>
                                      <td>

                                        <span>&nbsp;{{App\User::whereId($data->user_id)->first()->username ?? "Unknown User"}}</span>
                                    </td>

                                    <td>
                                        {{$data->country}}<br><small>{{$data->currency}}</small>
                                    </td>
                                    <td>
                                       <small> <span class="text-success">1USD = {{$data->rate}}{{$data->currency}}</span></small>
                                    </td>
                                    <td>
                                      <small>  <span class="text-primary">${{number_format($data->min,2)}} - ${{number_format($data->max,2)}}</span></small>
                                    </td>
                                    <td> {{App\Paymentmethod::whereId($data->payment_method)->first()->name ?? "N/A"}}</td>
                                    <td><a href="{{route('user.viewoffer',$data->code)}}"  style="background-color: {{$general->bclr}}" class="btn btn-success">Buy</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table> {{$offer->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    <div class="info bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-star"></i></span>
                    <h4>Best rates on the market</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-heart"></i></span>
                    <h4>Transparent 0.25% fee</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-clock"></i></span>
                    <h4>5-30 min transactions</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-cash"></i></span>
                    <h4>High exchange limits</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-headset"></i></span>
                    <h4>24/7 live chat support</h4>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="product-feature section-padding">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="section-title">
                            <h2 class="text-start">@php echo  __($homeContent->value->g1) @endphp</h2>
                            <p>@php echo  __($homeContent->value->g2) @endphp</p>
                        </div>
                        <div class="product-feature-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="product-feature-text">
                                        <h4><span><i class="bi bi-person"></i></span> @php echo  __($homeContent->value->g3) @endphp</h4>
                                        <p>New users</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="product-feature-text">
                                        <h4><span><i class="bi bi-people"></i></span> @php echo  __($homeContent->value->g4) @endphp</h4>
                                        <p>Regular users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-prismary"  style="background-color: {{$general->bclr}}"><i class="bi bi-cash-stack"></i></span>
                                    <h4>@php echo  __($homeContent->value->g5) @endphp</h4>
                                    <p>Transactions made</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-secondasry"  style="background-color: {{$general->bclr}}"><i class="bi bi-trophy"></i></span>
                                    <h4>@php echo  __($homeContent->value->g6) @endphp</h4>
                                    <p>Today's champion pair</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-successs"  style="background-color: {{$general->bclr}}"><i class="bi bi-people"></i></span>
                                    <h4>@php echo  __($homeContent->value->g7) @endphp</h4>
                                    <p>Visits today</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-infso"  style="background-color: {{$general->bclr}}"><i class="bi bi-clock"></i></span>
                                    <h4>@php echo  __($homeContent->value->g8) @endphp</h4>
                                    <p>Average processing time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="new-product section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <h2>@php echo  __($homeContent->value->problemheader) @endphp</h2><br>
                     <p class="content-desc animated" data-animation="fadeInUpShorter" data-animation-delay="0.4s">@php echo  __($homeContent->value->problemsubheader) @endphp</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="new-product-content">
                    <img class="img-fluid" src="{{asset('assets/images/frontend/'.$homeContent->value->problemimage)}}" alt="">
                    <h4>1</h4>
                    <p>@php echo  __($homeContent->value->problem) @endphp</p>
                    <a href="#" class="btn btn-dark px-4">Learn more</a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="new-product-content">
                    <img class="img-fluid" src="{{asset('assets/images/frontend/'.$homeContent->value->solutionimage)}}" alt="">
                    <h4>2</h4>
                    <p>@php echo  __($homeContent->value->solution) @endphp
                    </p>
                    <a href="{{route('user.login')}}" class="btn btn-outline-dark px-4">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="trust section-padding">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <h2>Our Services</h2>
                </div>
            </div>
        </div>
        <div class="row">



            @foreach($services as $data)

            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="trust-content">
                    <span><img src="{{get_image(config('constants.frontend.services.path').'/'.$data->value->image)}}" width="30" alt="{{__($data->value->title)}}"></span>
                    <h4>{{__($data->value->title)}}</h4>
                    <p>{{__($data->value->details)}}
                    </p>
                </div>
            </div>
         @endforeach
        </div>
    </div>
</div>



    <div class="appss section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-5 col-lg-5 col-md-12">
                <div class="appss-img">
                    <img class="img-fluid" src="{{asset('assets/images/frontend/'.$homeContent->value->mobileappimage)}}" alt="">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="appss-content">
                    <h3>Mobile app</h3>
                    <p>@php echo  __($homeContent->value->mobileappheader) @endphp</p>
                    @php echo  __($homeContent->value->mobileappbody) @endphp
                    <div class="mt-4">
                        <a href="index2.html#"  style="background-color: {{$general->bclr}}" class="btn btn-success my-1 waves-effect">
                            <img src="{{url('/')}}/front/images/android.svg" alt="">
                        </a>
                        <a href="index2.html#"  style="background-color: {{$general->bclr}}" class="btn btn-success  my-1 waves-effect">
                            <img src="{{url('/')}}/front/images/apple.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="intro1 section-padding">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-6 col-12">
                <div class="intro-content">
                    <h1 class="text-dark">@php echo  __($homeContent->value->whitepaperheader) @endphp
                    </h1>
                    <p>@php echo  __($homeContent->value->whitepapersubheader) @endphp</p>

                    <div class="intro-btn">
                        <a href="#"  style="background-color: {{$general->bclr}}" class="btn btn-primary btn-sm py-2 px-3 me-3 shadow-sm">Get Started</a>
                        <a href="#" class="btn btn-outline-dark btn-sm py-2 px-3 shadow-sm">Browse Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="intro-form-exchange">
                    <form method="post" name="myform" class="currency_validate trade-form row g-3">
                        <div class="col-12">
                            <label class="form-label">Send</label>
                            <div class="input-group">
                                <select class="form-control" name="method">
                                    <option value="bank">USD</option>
                                    <option value="master">Euro</option>
                                </select>
                                <input type="text" name="currency_amount" class="form-control" placeholder="0.0214 BTC">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Receive</label>
                            <div class="input-group">
                                <select class="form-control" name="method">
                                    <option value="bank">BTC</option>
                                    <option value="master">ETH</option>
                                </select>
                                <input type="text" name="currency_amount" class="form-control" placeholder="0.0214 BTC">
                            </div>
                        </div>

                        <p class="mb-0">1 USD ~ 0.000088 BTC <a href="index.html#">Expected rate <br>No extra
                                fees</a></p>
                        <button type="button"  style="background-color: {{$general->bclr}}" class="btn btn-primary ">
                            Buy Now
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="getstart section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title">
                    <h2>@php echo  __($homeContent->value->step) @endphp</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-person"></i></span>
                    <h3>1</h3>
                    <p>@php echo  __($homeContent->value->step1) @endphp</p>
                    <a href="register#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-pencil-square"></i></span>
                    <h3>2</h3>
                    <p>@php echo  __($homeContent->value->step2) @endphp</p>
                    <a href="login#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-cash"></i></span>
                    <h3>3</h3>
                    <p>@php echo  __($homeContent->value->step3) @endphp</p>
                    <a href="login#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="portfolio section-padding">
    <div class="container">
        <div class="row py-lg-5 justify-content-center">
            <div class="col-xl-7">
                <div class="section-title text-center">
                    <h2 class="text-dark">@php echo  __($homeContent->value->f1) @endphp</h2>
                    <p>@php echo  __($homeContent->value->f11) @endphp</p>
                        <i class="bi-wallet"></i>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_list">
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-person-check"></i></span>
                        <div class="media-body">
                            <p>@php echo  __($homeContent->value->f2) @endphp
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-bag-check"></i></span>
                        <div class="media-body">
                            <p>@php echo  __($homeContent->value->f3) @endphp.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_imsg">
                    <img src="{{asset('assets/images/frontend/'.$homeContent->value->f112)}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_list">
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-shield-check"></i></span>
                        <div class="media-body">
                            <p>@php echo  __($homeContent->value->f4) @endphp
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-phone"></i></span>
                        <div class="media-body">
                            <p>@php echo  __($homeContent->value->f5) @endphp
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
