
@extends('include.auth')
@section('content')

<div id="main-wrapper">
    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-4">
                        <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{$page_title}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">

                         @if($errors->any())
                    <ul>
                        @foreach($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                       @endif
                        <form action="{{ route('user.password.email') }}" method="POST" class="signin_validate" class="signin_validate row g-3"id="recaptchaForm">
                                 @csrf
                                   <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Enter Email"
                                            name="email">
                                    </div>


                                    <input class="form-check-input" name="g-recaptcha-response" value="true"  hidden >
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Send Code</button>
                                    </div>
                                </form>



                            <p class="mt-3 mb-0">Have an account? <a class="text-primary" href="{{ route('user.login') }}">Sign
                                    in</a></p>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
