
@extends('include.auth')

@section('title','Email verification form')

@section('content')
    <!-- page title begin-->

    <section class="login-section  pt-70 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-inset  border-0">
                        <div class="card-header bg-white">
                            <h3 class="title  text-center">@lang('SMS verification form') </h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.user.smsVerForm') }}" class="contact-form mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" name="phone"  readonly placeholder="Enter Your Username" value="{{auth()->user()->phone}}">
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input  name="sms_verified_code" placeholder="Code">
                                            @if ($errors->has('sms_verified_code'))
                                                <small class="text-danger">{{ $errors->first('sms_verified_code') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 pt-4">
                                        <button class="cmn-btn btn-block" type="submit"  style="background-color: {{$general->bclr}}">@lang('Submit')</button>
                                    </div>
                                </div>

                            </form>
                        </div>


                        <div class="card-footer text-muted">
                            @lang('When don\'t sent any code your phone') <a class="btn-link" href="{{route('user.user.sendVcode')}}?phone={{auth()->user()->phone}}"> @lang('Resend code')</a>
                            @if ($errors->has('resend'))
                                <br/>
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
