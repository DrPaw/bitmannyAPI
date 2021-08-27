@extends('include.user')

@section('content')
<!-- row opened --><div class="content-body">
            <div class="container">

						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="single-productslide">
										<div class="row no-gutter">
											<div class="col-lg-12 border-right pr-0">
												<div class="product-gallery p-4">
													<div class="product-item text-center">
														<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($offer->user_id)->first()->image ?? '') }}" width="100" alt="img">
													<br>
													Seller Username: {{App\User::whereId($offer->user_id)->first()->username ?? "Unknown"}}
													<div class="product-gallery-rats">
														<ul class="product-gallery-rating">
														@php
														if($comments < 1) $comments = 1;
														$sold = App\Cryptotrade::whereUserId(Auth::user()->id)->wherePaid(1)->whereStatus(0)->whereDispute(0)->count(); @endphp


															<li>
												@php $ranking = $rating/$comments; @endphp
												@if($ranking < 1)
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($ranking > 0 && $ranking < 2)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($ranking > 1 && $ranking < 3)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($ranking > 2 && $ranking < 4)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($ranking > 3 && $ranking < 5)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($ranking > 4)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												@endif


															</li>
														</ul>

														<div class="label-rating">Rate: {{$rating/$comments}} of 5</div>
														<div class="label-rating">{{$sold}} Successful Trade(s)</div>
													</div>
													</div>


													<h3 class="mb-3 fs-20 font-weight-semibold">{{$coin->name ?? "N/A"}} </h3>
													<div class="mb-3">
														<span class="font-weight-semibold h3 text-primary">{{$offer->rate}}{{$offer->currency}}</span>
														<spanfaf>/USD</span>
													</div>
													<h6 class="font-weight-semibold">DESCRIPTION</h6>
													<p class="text-muted">{{$offer->note}}</p>
													<dl class="product-gallery-data1">
														<dt>Code</dt>
														<dd>{{$offer->code}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Range</dt>
														<dd>${{$offer->min}} - ${{$offer->max}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Country</dt>
														<dd>{{$offer->country}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Payment</dt>
														<dd>{{App\Paymentmethod::whereId($offer->payment_method)->first()->name ?? "N/A"}}</dd>
													</dl>

													<br>

                                                <script>
                                                function convert() {
                                                var usd = $('#usd').val();
                                                 var pay = usd*{{$offer->rate}};
                                                  document.getElementById("pay").innerHTML = "<b>You Pay: "+pay+"{{$offer->currency}}</b>";
                                                  document.getElementById("window").innerHTML = "<br><a class='text-danger'>Be ready to make your payment to the seller within the payment window of <b>{{$offer->expire}} Minutes</a></b>";

                                                };
                                                </script>
                                                    <form  id="form" class="contact-form" action="{{route('user.contactseller',$offer->code)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <small>Enter Amount To Buy (USD)</small><br>
													<div class="input-group">

													<input type="number"  id="usd" onkeyup="convert()" class="form-control" name="amount" placeholder="${{$offer->min}} - ${{$offer->max}}" >
                                					</div>
                                					<a id="pay"></a>
                                					<a id="window"></a>
                                					<br>
                                					<small>Please enter Your {{$coin->name ?? ""}} Wallet to receive your {{$coin->symbol ?? ""}}.<br>
                                					Please note: We will not be liable to any loss arising from you entering a wrong wallet address </small><br>
													<div class="input-group">
													<script>
function myFunction2() {
 var balance = $("#wallet option:selected").attr('data-balance');
 var wallet = $("#wallet option:selected").attr('data-address');
  document.getElementById("balance").innerHTML = "<b>balance: "+balance+"{{$coin->symbol ?? ""}}</b>";
  document.getElementById("address").innerHTML = "<b>Address: "+wallet+"</b>";
 };
</script>

												<!--	<select id="wallet" onchange="myFunction2()"  name="wallet" class="form-control select2-show-search custom-select">
																<option selected readonly>Select Wallet</option>
																 @foreach($wallet as $data)
																<option data-balance="{{$data->balance}}" data-address="{{$data->address}}"value="{{$data->id}}">{{$data->label}}</option>
																@endforeach
													</select> -->
														<input type="text"  class="form-control" name="wallet" placeholder="Enter Your Wallet Address">

                                					</div>
                                					<a id="address"></a>
													<br><a id="balance"></a>
                                					<br>

													<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-primary mt-1"> <i class="fa fa-shopping-cart"></i> Contact Seller </button>
													</form>


												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


						<!-- row opened -->
						<div class="">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Rating And Reviews</h3>
								</div>
								<div class="card-body p-0">
								@foreach($comment as $data)
									<div class="media mt-0 p-5">
										<div class="d-flex mr-3">
											<a href="#"><img class="media-object brround" alt="64x64" src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}"> </a>
										</div>
										<div class="media-body">
											<h5 class="mt-0 mb-1 font-weight-semibold">{{App\User::whereId($data->buyer)->first()->username ?? "N/A"}}
												@if($data->rate > 4)
												<span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title="Satisfied"><i class="fa fa-check-circle-o text-success"></i></span>
												@endif
												<span class="fs-14 ml-2">
												@if($data->rate == 1)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($data->rate == 2)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($data->rate == 3)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($data->rate == 4)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star-o text-yellow"></i>
												@elseif($data->rate == 5)
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												<i class="fa fa-star text-yellow"></i>
												@endif

												</span>
											</h5>
											<small class="text-muted"><i class="fa fa-calendar"></i> {{date(' d M, Y ', strtotime($data->created_at))}}  <i class=" ml-3 fa fa-clock-o"></i> {{date('h:i A', strtotime($data->created_at))}} </small>
											<p class="font-13  mb-2 mt-2">
											   {{$data->comment}}
											</p>
											@foreach($reply as $reply)
											<div class="media mt-5">
												<div class="d-flex mr-3">
													<a href="#"> <img class="media-object brround" alt="64x64" src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}"> </a>
												</div>
												<div class="media-body">
													<h5 class="mt-0 mb-1 font-weight-semibold">{{App\User::whereId($data->buyer)->first()->username ?? "N/A"}} <span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title="verified"><i class="fa fa-check-circle-o text-success"></i></span></h5>
													<small class="text-muted"><i class="fa fa-calendar"></i> {{date(' d M, Y ', strtotime($reply->created_at))}}  <i class=" ml-3 fa fa-clock-o"></i> {{date('h:i A', strtotime($reply->created_at))}} </small>
													<p class="font-13  mb-2 mt-2">
													   {{$reply->comment}}
													</p>

											<a href="#" class="mr-2" data-toggle="modal" data-target="#Comment"><span class="">Reply</span></a>

												</div>
											</div>
											@endforeach

										</div>
									</div>
								@endforeach

								@if(count($comment) < 1)
								<div class="alert alert-info alert-dismissible fade show" role="alert">
                        			<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
                        			<span class="alert-inner--text"><strong>Hello Buyer!</strong> There is no comment or rating on this offer yet.Be the first to rate this seller by proceeding with initiating a transaction on this offer!</span>
                        			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                        				<span aria-hidden="true">×</span>
                        			</button>
                        		</div>
		                        @endif


                            @if($bought > 0)
							<div class="col-lg-12">
							<form  id="form" class="contact-form" action="{{route('user.rateseller',$offer->code)}}" method="post" enctype="multipart/form-data">
                             @csrf

							<div class="form-group overflow-hidden">
													<label>Select Rating</label>
													<select name="rate" class="form-control select2 w-100" >
														<option disabled selected="selected">Select Rating</option>
														<option value="0" >0 Stars</option>
														<option value="1" >1 Stars</option>
														<option value="2" >2 Stars</option>
														<option value="3" >3 Stars</option>
														<option value="4" >4 Stars</option>
														<option value="5" >5 Stars</option>
													</select>
							</div>

								<div class="form-group">
								    <label class="form-label">Post Comment</label>
										<div class="input-group">
											<input type="text" name="comment" class="form-control" placeholder="Enter Comment">
											<span class="input-group-append">
											    <button class="btn btn-primary" type="submit">Reply</button>
											</span>
										</div>
								</div>
							</form>
							<center> <b class="text-info">Please note, you can only rate a trade once. You cal always edit your rating thereafter from this page</b></center>

							@endif
						    </div>

						    </div></div>
						<!-- row closed -->

						</div>

						</div>

						</div>

						</div>
@endsection
