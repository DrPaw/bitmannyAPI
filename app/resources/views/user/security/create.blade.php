@extends('include.user')

@section('content')
    <!-- row opened -->
     <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="@if(Auth::user()->darkmode != 0) text-white @endif" >{{$page_title}}</h4>
                            </div>
                             @include('partials.settings')
                        </div>
                    </div>

                     <div class="col-xl-9 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="@if(Auth::user()->darkmode != 0) text-white @endif">{{$page_title}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-4">
                                        <div class="id_card">
                                            <img src="{{$qrCodeUrl}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="id_info">
                                            <h3 class="@if(Auth::user()->darkmode != 0) text-white @endif">@lang('Two Factor Authenticator')</h3>
                                            <p class="mb-1 mt-3">@lang('Use Google Authenticator to Scan the QR code  or use the copy code to Google Authentication App') </p>
                                            <p class="mb-1">Status:
                                            @if(Auth::user()->ts)
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<div class="label-rating">@lang('Disabe Two Factor Authenticator')</div>
															@else
															<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<div class="label-rating">@lang('Enable Two Factor Authenticator')</div>
															@endif
                                            </p>

                                            <div class="input-group">
                                                    <input type="text" name="key" value="{{$secret}}"
                                                           class="form-control form-control-lg" id="referralURL"
                                                           readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text copytext" id="copyBoard"
                                                              onclick="myFunction()"> <i class="fa fa-copy text-white"></i> </span>
                                                    </div>
                                            </div>

                                            <div class="product-ship"><br>
														<p>
														    @if(Auth::user()->ts)
															<a href="#0"  class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#disableModal">@lang('Disable Google 2FA')</a>
															@else
															 <a href="#0" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enableModal">@lang('Enable Google 2FA')</a>
															@endif
														</p>
														<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" class="fs-18"> <i class="fa fa-android text-success mr-1"></i> @lang('DOWNLOAD APP')</a>
													</div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>





    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Google OTP')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.go2fa.create')}}" method="POST">
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"  style="background-color: {{$general->bclr}}">@lang('Verify')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Google OTP to Disable')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.disable.2fa')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success "  style="background-color: {{$general->bclr}}">@lang('Verify')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


@section('javascript')
    <script>
        function myFunction() {
            var copyText = document.getElementById("referralURL");
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
