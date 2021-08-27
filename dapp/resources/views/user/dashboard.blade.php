@extends('include.user')

@section('content')
<div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
       
            
            
                        @foreach($authWallets as $data)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-6 text-white">
                                <div class="widget-card bg-primary">
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
                                <div class="widget-card bg-success">
                                    <div class="widget-title">
                                        <h5>Total Balance</h5>

                                    </div>
                                    <div class="widget-info">
                                        <h3>{{$general->cur_sym}}{{number_format($balance,2)}}</h3>
                                        <p>{{$general->cur_text}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xl-8 col-lg-12 col-xxl-8">
                                <div class="card profile_chart transparent">
                                    <div class="card-header">
                                    @php $wallets = App\Cryptowallet::whereCoinId($data->id)->where('user_id', auth()->id())->whereStatus(1)->sum('usd'); @endphp


                                        <div class="chart_current_data">
                                            <h3><span>{{$general->cur_sym}} </span>{{number_format($wallets,2)}}</h3>
                                            <p class="text-success">Wallet Balance <span>{{$general->cur_text}}</span></p>
                                        </div>
                                        <div class="duration-option">
                                            <a id="all" class="active">ALL</a>
                                        </div>
                                    </div>
                                    <div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by {{$general->sitename}}</div></div>
                                    <div class="card-body">
                                      <!--       <div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by {{$general->sitename}}</div></div>-->
                                        
                                        
                                        <div class="chart-content text-center">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Deposit</p>
                                                        <strong>{{$general->cur_sym}}{{number_format($totalDeposit,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Withdraw</p>
                                                        <strong>{{$general->cur_sym}}{{number_format($totalWithdraw,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Pending Withdraw</p>
                                                        <strong>{{$general->cur_sym}}{{number_format($ptotalWithdraw,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Sell</p>
                                                        <strong>{{$general->cur_sym}}{{number_format($sell,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Buy </p>
                                                        <strong>{{$general->cur_sym}}{{number_format($buy,2)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Total Trade </p>
                                                        <strong>{{$general->cur_sym}}{{number_format($trade,2)}} </strong>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Popularity </p>
                                                        <strong>#1 most held </strong>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-6">
                                                    <div class="chart-stat">
                                                        <p class="mb-1">Popularity </p>
                                                        <strong>#1 most held </strong>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-12 col-xxl-4">
                                <div class="card balance-widget transparent">
                                    <div class="card-body">
                                        <div class="balance-widget">

                                       <!--     <h4>
                                            <br>Total Balance :<strong>{{$general->cur_sym}}{{$wallets}}</strong></h4>-->
                                            <ul class="list-unstyled">
                                            @foreach($currency as $data)
                                            @php $wallet = App\Cryptowallet::whereCoinId($data->id)->where('user_id', auth()->id())->whereStatus(1)->first(); @endphp

                                                <li class="media">
                                                    <i class="cc {{$data->symbol}} mr-3"></i>
                                                    <div class="media-body">
                                                    <a href="{{route('user.wallet',$data->symbol)}}">
                                                        <h5 class="m-0">{{$data->name}}</h6>
                                                    </a>
                                                    </div>
                                                    <div class="text-right">
                                                    <a href="{{route('user.wallet',$data->symbol)}}">
                                                    @if($wallet)
                                                        <h5>{{$wallet->balance ?? 0.00}} {{$data->symbol}}</h5>
                                                        <span>{{number_format($wallet->usd,2) ?? 0.00}} {{$general->cur_text}}</span>
                                                    @else
                                                    <h5>0.00 {{$data->symbol}}</h5>
                                                    <span>0.00 {{$general->cur_text}}</span>
                                                    @endif
                                                    </a>
                                                    </div>
                                                </li>
                                                </a>
                                            @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-xxl-12">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
