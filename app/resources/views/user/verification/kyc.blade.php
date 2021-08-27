@extends('include.user')

@section('content')

<!-- App-content opened -->



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
											<h3 class="@if(Auth::user()->darkmode != 0) text-white @endif"">
											@if(Auth::user()->kyc < 1)
                                            Account Not Verified
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-o text-warning"></i></span>


													@else
													Account Verified
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
													@endif
											</h3>
										</div>
										<div class="card-body">
											 <form action="{{route('user.kycpost')}}" class="form" id="kt_form"  method="post" enctype="multipart/form-data">
                                                                 @csrf



                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                            <label for="city" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Upload ID:')</label>
                             <div class="file-upload-wrapper" data-text="Select ID">
                                                        <input type="file" name="image" accept="image/*" type="file"
                                                            class="file-upload-field" value="">
                            </div>
										</div>
                        </div>


                        <div class="form-group col-sm-6">
                            <label for="lastname" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Type Of ID:')</label>
                            <select name="type" class="form-control">
<option>Company ID Card</option>
<option>Drivers' Licence</option>
<option>International Passport</option>
<option>Voters' Card</option>
</select>
                        </div>



                        <div class="form-group col-sm-6">
                            <input type="hidden" id="track" name="country_code">
                            <label for="phone" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('ID Number')</label>
                           <input type="text" value="{{$kyc->number ?? 'N/A'}}" class="form-control" name="number"  required  placeholder="Enter Number on ID" />
                        </div>

                    </div>



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="address" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Expiry Date:')</label>
                            <input type="date"  value="{{$kyc->expiry ?? 'N/A'}}"  class="form-control"  required name="expiry" value="" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Address:')</label>
                            <input type="text" class="form-control" name="address" placeholder="Address Line 1" required  value="{{$kyc->address ?? "Not Set"}}" />
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="zip" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Post Code:')</label>
                            <input type="text" class="form-control" name="zip" placeholder="Postcode"  required value="{{$kyc->zip ?? "Not Set"}}" />
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('City:')</label>
                            <input type="text" class="form-control" name="city" placeholder="City"  required value="{{$kyc->city ?? "Not Set"}}" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="zip" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('State:')</label>
                            <input type="text" class="form-control " name="state" placeholder="State"  required value="{{$kyc->state ?? "Not Set"}}" />
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Country:')</label>
                            <input type="text" class="form-control" name="country" placeholder="Country" required  value="{{$kyc->country ?? "Not Set"}}" />
                        </div>

                    </div>






											<button type="submit"  class="btn btn-primary mt-1">Upload ID</abutton

                </form>
											</div>
										</div>

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
