@extends('include.user')

@section('content')
<div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">



                        @foreach($authWallets as $data)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-6 text-white">
                                <div class="widget-card" style="background-color: {{binanceyellow()}}">
                                    <div class="widget-title">
                                        <h5 class="text-white">@if($data->type == 'deposit_wallet') Fiat Balance @elseif($data->type == 'interest_wallet') HODL @elseif($data->type == 'hodl_wallet') HODL Balance @endif</h5>

                                    </div>
                                    <div class="widget-info">
                                        <h3 class="text-white"><small class="text-white">{{$general->cur_sym}}</small>{{number_format($data->balance,2)}}</h3>
                                       <!-- <p class="text-white">{{$general->cur_text}}</p>-->
                                    </div>
                                </div>
                            </div>
                         @endforeach

                         <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="widget-card" style="background-color: {{binanceyellow()}}">
                                    <div class="widget-title">
                                        <h5>Total Fiat Balance</h5>

                                    </div>
                                    <div class="widget-info">
                                        <h3>{{$general->cur_sym}}{{number_format($balance,2)}}</h3>
                                        <p>{{$general->cur_text}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--##################Widget ICONS###################-->

                         <div class="chart-content text-center">

                                            <div class="row">
                                                <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a href="{{route('user.referral')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-sitemap"></i></span></a>
                                                        <p class="mb-1">Referral</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a href="{{route('user.deposit')}}"  class="bg-warning text-center text-black" href="javascript:void(0)"><span><i
                                                class="fa fa-money text-grey"></i></span></a>
                                                        <p class="mb-1">Savings</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a href="{{route('user.vault')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-bar-chart"></i></span></a>
                                                        <p class="mb-1">Invest</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a href="{{route('user.kyc')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-address-card-o"></i></span></a>
                                                        <p class="mb-1">Verify</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a  href="{{route('user.createselloffer')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-gift"></i></span></a>
                                                        <p class="mb-1">Offer</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a  href="{{route('user.p2p')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-credit-card"></i></span></a>
                                                        <p class="mb-1">Market</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a  href="{{route('user.myoffers')}}"  href="{{route('user.p2plogbuy')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-handshake-o"></i></span></a>
                                                        <p class="mb-1">P2P</p>
                                                    </div>
                                                </div>
                                                  <div class="col-xl-3 col-sm-3 col-3">
                                                    <div class="social-icons">
                                                     <a href="{{route('user.ticket')}}"  class="bg-warning text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-commenting"></i></span></a>
                                                        <p class="mb-1">Support</p>
                                                    </div>
                                                </div>

                                            </div>
                                </div>
                         <!--##################Widget ICONS###################-->

                        <div class="row">
                        <br><br><br>


                         <div class="col-xl-3 col-lg-4 col-xxl-4">
                        <div class="card balance-widget">

                            <div class="card-body pt-0">
                                <div class="balance-widget">
                                    <div class="total-balance">
                                    @php $walletbalance = App\Cryptowallet::where('user_id', auth()->id())->whereStatus(1)->sum('usd'); @endphp
                                        <h3 class="@if(Auth::user()->darkmode != 0) text-white @endif">${{number_format($walletbalance,2)}}</h3>
                                        <h6 class="@if(Auth::user()->darkmode != 0) text-white @endif">Total Balance</h6>
                                    </div>
                                    <ul class="list-unstyled">
                                     @foreach($currency as $data)
                                            @php $wallet = App\Cryptowallet::whereCoinId($data->id)->where('user_id', auth()->id())->whereStatus(1)->first(); @endphp
                                             <li class="d-flex">
                                            <i class="cc {{$data->symbol}} me-3"></i>
                                            <div class="flex-grow-1">
                                             <a href="{{route('user.wallet',$data->symbol)}}">
                                                <h5 class="@if(Auth::user()->darkmode != 0) text-white @endif m-0">&nbsp;{{$data->name}}</h5>
                                             </a>
                                            </div>
                                            <div class="text-end">
                                             <a href="{{route('user.wallet',$data->symbol)}}">
                                                @if($wallet)
                                                       <h5 class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$wallet->balance ?? 0.00}} {{$data->symbol}}</h5>
                                                       <small class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$wallet->usd ?? 0.00}} USD</small><br>
                                                        <span class="@if(Auth::user()->darkmode != 0) text-white @endif"> <a href="{{route('user.wallet',$data->symbol)}}" class="badge badge-success badge-sm text-white">View Wallet</a></span>
                                                    @else
                                                    <h5 class="@if(Auth::user()->darkmode != 0) text-white @endif">0.00 {{$data->symbol}}</h5>
                                                    <small class="@if(Auth::user()->darkmode != 0) text-white @endif">0.00 USD</small><br>
                                                    <span class="@if(Auth::user()->darkmode != 0) text-white @endif"> <a href="{{route('user.wallet',$data->symbol)}}" class="badge badge-success badge-sm text-white">View Wallet</a></span>
                                                    @endif

                                            </a>
                                            </div>

                                        </li>


                                            @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-8 col-xxl-8">
                        <div style="class="cards profile_chart">
                            <div class="card-header py-0">


                                 <!--#############BUY & SELL###########-->

                                         <div class="acc_balance">
                                          <br> <br>

                                <div class="btn-group mb-3">
                                    <a href="{{route('user.sell')}}" class="btn btn-primary">Sell</a>
                                    <a href="{{route('user.buy')}}" class="btn btn-success">Buy</a>
                                </div>
                                        </div>
                                         <!--#############BUY & SELL###########-->
                            </div>
                            <div class="card-body">
                                <!--<div id="timeline-chart"></div>-->
                                 <!--#############chart###########-->
                                 @if(Auth::user()->darkmode != 1)
                                <div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by {{$general->sitename}}</div></div>
                                @else
                                <div style="height:560px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=dark&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by {{$general->sitename}}</div></div>
                                @endif
                                 <!--########################-->
                                <div class="chart-content text-center">
                                    <div class="row">
                                         <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Deposit</p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->cur_sym}}{{number_format($totalDeposit,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Withdraw</p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif"> {{$general->cur_sym}}{{number_format($totalWithdraw,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Pending Withdraw</p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->cur_sym}}{{number_format($ptotalWithdraw,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Sell</p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->cur_sym}}{{number_format($sell,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Buy </p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->cur_sym}}{{number_format($buy,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Trade </p>
                                                        <strong class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$general->cur_sym}}{{number_format($trade,2)}} </strong>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



 </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
