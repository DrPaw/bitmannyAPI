@extends('include.user')

@section('content')
 <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="buy-sell-widget">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link" data-toggle="buy"
                                                href="{{route('user.buy')}}">Buy</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link active" data-toggle="g" href="">Sell</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-content-default">
                                        <div class="tab-pane fade show active" id="buy" role="tabpanel">

                                            <form class="contact-form" action="{{route('user.sellcoin')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                                <div class="form-group">
                                                    <label class="@if(Auth::user()->darkmode != 0) text-white @endif">Currency</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-server @if(Auth::user()->darkmode != 0) text-white @endif"></i></label>
                                                        </div>
                                                        <select name="currency" id="currency" onchange="myFunction()"  class="form-control select2 custom-select" data-placeholder="Bitcoin">
													<option label="Choose one">Select Currency
													</option>
													@foreach($currency as $data)
													<option data-rate="{{$data->sell}}" data-price="{{$data->price}}" data-range="Min: ${{$data->min}} - Max:${{$data->max}}" data-symbol="{{$data->symbol}}" data-name="{{$data->name}}" value="{{$data->id}}">{{$data->name}}</option>
													@endforeach
												</select>
                                                    </div>
                                                </div>





                                                <div class="form-group">
                                                    <label class="@if(Auth::user()->darkmode != 0) text-white @endif">Enter your amount</label>
                                                    <div class="input-group">
                                                        <input class="form-control" name="amount"  id="usd" onkeyup="myFunction()" type="number" placeholder="$0.00">

                                                    </div>

                                                </div>



                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="buyer-seller">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="buyer-info">
                                            <div class="media">
                                                <img class="mr-3" src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}" alt="" width="50">
                                                <div class="media-body">
                                                    <h4 class="@if(Auth::user()->darkmode != 0) text-white @endif">Seller</h4>
                                                    <h5 class="@if(Auth::user()->darkmode != 0) text-white @endif">{{Auth::user()->firstname .' '. Auth::user()->lastname}}</h5>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                          <script>
function myFunction() {
 var rate = $("#currency option:selected").attr('data-rate');
 var name = $("#currency option:selected").attr('data-name');
 var symbol = $("#currency option:selected").attr('data-symbol');
 var price = $("#currency option:selected").attr('data-price');
 var range = $("#currency option:selected").attr('data-range');
 var amount = $('#usd').val() ;
 var topay = rate*amount
  document.getElementById("get").innerHTML = "{{$general->cur_sym}}"+topay;
  document.getElementById("rate").innerHTML = "1"+symbol+" = $"+price;
  document.getElementById("button").innerHTML = "Sell "+name;

 };
</script>
                                                <tr>
                                                    <td>Rate</td>
                                                    <td id="rate">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td> Total</td>
                                                    <td id="get">0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="submit" id="button" name="submit"
                                                    class="btn btn-primary btn-block">Sell
                                                    Now</button>

                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                <!-- row opened -->
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Recent Buying Orders </div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table card-table table-striped text-nowrap table-bordered border-top">
												<thead>
													<tr>
														<th>ID</th>
														<th>Type</th>
														<th>Units</th>
														<th>USD</th>
														<th>You Get</th>
														<th>Status</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												@foreach($trade as $data)
													<tr>
														<td>#{{$data->trx}}</td>
														<td class="text-success">Sell</td>
														<td> {{number_format($data->getamo,6)}}<a class="cc -alt text-primary">{{App\Currency::whereId($data->currency_id)->first()->symbol ?? ''}}</a></td>
														<td><i class="fa fa-usd text-primary"></i> {{number_format($data->amount,2)}}</td>
														<td>{{$general->cur_sym}} {{number_format($data->main_amo,2)}}</td>
																												@if($data->status == 0)
														<td><span class="badge badge-warning-light badge-pill">Pending</span></td>
														@elseif($data->status == 1)
														<td><span class="badge badge-success-light badge-pill">Completed</span></td>
														@else
														<td><span class="badge badge-danger-light badge-pill">Declined</span></td>
														@endif
														<td>{{date(' d M, Y ', strtotime($data->created_at))}} {{date('h:i A', strtotime($data->created_at))}}</td>
													</tr>
											  @endforeach


												</tbody>
											</table>
											 @if(count($trade) < 1)
											 <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Hey Boss!</strong>   You dont have any trade at the moment</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>

											  @endif
										</div>
									</div>
								</div>
							</div>


                    <!--<div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">FAQ</h4>
                            </div>
                            <div class="card-body">
                                <div id="accordion-faq" class="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"
                                                data-target="#collapseOne1" aria-expanded="false"
                                                aria-controls="collapseOne1"><i class="fa" aria-hidden="true"></i>How Do I Buy Crypto</h5>
                                        </div>
                                        <div id="collapseOne1" class="collapse show" data-parent="#accordion-faq">
                                            <div class="card-body">Select a cryp
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"
                                                data-target="#collapseTwo2" aria-expanded="false"
                                                aria-controls="collapseTwo2"><i class="fa" aria-hidden="true"></i>How
                                                Long Will it Take To Get My Package?</h5>
                                        </div>
                                        <div id="collapseTwo2" class="collapse" data-parent="#accordion-faq">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                                cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"
                                                data-target="#collapseThree3" aria-expanded="false"
                                                aria-controls="collapseThree3"><i class="fa" aria-hidden="true"></i>How
                                                Do I Track My Order?</h5>
                                        </div>
                                        <div id="collapseThree3" class="collapse" data-parent="#accordion-faq">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                                cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"
                                                data-target="#collapseThree4" aria-expanded="false"
                                                aria-controls="collapseThree4"><i class="fa" aria-hidden="true"></i>Do I
                                                Need A Account To Place Order?</h5>
                                        </div>
                                        <div id="collapseThree4" class="collapse" data-parent="#accordion-faq">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                                cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"
                                                data-target="#collapseThree5" aria-expanded="false"
                                                aria-controls="collapseThree5"><i class="fa" aria-hidden="true"></i>How
                                                do I Place an Order?</h5>
                                        </div>
                                        <div id="collapseThree5" class="collapse" data-parent="#accordion-faq">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                                                cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="intro-video-play">
                            <div class="play-btn">
                                <a class="popup-youtube" href="https://www.youtube.com/watch?v=IjzUwnqWc5Q">
                                    <span><i class="fa fa-play"></i></span></a>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>



    </div>

@endsection
