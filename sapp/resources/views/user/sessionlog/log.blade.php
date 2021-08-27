@extends('include.user')

@section('content')

  <!-- row opened -->



							 <!-- row opened -->
     <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$page_title}}</h4>
                            </div>
                             @include('partials.settings')
                        </div>
                    </div>

                     <div class="col-xl-9 col-md-8">
								<div class="card">
									<div class="card-header">
										<div class="@if(Auth::user()->darkmode != 0) text-white @endif">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="{{route('user.clearsession')}}"  class="btn btn-danger btn-sm"><i class="fa fa-trash text-white">Clear Log</i></a>

										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													<tr>
								<th scope="col">@lang('IP Address')</th>
                                <th scope="col">@lang('Browser')</th>
                                <th scope="col">@lang('OS')</th>
                                <th scope="col">@lang('Location')</th>
                                <th scope="col">@lang('Date')</th>
													</tr>
												</thead>
												<tbody>
                                @foreach($log as $k=>$data)
                                    <tr>
                                        <td data-label="#@lang('Trx')">{{$data->user_ip}}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{$data->browser}}</strong>
                                        </td>
                                        <td data-label="@lang('Remaining Balance')">
                                            <strong class="text-info">{{$data->os}}</strong>
                                        </td>
                                        <td data-label="@lang('Details')">{{$data->location}}, {{$data->country}}</td>
                                        <td data-label="@lang('Date')">{{date('d M, Y', strtotime($data->created_at))}}</td>
                                    </tr>
                                @endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->




@endsection
