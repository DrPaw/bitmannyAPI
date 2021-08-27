@extends('include.user')

@section('content')

<div class="content-body">
            <div class="container">
                <div class="row">

                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$page_title}}</h4>
                            </div>
                            <div class="card-body">


                            <div class="buy-sell-widget">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('user.deposit')}}" >Fiat</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link active" href="#">Crypto</a>
                                        </li>
                                    </ul>
                            </div>


                                <form action="" method="post">
                                    @csrf
                                     <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i id="logo"></i></label>
                                            </div>

                                                         <script>
														function myFunction(){
                                                        var logo = $("#currencyg option:selected").attr('data-logo');
                                                        var symbol = $("#currencyg option:selected").attr('data-symbol');
														document.getElementById("logo").innerHTML = logo;
														document.getElementById("symbol").innerHTML = "Deposit "+symbol;
														}
														</script>
                                            <select name="currency" id="currencyg" onchange="myFunction()" class="form-control">
                                            <option selected disabled>Select Cryptocurrency</option>
                                            @foreach($gatewayCurrency as $data)
                                                <option data-logo="<i class='cc {{$data->symbol}} me-3'></i>" data-symbol="{{$data->symbol}}" value="{{$data->id}}" >{{__($data->name)}} </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="text-warning fa fa-usd"></i></label>
                                            </div>
                                            <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00 USD" required=""  value="{{old('amount')}}">
                                        </div>
                                    </div>


                                    <button class="btn btn-primary btn-block" id="symbol">Proceed</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Deposit Log</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="transaction-table">
                                    <div class="table-responsive">
                                       <table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													<tr>
														 <th >@lang('Transaction ID')</th>
                                                         <th  >@lang('Gateway')</th>
                                                         <th  >@lang('Amount')</th>
                                                          <th >@lang('Time')</th>
													</tr>
												</thead>
												<tbody>

                                                @foreach($deposits as $k=>$data)
													<tr>
                                        <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                        <td data-label="@lang('Gateway')">{{ $data->method_currency   }}</td>
                                        <td data-label="@lang('Amount')">
                                        <strong>{{formatter_money($data->final_amo)}} {{$general->cur_text}}</strong><br>
                                        <small>{{$data->btc_amo}}{{ $data->method_currency}}</small>

                                        </td>
                                        <td data-label="@lang('Time')">
                                            <i class="fa fa-calendar"></i> {{date(' d M, Y ', strtotime($data->created_at))}}
                                            <i class="fa fa-clock-o pl-1"></i> {{date('h:i A', strtotime($data->created_at))}}
                                        </td>
                                    </tr>
												  @endforeach


												</tbody>
											</table>
                                    </div>
                                     @if(count($deposits) < 1)
											 <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Hey Boss!</strong> You dont have any crypto deposit log at the moment</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>

											  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

@stop

