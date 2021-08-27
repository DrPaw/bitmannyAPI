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
                                <h4 class="card-title">{{$page_title}}</h4>
                            </div>
                             @include('partials.settings')
                        </div>
                    </div>

                     <div class="col-xl-9 col-md-8">
									<div class="card">
										<div class="card-header">
											<div class="card-title">Edit Password</div>
										</div>
										<form class="contact-form" action="" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="card-body">



											<div class="form-group">
												<label class="form-label">@lang('Current Password:')</label>
												 <input type="text" class="col-sm-12 form-control" id="CurrentPassword" name="current_password" placeholder="@lang('Current Password')">
                                            </div>
											<div class="form-group">
												<label class="form-label">@lang('New Password:')</label>
												 <input type="text" class="col-sm-12 form-control" id="password" name="password" placeholder="@lang('New Password')">
											</div>
											<div class="form-group">
												<label class="form-label">@lang('Confirm Password:')</label>
												 <input type="text" class="col-sm-12 form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('Confirm Password')">
											</div>
											<button type="submit" href="#" class="btn btn-primary ">@lang('Change Password')</button>
										</div>
										</form>
									</div>
									<div class="card panel-theme">
										<div class="card-header">
											<div class="float-left">
												<h3 class="card-title">Last Updated</h3>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="card-body no-padding">
											<ul class="list-group no-margin">
												<li class="list-group-item"><i class="fa fa-envelope mr-4"></i> {{date(' d M, Y ', strtotime(Auth::user()->passupdate))}} {{date('h:i A', strtotime(Auth::user()->passupdate))}}</li>

											</ul>
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
