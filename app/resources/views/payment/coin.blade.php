@extends('include.user')

@section('content')
  	<!-- row opened -->

							<div class="content-body">
            <div class="container">
                <div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Crypto</h3>

									</div>
									<div class="card-body">


										<div class="">
											<p class="mb-1 mt-5"><span class="font-weight-semibold">Invoice Date : </span> {{date('d-M-Y', strtotime($deposit->created_at))}}</p>
											<p class="mb-1"><span class="font-weight-semibold">Deposit Status : </span>Pending</p>
										</div>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover">
												<tr>
													<th class="text-center "></th>
													<th>Gateway</th>
													<th class="text-center" >Currency</th>
													<th class="text-right" >Charge</th>
													<th class="text-right">Amount</th>
												</tr>
												<tr>
													<td class="text-center">1</td>
													<td>
														<p class="font-w600 mb-1">{{$currency->name ?? "Coin"}}</p>
														<div class="text-muted d-none d-sm-block">Online Payment</div>
													</td>
													<td class="text-center">{{$deposit->method_currency}}</td>
													<td class="text-right">{{number_format($deposit->charge,2)}}{{$general->cur_text}}</td>
													<td class="text-right">{{number_format($deposit->amount,2)}}{{$general->cur_text}}</td>
												</tr>

												<tr>
													<td colspan="4" class="font-w600 text-right">Total</td>
													<td class="text-right">{{number_format($deposit->amount + $deposit->charge,2)}}{{$general->cur_text}}</td>
												</tr>
												<tr>
													<td colspan="5" class="text-right">
														  <div class="card-body text-center">
                    <h3 class="text-color"> @lang('PLEASE SEND EXACTLY') <span style="color: green"> {{ $deposit->btc_amo }}</span> {{$deposit->method_currency}}</h3>
                    <h5><br>
                    Wallet Address: <span style="color: green"> {{ $deposit->btc_wallet }}</span></h5><br>
                    <center><small style="color: red">Sending a lower amount may result to loss of fund. <br>We will not be liable to any loss arising from sending a lower amount</small></center>
                    		<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$deposit->method_currency.':'.$deposit->btc_wallet.'?amount='.$deposit->btc_amo}}&choe=UTF-8\" style='width:190px;'  />

                    <h4 class="text-color bold">@lang('SCAN TO SEND')</h4>
                    <br>Please click on the process button if you have made payment into the wallet address
                    <a href="{{route('user.verifypay',$deposit->trx)}}" class="btn btn-primary btn-block">Process Payment</a>
                </div>


													</td>
												</tr>
											</table>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@endsection

