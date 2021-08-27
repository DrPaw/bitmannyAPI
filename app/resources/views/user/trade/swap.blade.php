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
                                        <li class="nav-item"><a class="nav-link active" data-toggle="buy"
                                                href="">Coin Swap</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content tab-content-default">
                                        <div class="tab-pane fade show active" id="buy" role="tabpanel">

                                            <form class="contact-form" class="currency_validate" action="" method="post" enctype="multipart/form-data">
                                        @csrf

                                                <div class="row">
                                                <div class="form-grop col-12" >
                                                    <label class="@if(Auth::user()->darkmode != 0) text-white @endif">What You Have</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-server @if(Auth::user()->darkmode != 0) text-white @endif"></i></label>
                                                        </div>
                                                        <select name="from" id="currency" onchange="myFunction()"  class="form-control select2 custom-select" data-placeholder="Bitcoin">
													<option label="Choose one">Select Currency
													</option>
													@foreach($currency as $data)
													<option data-rate="{{$data->swap}}" data-price="{{$data->price}}" data-range="Min: ${{$data->min}} - Max:${{$data->max}}" data-symbol="{{$data->symbol}}" data-name="{{$data->name}}" value="{{$data->id}}">{{$data->name}}</option>
													@endforeach
												</select>
                                                    </div>
                                                </div>

                                                <div class="form-grop col-12">
                                                    <label class="@if(Auth::user()->darkmode != 0) text-white @endif">What You Want</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i
                                                                    class="fa fa-bank @if(Auth::user()->darkmode != 0) text-white @endif"></i></label>
                                                        </div>
                                                        <select id="want" onchange="myFunction2()"  class="form-control select2 custom-select" name="to" data-placeholder="choose">
													<option label="Choose one">
													</option>
													@foreach($currency as $data)
													<option data-want="{{$data->symbol}}" data-name="{{$data->name}}" value="{{$data->id}}">{{$data->name}}</option>
													@endforeach
												</select>
                                                    </div>
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
 var amount = $('#usd').val();
 var charge = amount/100*rate;
 var toget = amount-charge;
  document.getElementById("rate").innerHTML = rate+"%";
  document.getElementById("from").innerHTML = symbol;
  document.getElementById("button").innerHTML = "Swap "+name;
  document.getElementById("get").innerHTML = "$"+toget;
  document.getElementById("charge").innerHTML = "$"+charge;

 };
</script>

<script>
function myFunction2() {
 var want = $("#want option:selected").attr('data-want');

  document.getElementById("to").innerHTML = want;

 };
</script>
                                                <tr>
                                                    <td><span class="text-primary">Swap Rate </span></td>
                                                    <td><span class="text-primary" id="rate" >0.00%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Swap From</td>
                                                    <td id="from">None</td>
                                                </tr>
                                                <tr>
                                                    <td>Swap To</td>
                                                    <td id="to">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Charge</td>
                                                    <td id="charge" >0.00</td>
                                                </tr>
                                                <tr>
                                                    <td> You Get</td>
                                                    <td id="get">0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="submit" id="button" name="submit"
                                                    class="btn btn-primary btn-block">Swap
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
										<div class="card-title">Recent Swap Orders </div>
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
														<th>From</th>
														<th>Charge</th>
														<th>To</th>
														<th>Status</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												@foreach($trade as $data)
													<tr>
														<td>#{{$data->trx}}</td>
														<td class="text-success">Swap</td>
														<td>{{$data->explorer_url}}<br>
														<small><i class="fa fa-usd text-primary"></i> {{number_format($data->usd,2)}}</small>
														</td>
														<td>{{$data->hash}}% <br>
														<small><i class="fa fa-usd text-primary"></i>{{number_format($data->usd-$data->amount,2)}}</small>
														</td>

														<td>{{$data->wallet_id}}<br>
														<small><i class="fa fa-usd text-primary"></i> {{number_format($data->amount,2)}}</s,mall>
														</td>

                                                       @if($data->status == 0)
														<td><span class="badge badge-warning badge-pill">Pending</span></td>
														@elseif($data->status == 1)
														<td><span class="badge badge-success badge-pill">Completed</span></td>
														@else
														<td><span class="badge badge-danger badge-pill">Declined</span></td>
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



                </div>
            </div>
        </div>



    </div>

@endsection
