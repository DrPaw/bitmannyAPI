
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
						<p>Home > {{$page_title}}</p>
						
					</div>
					<!-- Header content end -->
				</div>
				
			</div>
		</div>	
	</section>
	<!-- Banner Section Ends -->
	
    <div class="privacy-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-page main-page--style">
                        <div class="card-body my-3">
                            <p>@php echo $menu->value->body @endphp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
