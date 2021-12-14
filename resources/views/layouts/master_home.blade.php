<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sri Lanka vegetable e-market place</title>
		<!-- FAVICON -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Kalam:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Just+Another+Hand" rel="stylesheet">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css')}}">
		<!-- FontAwesome CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css')}}">
		<!-- Slick Slider CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/slick/slick.css')}}">
		<!-- Reset CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/reset.css')}}">
		<!-- Style CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/style.css')}}">
		<!-- Responsive CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
	    <!-- The Farm House colors. We have chosen the color Vermilion for this default
	          page. However, you can choose any other color by changing color css file.
	    -->
	    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors/default-vermilion.css')}}">
	    <!-- <link rel="stylesheet" type="text/css" href="css/colors/shamrock.css"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="css/colors/keylimepie.css"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="css/colors/scooter.css"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="css/colors/goldengrass.css"> -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		  <style type="text/css">
    /* Scrollbar Styling */
::-webkit-scrollbar {
    width: 10px;
}
 
::-webkit-scrollbar-track {
    background-color: #ebebeb;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #6d6d6d; 
}
  </style>
	</head>
	<body class="js">
	    <!-- Page loader -->
	    <div id="preloader"></div>
		<!-- header area start -->
		<header class="farm-navbar-area">
			<nav class="navbar navbar-expand-sm">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
						data-target="#bs-example-navbar-collapse-1" aria-expanded="false">&#x2630;</button>
						<a class="navbar-brand"
						href="#home">
							<img src="{{ asset('frontend/img/logo-1.png')}}" alt="">
						</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav menu navbar-nav ml-auto">
							<li class="current-menu-item nav-item"><a href="#home" class="nav-link">Home</a>
							</li>
							<li class="nav-item"><a href="#about" class="nav-link">About</a>
							</li>
							<li class="nav-item"><a href="#product" class="nav-link">products</a>
							</li>
							<li class="nav-item"><a href="#prices" class="nav-link">prices</a>
							</li>
							<li class="nav-item"><a href="#gallery" class="nav-link">gallery</a>
							</li>
							<li class="nav-item"><a href="#faq" class="nav-link">FAQ&#xB4;s</a>
							</li>
							<li class="nav-item"><a href="#app" class="nav-link">App</a>
							</li>
							@if (!Auth::check())
						    <li class="nav-item"><a href="/login" class="nav-link">Login</a>
							</li>
							<li class="nav-item"><a href="/register" class="nav-link">Register</a>
							</li>
							@else
							<li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
							</li>
							@endif
							<li class="nav-item"><a href="#contact" class="nav-link"><span class="fa fa-pencil-square-o"></span></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header><!-- header area end -->
		@php
			$sliders = DB::table('sliders')->get();

		@endphp
		<!-- slider area start -->
		<section class="farm-welcome-text wow fadeIn" id="home">
		   <div class="farm-home-slider-area">
			   <div class="farm-home-slider">
			   	@foreach($sliders as $slider)

				   <div class="farm-slider-item">
					   <img src="{{ asset($slider->image)}}" alt="">
					   <div class="item-content">
							<div class="container">
								<div class="row">
									<div class="col-12 text-center">
										<div class="welcome-text-content">
											<div class="weltext">
												<h2 class="welcome-text">{{$slider->text1}}</h2>
												<h2 class="welcome-text"><span>{{$slider->spectext}}</h2>
												<h2 class="welcome-text">{{$slider->text2}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
					   </div>
				   </div>
				   @endforeach
				   <div class="farm-slider-item">
					   <img src="{{ asset('frontend/img/home-slider/slide-2.jpg')}}" alt="">
					   <div class="item-content">
							<div class="container">
								<div class="row">
									<div class="col-12 text-center">
										<div class="welcome-text-content">
											<div class="weltext">
												<h2 class="welcome-text">Fresh <span>vegetables & fruits</span></h2>
												<h2 class="welcome-text">Freshly grown for customers.</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
					   </div>
				   </div>
				   <div class="farm-slider-item">
					   <img src="{{ asset('frontend/img/home-slider/slide-3.jpg')}}" alt="">
					   <div class="item-content">
							<div class="container">
								<div class="row">
									<div class="col-12 text-center">
										<div class="welcome-text-content">
											<div class="weltext">
												<h2 class="welcome-text">islandwide distributed <span>regional agriculture product collection center</span></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
					   </div>
				   </div>
{{-- 				   <div class="farm-slider-item">
					   <img src="{{ asset('frontend/img/home-slider/slide-4.jpg')}}" alt="">
					   <div class="item-content">
							<div class="container">
								<div class="row">
									<div class="col-12 text-center">
										<div class="welcome-text-content">
											<div class="weltext">
												<h2 class="welcome-text">No <span>commissioner intermediate agents</span></h2>
												<h2 class="welcome-text">you sell in your own market place</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
					   </div>
				   </div> --}}
			   </div>
		   </div>
			<div class="farm-social-icon">
				<a href="http://facebook.com" class="fa fa-facebook"></a>
	            <a href="http://twitter.com" class="fa fa-twitter"></a>
	            <a href="http://youtube.com" class="fa fa-youtube"></a>
			</div>
		</section><!-- slider area end -->
		<!-- about area start -->
		<section id="about" class="farm-about-us">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="farm-about-content">
							<h2 class="content-title">About us</h2>
							<h3 class="wow zoomIn">{{$abouts->discription}}{{-- The Department of Agriculture (DOA) functions under the Ministry of Agriculture and the DOA is one of the largest government departments with a high profile community of agricultural scientists and a network of institutions covering different agro ecological regions island wide. --}}
 </h3>
							<h4 class="wow zoomIn text-danger font-weight-bold"><span>V</span>Vision</h4>
							<h4>{{$abouts->vision}}{{-- >Achieve excellence in agriculture for national prosperity --}} </h4>
							<h4 class="wow zoomIn text-danger font-weight-bold"><span>M</span>Mision</h4>
							<h4>{{$abouts->mision}}{{-- Achieve an equitable and sustainable agriculture development through development and dissemination of improved agriculture technology --}}</h4>
							<div class="contact-botton text-center wow zoomIn">
								<a href="#contact">Contact us</a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="farm-about-img wow zoomIn">
							<img src="{{ asset('frontend/img/about-right.png')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</section><!-- about area end -->
		<!-- product area start -->
		<section id="product" class="farm-latest-products">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="farm-section-title">
							<h2 class="section-title">Latest Vegetables</h2>
							<h4>Directly from the farm, freshly grown for Sri Lankan Farmer</h4>
						</div>
					</div>
				</div>
				<div class="farm-product-slider">
					<div class="row product-select">
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-1.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-1.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-2.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-2.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('img/latest-products/product-3.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-3.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-4.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-4.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row product-select">
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-1.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-1.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-2.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-2.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-3.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-3.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-4.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-4.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row product-select">
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-1.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-1.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-2.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-2.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-3.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-3.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="farm-single-product">
								<div class="single-product">
									<img src="{{ asset('frontend/img/latest-products/product-4.png')}}" alt="">
								</div>
								<div class="product-free">
									<img src="{{ asset('frontend/img/latest-products/pro-icon-4.png')}}" alt="">
								</div>
								<div class="hover-product"><a href="#">See Product</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- product area end -->
		@php
			$vegitable_price = DB::table('vegitable_prices')
                               ->Join('vegitables','vegitable_prices.veg_id','=','vegitables.id')
                              ->get();

		@endphp
		<!-- prices area start -->
		<section id="prices" class="farm-pricing-list">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6">
						<div class="farm-pricing-table wow zoomIn">
							<table>
								<thead>
									<tr class="table-heading">
										<th>product</th>
										<th>Sale Price</th>
										<!-- <th>Retial Sale Price</th> -->
									</tr>
								</thead>
								<tbody>
									@foreach($vegitable_price as $price)
									<tr>
										<td>{{$price->name}}</td>
										<td>Rs. {{ number_format($price->price_wholesale , 2) }}</td>
										<!-- <td>Rs. {{ number_format($price->price_retial , 2) }}</td> -->
									</tr>
									@endforeach
									{{-- <tr>
										<td>Broccoli</td>
										<td>Rs.350.00</td>
										<td>Rs.450.00</td>
									</tr>
									<tr>
										<td>Green Onion</td>
										<td>Rs.200.00</td>
									</tr>
									<tr>
										<td>Carrots</td>
										<td>Rs.240.00</td>
									</tr>
									<tr>
										<td>Hot Peppers</td>
										<td>Rs.500.00</td>
									</tr>
									<tr>
										<td>Sweet Potato</td>
										<td>Rs.150.00</td>
									</tr>
									<tr>
										<td>Zucchini</td>
										<td>Rs.200.00</td>
									</tr> --}}
								</tbody>
							</table>
						</div>
					</div>
					<div class="mx-md-auto col-lg-6 col-md-6">
						<div class="farm-price-content">
								<h2 class="content-title">Vegetables Price List</h2>
								<h4>We grow over 50 different vegetables and fruits  &amp; several varieties of each item; this is just a partial of price list.If you want view full analysit price list register our system </h4>
								<h4>These prices are update in daily .Get register system and get lastet price of each product very easily.</h4>
							<div class="contact-botton text-left wow zoomIn">	<a href="#">Contact us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- prices area end -->
		@php
			$vegitables = DB::table('vegitables')
			              ->Join('vegitable_prices','vegitables.id','=','vegitable_prices.veg_id')
			              ->get();
                                                  
		@endphp
		<!-- portfolio area start -->
		<section id="gallery" class="farm-portfolio-section">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="farm-section-title">
							<h2 class="section-title">Product Gallery</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="farm-project-nav">
						<ul>
							<li class="active" data-filter="*">all</li>
							<li data-filter=".vegetables">Vegetables</li>
							<li data-filter=".fruits">Fruits</li>
							<li data-filter=".discount">Up Country</li>
							<li data-filter=".seasonal">Down Country</li>
						</ul>
					</div>
				</div>
				<div class="farm-project-active">
					@foreach($vegitables as $vegitable)
					<div class="farm-single-project vegetables">
						<div class="project-img">
							<img src="{{ asset($vegitable->image)}}" alt="">
							<div class="project-weight">
								<h3>Rs.{{ number_format($vegitable->price_wholesale , 2) }} / kg</h3>
							</div>
						</div>
						<h4>Tomatoes</h4>
					</div>
					@endforeach
					<div class="farm-single-project fruits">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-2.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Mushrooms</h4>
					</div>
					<div class="farm-single-project discount">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-3.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Broccoli</h4>
					</div>
					<div class="farm-single-project seasonal">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-4.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Ginger</h4>
					</div>
					<div class="farm-single-project fruits">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-5.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>$RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Potatoes</h4>
					</div>
					<div class="farm-single-project vegetables">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-6.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Radish</h4>
					</div>
					<div class="farm-single-project discount">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-7.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Garlic</h4>
					</div>
{{-- 					<div class="farm-single-project seasonal">
						<div class="project-img">
							<img src="{{ asset('frontend/img/product-gallery/product-8.png')}}" alt="theiran.com">
							<div class="project-weight">
								<h3>RS.400.99 / kg</h3>
							</div>
						</div>
						<h4>Bananas</h4>
					</div> --}}
				</div>
			</div>
		</section><!-- portfolio area end -->
		<!-- faq area start -->
		@php
			$questions = DB::table('questions')->get();

		@endphp
		<section id="faq" class="farm-faqs-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="farm-faqs-title">
							<h2 class="content-title">Questions</h2>
						</div>
						<div class="farm-house-accourdion">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								@foreach($questions as $key=> $question)
								<div class="panel">
									<div class="card-header" role="tab" id="headingOne">
										<h4 class="card-title">
											  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$key}}" aria-expanded="true" aria-controls="{{$key}}">
												{{-- What type of produce can you expect? --}}
												{{$question->question}}
											  </a>
										</h4>
									</div>
									<div id="{{$key}}" class="panel-collapse collapse show" role="tabpanel"
									aria-labelledby="headingOne">
										<div class="card-body">
											<p>{{-- The season is 20 weeks long for the Downtown Windsor Farmer&#x2019;s Market, running May 28th to October 8th, Sat from 8am-1pm. --}}{{$question->answer}}</p>
										</div>
									</div>
								</div>
								@endforeach
{{--  								<div class="panel">
									<div class="card-header" role="tab" id="headingTwo">
										<h4 class="card-title">
											  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How do you make payment for The Farm House?</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
									aria-labelledby="headingTwo">
										<div class="card-body">
											<p>The season is 20 weeks long for the Downtown Windsor Farmer&#x2019;s Market, running May 28th to October 8th, Sat from 8am-1pm.</p>
										</div>
									</div>
								</div> --}}
								{{--<div class="panel">
									<div class="card-header" role="tab" id="headingThree">
										<h4 class="card-title">
											  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How long is the season?</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
									aria-labelledby="headingThree">
										<div class="card-body">
											<p>The season is 20 weeks long for the Downtown Windsor Farmer&#x2019;s Market, running May 28th to October 8th, Sat from 8am-1pm.</p>
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="card-header" role="tab" id="headingFour">
										<h4 class="card-title">
											 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">What type of produce can you expect?</a>
										</h4>
									</div>
									<div id="collapsefour" class="panel-collapse collapse" role="tabpanel"
									aria-labelledby="headingFour">
										<div class="card-body">
											<p>The season is 20 weeks long for the Downtown Windsor Farmer&#x2019;s Market, running May 28th to October 8th, Sat from 8am-1pm.</p>
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="card-header" role="tab" id="headingFive">
										<h4 class="card-title">
											  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">How much of an experience do you guys have?</a>
										</h4>
									</div>
									<div id="collapsefive" class="panel-collapse collapse" role="tabpanel"
									aria-labelledby="headingFive">
										<div class="card-body">
											<p>The season is 20 weeks long for the Downtown Windsor Farmer&#x2019;s Market,
												running May 28th to October 8th, Sat from 8am-1pm.</p>
										</div>
									</div>
								</div> --}}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="tometo-man wow zoomIn">
							<img src="img/faq-right.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</section><!-- faq area end -->
		<!-- testimonial top area start -->
		<section id="testimonials" class="farm-client-says-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bloc">&#x200B;&#x200C;<span>&#x201C;</span>
						</div>
						<div class="single-client-btn">	<a href="#" class="client-btn">Reviews</a>
						</div>
					</div>
				</div>
				<div class="row blocquate-slick">
					<div class="col-12 col-md-11 text-right">
						<div class="single-client">
							<h2>&quot;I believe it&#x2019;s the organic foods and quality of the natural ingredients that help me feel this great.&quot;</h2>
							<h4>- Kate Jonson</h4>
						</div>
					</div>
					<div class="col-12 col-md-11 text-right">
						<div class="single-client">
							<h2>&quot;I believe it&#x2019;s the organic foods and quality of the natural ingredients that help me feel this great as the Farm House makes me.&quot;</h2>
							<h4>- Kate Ferguson</h4>
						</div>
					</div>
				</div>
			</div>
		</section><!-- testimonial top area end -->
		<!-- sponsor area start -->
		<div id="sponsor" class="farm-sponsor-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="sponsor-slider-active">
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-1.png')}}" alt=""></a>
							</div>
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-2.png')}}" alt=""></a>
							</div>
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-3.png')}}" alt=""></a>
							</div>
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-4.png')}}" alt=""></a>
							</div>
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-1.png')}}" alt=""></a>
							</div>
							<div class="farm-single-sponsor">
								<a href="#"><img src="{{ asset('frontend/img/sponsors/sponsor-2.png')}}" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- sponsor area end -->
		<!-- app area start -->
		<section id="app" class="farm-android-mokup">
			<div class="container RTC">
				<div class="row">
					<div class="col-md-6 text-left app-content">
						<div class="get-app">
							<div class="farm-section-title text-left">
								<h2 class="section-title">Our Web App</h2>
							</div>
						</div>
						<h4>You can register our agricultural product distribution managenent system.It is total free registration.</h4>
						<h4>You can register as <span class="text-danger">buyer or Farmer</span></h4>
						<div class="app-button text-left">
							<a href="/register" class="btn btn-primary btn-lg">Register</a>
							{{-- <a href="#" class="btn btn-danger btn-lg">Login</a> --}}
						</div>
					</div>
					<div class="app-img">
						<img src="{{ asset('frontend/img/app-mobile-view.jpg')}}" alt="">
					</div>
				</div>
			</div>
		</section><!-- app area end -->
		<!-- contact area start -->
		<section id="contact" class="farm-contact-section">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div class="farm-section-title">
								<h2 class="section-title">Contact Details</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<form method="POST" action="{{ route('contact.message.store') }}">
							@csrf
							<div class="farm-contact-form">
@if(session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('success') }}</strong>  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
   </div>
 @endif
								<div class="single-inputc">
									<input type="text" id="name" name="name" placeholder="Name*">
									<span class="text-danger">@error('name'){{$message}}@enderror</span>
								</div>
								<div class="single-inputc">
									<input type="email" id="email" name="email" placeholder="Email*">
									<span class="text-danger">@error('email'){{$message}}@enderror</span>
								</div>
								<div class="single-inputc">
									<input type="text" id="phone" name="phone" placeholder="Phone">
								</div>
{{-- 								<div class="single-inputc">
									<input type="text" id="subject" name="subject" placeholder="Subject">
								</div> --}}
								<div class="porpose">
									<i class="fa fa-angle-down" aria-hidden="true"></i>
									<select class="porpose-select"
									id="contact_reason" name="contact_reason">
                                        <option value="" selected="" disabled="">Select Relavent Reason</option>
										<option value="Registration Question">System Registration Related Question</option>
										<option value="Price Question">Price Related Question</option>
										<option value="Order Question">Order Related Question</option>
										<option value="Other Question">Other Content Related Question</option>
									</select>
									<span class="text-danger">@error('contact_reason'){{$message}}@enderror</span>
								</div>
								@php
			                        
			                        $districts = DB::table('districts')->get();

		                         @endphp
								<div class="porpose">
									<i class="fa fa-angle-down" aria-hidden="true"></i>
									<select class="porpose-select"
									id="district" name="district">
									<option value="" selected="" disabled="">Select District</option>
									@foreach($districts as $key=> $district)
										<option value="{{$district->name_en}}">{{$district->name_en}}</option>
									@endforeach	
									</select>
									<span class="text-danger">@error('district'){{$message}}@enderror</span>
								</div>
								<div class="text-area">
									<textarea id="message" name="message" placeholder="Message ..."></textarea>
									<span class="text-danger">@error('message'){{$message}}@enderror</span>
								</div>
								<div class="single-submit">
									<input type="submit" name="submit"  value="Send Message">
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="single-contact">
							<div class="contact-icon">
								<i class="fa fa-map-marker"></i>
							</div>
							<div class="contact-content">
								<h3>Our Location</h3>
								<p>{{$contacts->location}}</p>
								<br>
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7645074427205!2d80.59928221409665!3d7.267618216083108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae368c4e35f2825%3A0x80258b89e2dcd1f8!2sMinistry%20of%20Agriculture!5e0!3m2!1sen!2slk!4v1632552742451!5m2!1sen!2slk" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div>
						<div class="single-contact">
							<div class="contact-icon">
								<i class="fa fa-phone"></i>
							</div>
							<div class="contact-content">
								<h3>Phone &amp; Fax</h3>
								<p>{{$contacts->phone}} or  {{$contacts->fax}}</p>
							</div>
						</div>
						<div class="single-contact">
							<div class="contact-icon">
								<i class="fa fa-envelope-o"></i>
							</div>
							<div class="contact-content">
								<h3>Our Email</h3>
								<p>{{$contacts->email}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- app area end -->
		<!-- footer area start -->
		<footer class="copyright-section">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<p>&copy; 2021 Department of Agriculture <span class="fa fa-box"></span> by <a href="#">SL e-market</a> </p>
					</div>
				</div>
			</div>
		</footer><!-- footer area end -->
		<!-- scrolltotop start -->
		<div>
			<a href="#" class="scrollToTop text-center" >
				<i class="scroll-fa fa fa-angle-up" aria-hidden="true"></i>
			</a>
		</div><!-- scrolltotop end -->
		<!-- jQuery min JS -->
		<script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
		<!-- jQuery Easing JS -->
		<script src="{{ asset('frontend/js/jquery.easing.1.3.js')}}"></script>
		<!-- Bootstra JS -->
		<script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
		<!-- jQuery Nav JS -->
		<script src="{{ asset('frontend/js/jquery.nav.js')}}"></script>
		<!-- jQuery Sticky JS -->
		<script src="{{ asset('frontend/js/jquery.sticky.js')}}"></script>
		<!-- jQuery Isotop JS -->
		<script src="{{ asset('frontend/js/isotope.pkgd.min.js')}}"></script>
		<!-- jQuery Slick JS -->
		<script src="{{ asset('frontend/slick/slick.min.js')}}"></script>
		<!-- Parallax JS -->
		<script src="{{ asset('frontend/js/parallax.min.js')}}"></script>
		<!-- WOW JS active -->
		<script src="{{ asset('frontend/js/wow-1.3.0.min.js')}}"></script>
		<!-- jQuery active JS -->
		<script src="{{ asset('frontend/js/main.js')}}"></script>
		  <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
	</body>
</html>