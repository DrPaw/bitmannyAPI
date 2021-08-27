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
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#">Fiat</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{route('user.depositcrypto')}}">Crypto</a>
                                        </li>
                                    </ul>
                            </div>

                                <form action="{{route('user.deposit.insert')}}" method="post">
                                    @csrf
                                     <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-bank"></i></label>
                                            </div>

                                                         <script>
														function myFunction(){
                                                        var id = $("#currencyg option:selected").attr('data-id');
                                                        var cur = $("#currencyg option:selected").attr('data-cur');
														document.getElementById("currency").value = cur;
														document.getElementById("gateway").value = id;
														}
														</script>
                                            <select name="method_code" id="currencyg" onchange="myFunction()"   class="form-control">
                                            <option selected disabled>Select Deposit Method</option>
                                            @foreach($gatewayCurrency as $data)
                                                <option value="{{$data->id}}" data-cur="{{$data->baseCurrency()}}" data-id="{{$data->method_code}}">{{__($data->name)}} ({{$data->baseCurrency()}})</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     <input type="hidden" name="currency" id="currency" value="">
                                     <input type="hidden" name="method_code" id="gateway"  value="">

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-money"></i></label>
                                            </div>
                                            <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="{{old('amount')}}">
                                        </div>
                                    </div>


                                    <button class="btn btn-primary btn-block">Fund Now</button>
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
                                        <td data-label="@lang('Gateway')">{{ $data->gateway->name   }}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{formatter_money($data->final_amo)}} {{$general->cur_text}}</strong>
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
			<span class="alert-inner--text"><strong>Hey Boss!</strong>   You dont have any deposit log at the moment</span>
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

