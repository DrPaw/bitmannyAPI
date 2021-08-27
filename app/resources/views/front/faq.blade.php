
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
						<p>FAQ</p>
						
					</div>
					<!-- Header content end -->
				</div>
				
			</div>
		</div>	
	</section>
	<!-- Banner Section Ends -->
	
		<!-- FAQ Section starts -->
	<section class="faq" id="faq">
		<div class="container">
			<div class="row">
				<!-- Section title start -->
				<div class="col-md-12">
					<div class="section-title">
						<h2>Frequently asked questions</h2>
					</div>
				</div>
				<!-- Section title end -->
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- FAQ Accordion start -->
					<div id="accordion" class="faq-accordion">
						<!-- Faq Panel start -->
						@foreach($faqs as $k=>$data)
                      
						<div class="card active wow fadeInUp" data-wow-delay="0.2s">
							<div class="card-header" id="heading{{$data->id}}">
								<h5 class="mb-0">
									<a data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="collapse{{$data->id}}">{{__($data->value->title)}}</a>
								</h5>
							</div>
							<div id="collapse{{$data->id}}" class="collapse show" aria-labelledby="heading{{$data->id}}" data-parent="#accordion">
								<div class="card-body">
									<p>@php echo $data->value->body @endphp</p>
								</div>
							</div>
						</div>
						<!-- Faq Panel end -->
						
						
                       @endforeach
						
					</div>
					<!-- FAQ Accordion end -->
				</div>
			</div>
		</div>
	</section>


@endsection
