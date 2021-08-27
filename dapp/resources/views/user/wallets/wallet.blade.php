@extends('include.user')

@section('content')

 <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card profile_card">
                            <div class="card-body">
                                <div class="media">
                                    <img class="mr-3 rounded-circle mr-0 mr-sm-3" src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}" width="60"
                                        height="60" alt="">
                                    <div class="media-body">
                                        <span>Hello</span>
                                        <h4 class="mb-2">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h4>
                                        <p class="mb-1"> <span><i class="fa fa-phone mr-2 text-primary"></i></span> {{Auth::user()->mobile}}</p>
                                        <p class="mb-1"> <span><i class="fa fa-envelope mr-2 text-primary"></i></span>
                                            {{Auth::user()->email}}
                                        </p>
                                    </div>
                                </div>

                                <ul class="card-profile__info">
                                    <li>
                                        <h5 class="mr-4">Country</h5>
                                        <span class="text-muted">{{Auth::user()->address->country}}</span>
                                    </li>
                                    <li>
                                        <h5 class="text-danger mr-4">Last Log</h5>
                                        <span class="text-danger">3 February,
                                            <script>
                                                var CurrentYear = new Date().getFullYear()
                                                document.write(CurrentYear)
                                            </script>, 10:00 PM
                                        </span>
                                    </li>
                                </ul>
                                <div class="social-icons">
                                    <a class="facebook text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-facebook"></i></span></a>
                                    <a class="twitter text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-twitter"></i></span></a>
                                    <a class="youtube text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-youtube"></i></span></a>
                                    <a class="googlePlus text-center" href="javascript:void(0)"><span><i
                                                class="fa fa-google"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card acc_balance">
                            <div class="card-header">
                                <h4 class="card-title">{{$currency->name}} Wallet</h4>
                            </div>
                            <div class="card-body">
                                <span>Available {{$currency->symbol}}</span>
                                <h3>{{$unit}}{{$currency->symbol}}</h3>

                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">Total Balance USD</p>
                                        <h4>${{number_format($usd,2)}}</h4>
                                    </div>
                                    <div>
                                        <p class="mb-1">{{$currency->symbol}} Rate Today</p>
                                        <h4>1{{$currency->symbol}} = ${{number_format( $rate)}}</h4>
                                    </div>
                                </div>

                                <div class="btn-group mb-3">
                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#modal-createwallet">Create Wallet</button>
                                    <button class="btn btn-success">View TRX</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- row closed -->
                      	<!-- row opened -->
						<div class="row">
						@foreach($wallets as $data)
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card wallet">
									<div class="card-body">
										<h4 class="card-title">{{$currency->name}} Wallet</h4>
										<label>Wallet Address</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" readonly id="{{$data->label}}" value="{{$data->address}}">

										</div>

										<div class="row">
											<div class="col-xl-8 col-md-8 col-lg-8 col-sm-12 mt-2">
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-receipt text-muted mr-2 mt-1 fs-16"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Label </span> : <span class="ml-auto h5 text-primary">{{$data->label}}</span>
												</p>
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-wallet mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Total Balance </span> : <span class="ml-auto h5 text-primary">{{number_format($data->usd/ $rate,8)}}{{$currency->symbol}}</span>
												</p>
												<p class="mb-0 d-flex">
													<span class=""><i class="fa fa-usd mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Total Balance </span> : <span class="ml-auto font-weight-bold text-primary">{{number_format($data->usd,2)}}USD</span>
												</p>
											</div>
											<div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">

												<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$currency->name.':'.$data->address}}&choe=UTF-8\" style='width:100px;'  />
											</div>
										</div>
										<div class="flex mt-4">
											<button data-toggle="modal"  style="background-color: {{$general->bclr}}" data-target="#modal-send"  class="btn btn-primary mr-2">Send {{$currency->symbol}}</button>
											<a href="{{route('user.viewwallet',$data->address)}}" class="btn btn-info">View TRX</a>
										</div>
									</div>
								</div>
							</div>


@section('script')
    <script>
        function {{$data->label}}() {
            var copyText = document.getElementById("{{$data->label}}");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if (alertStatus == '1') {
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
            } else if (alertStatus == '2') {
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
@endsection


<script>
function fee() {
 var usd = $('#usd').val();
 var apifee = 0.23/100*usd;
 var adminfee = {{$currency->fee}}/100*usd;
 var charge = apifee + adminfee;
 var total = +charge+ +usd;
 var unit = usd/{{$rate}};
  document.getElementById("fee").innerHTML = "<b class='text-white'>Fee: $ "+charge+"</b>";
  document.getElementById("unit").innerHTML = "<b class='text-white'>Units: "+unit+"{{$currency->symbol}}</b>";
  document.getElementById("total").innerHTML = "<a class='text-white'>Total: $ "+total+"</a>";


 };
</script>


							@endforeach


						</div>
							@if(count($wallets) < 1)
                            <div class="alert alert-warning mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Opps!</strong> Dear {{Auth::user()->username}}, you currently dont have any wallet address at the moment. Please Click on the create wallet button above to create a new {{$currency->name}} wallet address</span>
		                    </div>
							@endif

						<!-- row closed -->
						<br>


                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Last 5 Transactions</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="transaction-table">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <tbody>
                                            @foreach($trx as $data)
                                                <tr>
                                                    <td><span class="sold-thumb">
                                                     @if($data->type == 'send')
                                                        <i class="la la-arrow-up"></i>
                                                    @else
                                                       <i class="la la-arrow-down"></i>
                                                    @endif
                                                    </span>
                                                    </td>

                                                    <td>
                                                    @if($data->type == 'send')
                                                        <span class="badge badge-danger">Sent</span>
                                                    @else
                                                        <span class="badge badge-sucess">Received</span>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <i class="cc {{$currency->symbol}}"></i> {{$currency->symbol}}
                                                    </td>
                                                    <td>
                                                        {{$data->to_address}}
                                                    </td>
                                                    @if($data->type == 'send')
                                                         <td class="text-danger">-{{$data->amount}} {{$currency->symbol}}</td>
                                                         <td>-{{$data->usd}} USD</td>
                                                    @else
                                                         <td class="text-success">+{{$data->amount}} {{$currency->symbol}}</td>
                                                         <td>+{{$data->usd}} USD</td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if(count($trx) < 1)
                            <div class="alert alert-warning mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Opps!</strong> Dear {{Auth::user()->username}}, you currently dont have any transaction at the moment</span>
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


    <!-- Create Wallet Modal -->
			<div class="modal fade" id="modal-createwallet" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="img" width="100" class="w-20 text-center mx-auto">
															<div class="py-3 text-center">
																<h5>Create New {{$currency->name}} Wallet</h5>
																<p>Make your wallet address standout. Enter a wallet label for the {{$currency->name}} you want to create. Please note your wallet label is not your wallet address</p>
                                                                <form action="{{route('user.createwallet',$currency->symbol)}}" method="POST">
                                                                 {{csrf_field()}}
                            <label>Enter Wallet Label</label>
                            <input type="text" class="form-control" name="label" placeholder="Wallet Label">


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ">@lang('Create Wallet')</button>

                    </div>


                                                                 </form>

															</div>
														</div>

													</div>
												</div>
											</div>
				<!-- Create Wallet Modal End -->





@endsection

