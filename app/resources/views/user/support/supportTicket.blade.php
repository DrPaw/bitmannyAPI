@extends('include.user')

@section('content')

    </script>
  <!-- row opened -->
  <!-- Banner opened -->


					<div class="content-body">
            <div class="container">
                <div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="{{route('user.ticket.open') }}" class="badge badge-info"> @lang('Create Ticket')</a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													 <tr>
                                                        <th scope="col">@lang('SL')</th>
                                                        <th scope="col">@lang('Date')</th>
                                                        <th scope="col">@lang('Ticket Number')</th>
                                                        <th scope="col">@lang('Subject')</th>
                                                        <th scope="col">@lang('Status')</th>
                                                        <th scope="col">@lang('Action')</th>
                                                    </tr>
												</thead>
												<tbody>
												@foreach($supports as $key => $support)
                                                        <tr>
                                                            <td data-label="@lang('SL')">{{ ++$key }}</td>
                                                            <td data-label="@lang('Date')">{{ $support->created_at->format('d M, Y h:i A') }}</td>
                                                            <td data-label="@lang('Ticket')">#{{ $support->ticket }}</td>
                                                            <td data-label="@lang('Subject')">{{ $support->subject }}</td>
                                                            <td data-label="@lang('Status')">
                                                                @if($support->status == 0)
                                                                    <span class="badge badge-primary">@lang('Open')</span>
                                                                @elseif($support->status == 1)
                                                                    <span class="badge badge-success "> @lang('Answered')</span>
                                                                @elseif($support->status == 2)
                                                                    <span class="badge badge-info"> @lang('Customer Replied')</span>
                                                                @elseif($support->status == 3)
                                                                    <span class="badge badge-danger ">@lang('Closed')</span>
                                                                @endif
                                                            </td>

                                                            <td data-label="@lang('Action')">
                                                                <a href="{{ route('user.message', $support->ticket) }}"  style="background-color: {{$general->bclr}}" class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
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
