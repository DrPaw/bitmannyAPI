
@extends('include.front')
@section('content')

<!-- Banner Section Starts -->
	<section class="banner" id="home"  style="background-color: {{$general->bclr}}">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Header content start -->
					<div class="header-content wow fadeInUp">
						<h2><span>{{$page_title}}</span></h2>
						<p>Send Us A Message</p>
						
					</div>
					<!-- Header content end -->
				</div>
				
			</div>
		</div>	
	</section>
	<!-- Banner Section Ends -->
	
	<!-- Contact us section starts -->
	<section class="contactus" id="contact">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Contact us</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- Contact us Form start -->
					<div class="contact-form wow fadeInUp" data-wow-delay="0.2s">
						<form method="post" class="contact_validate" action="">
                                        @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Full name
                                        </label>
                                        <input type="text" class="form-control" id="contactName" placeholder="Full name"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="hello@domain.com">

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="number" class="form-control" name="phone"
                                            placeholder="+1-768923-731">

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Subject
                                        </label>
                                        <input type="email" class="form-control" name="subject"
                                            placeholder="Message Subject">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control p-3" name="message" rows="5"
                                            placeholder="Tell us what we can help you with!"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-4 py-2"  style="background-color: {{$general->bclr}}">
                                Send message
                            </button>
                        </form>
					</div>
					<!-- Contact us Form end -->
				</div>
			</div>
		</div>
	</section>
	<!-- Contact us section ends -->


 




@endsection
