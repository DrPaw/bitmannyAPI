
@extends('include.auth')
@section('content')
 <div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                            <div class="mini-logo text-center my-5">
                                <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                            </div>
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Sign in</h4>
                            </div>
                            <div class="card-body">
                                 <form action="{{ route('user.login') }}" method="POST" class="signin_validate" class="signin_validate row g-3"id="recaptchaForm">
                                 @csrf
                                   <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Enter Username"
                                            name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group mb-0">
                                            <label class="toggle">
                                                <input class="toggle-checkbox" type="checkbox">
                                                <div class="toggle-switch"></div>
                                                <span class="toggle-label">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <a href="{{route('user.password.request')}}">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <input class="form-check-input" name="g-recaptcha-response" value="true"  hidden >
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Don't have an account? <a class="text-primary" href="{{ route('user.register') }}">Sign
                                            up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
