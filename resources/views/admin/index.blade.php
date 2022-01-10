@extends('admin.admin_master')
@section('admin')
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
			@if(Auth::user()->role =='Farmer')
			<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($farmer_income_month , 2)}} <!-- <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small> --></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-coin"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Annual Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($farmer_income_year , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
							<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-food-apple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Selles Vegetables</p>
								<h3 class="text-warning mb-0 font-weight-500">{{$farmer_vegetable_month}} Kg</h3>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(Auth::user()->role =='Buyer')
			<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($buyer_payment_month , 2)}} <!-- <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small> --></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-coin"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Annual Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($buyer_payment_year , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
							<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-food-apple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Selles Vegetables</p>
								<h3 class="text-warning mb-0 font-weight-500">{{$buyer_vegetable_month}} Kg</h3>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(Auth::user()->role =='RC-Officer')
			<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Payments</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ccentre_payment , 2)}} <!-- <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small> --></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-coin"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Transfer Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ccentre_transfer_payment , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-library"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Profits</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ccentre_profit , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
			 <div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-food-apple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Selles Vegetables</p>
								<h3 class="text-warning mb-0 font-weight-500">{{$ccentre_vegetable_month}} Kg</h3>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(Auth::user()->role =='EC-Officer')
			<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Register Buyer Monthly Incomes</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ecentre_register_income , 2)}} <!-- <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small> --></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-coin"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Retials Distribution Income</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ecentre_transfer_payment , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-library"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Normal Buyer Monthly Incomes</p>
								<h3 class="text-warning mb-0 font-weight-500">Rs. {{ number_format($ecentre_normal_income , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-check-circle"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Total Monthly Incomes</p>
								<h3 class="text-danger mb-0 font-weight-500">Rs. {{ number_format($ecentre_income , 2)}}</h3>
							</div>
						</div>
					</div>
				</div>
			 <div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-food-apple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Monthly Selles Vegetables</p>
								<h3 class="text-warning mb-0 font-weight-500">{{$ecentre_vegetable_month}} Kg</h3>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">New Farmers</p>
								<h2 class="text-success mb-0 font-weight-500"> {{ str_pad($farmercount , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-clipboard-account"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">New Buyers</p>
								<h2 class="text-success mb-0 font-weight-500"> {{ str_pad($buyercount , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-leaf"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">New Vegetables</p>
								<h2 class="text-success mb-0 font-weight-500">{{ str_pad($vegitable , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">New Economic Center</p>
								<h2 class="text-success mb-0 font-weight-500">{{ str_pad($ecentre , 2, "0", STR_PAD_LEFT)}}<!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Staff Members</p>
								<h2 class="text-success mb-0 font-weight-500">{{ str_pad($staffcount , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi mdi-group"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Collection Center</p>
								<h2 class="text-success mb-0 font-weight-500">{{ str_pad($ccentre , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				@if(Auth::user()->role =='Admin')
				<div class="col-xl-4 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-email-secure"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Contact Message</p>
								<h2 class="text-success mb-0 font-weight-500">{{ str_pad($message , 2, "0", STR_PAD_LEFT)}} <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +25%</small> --></h2>
							</div>
						</div>
					</div>
				</div>
				@endif

<!-- {{-- 				<div class="col-xl-6 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">
								Earning Summary
							</h4>
						</div>
						<div class="box-body py-0">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="box no-shadow mb-0">
										<div class="box-body px-0">
											<div class="d-flex justify-content-start align-items-center">
												<div>
													<div id="chart41"></div>
												</div>
												<div>
													<h5>Top Order</h5>
													<h4 class="text-white my-0 font-weight-500">$39k</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="box no-shadow mb-0">
										<div class="box-body px-0">
											<div class="d-flex justify-content-start align-items-center">
												<div>
													<div id="chart42"></div>
												</div>
												<div>
													<h5>Average Order</h5>
													<h4 class="text-white my-0 font-weight-500">$24k</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="charts_widget_43_chart"></div>							
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-12">
					<div class="box bg-info bg-img" style="background-image: url(../images/gallery/bg-1.png)">
						<div class="box-body text-center">							
							<img src="../images/trophy.png" class="mt-50" alt="" />
							<div class="max-w-500 mx-auto">
								<h2 class="text-white mb-20 font-weight-500">Best Employee Johen,</h2>
								<p class="text-white-50 mb-10 font-size-20">You've got 50.5% more sales today. You've reached 8th milestone, checkout author section</p>
							</div>
						</div>
					</div>
					<div class="row">						
						<div class="col-lg-6 col-12">
							<div class="box overflow-hidden">
								<div class="box-body pb-0">	
									<div>
										<h2 class="text-white mb-0 font-weight-500">18.8k</h2>
										<p class="text-white mb-0 font-size-20">Total users</p>
									</div>
								</div>
								<div class="box-body p-0">
									<div id="revenue1"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="box overflow-hidden">
								<div class="box-body pb-0">	
									<div>
										<h2 class="text-white mb-0 font-weight-500">35.8k</h2>
										<p class="text-white mb-0 font-size-20">Average reach per post</p>
									</div>
								</div>
								<div class="box-body p-0">
									<div id="revenue2"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xxxl-5 col-xl-6 col-12">
					<div class="box overflow-hidden">
						<div class="box-body p-0">
							<div class="row no-gutters">
								<div class="col-md-6 col-12">
									<div class="box no-shadow mb-0 rounded-0">
										<div class="box-header no-border">
											<h4 class="box-title mb-0">
												Last Posts
											</h4>
										</div>
										<div class="box-body p-0">
											<div class="media-list media-list-hover">
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>Meet Craftwork. Thoroghly Handpicked UI Freebies</h5>
											  </div>
											</a>
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>Cook Design Right!</h5>
											  </div>
											</a>
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>5 Reasons to Start Own Bussines</h5>
											  </div>
											</a>
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>How to Make Interface</h5>
											  </div>
											</a>
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>Show Me Your Design</h5>
											  </div>
											</a>
											<a class="media media-single hover-white" href="#">
											  <div class="media-body">
												<h5>She gave my mother such a turn, that I have always bee...</h5>
											  </div>
											</a>
										  </div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="box no-shadow mb-0 bg-img rounded-0" data-overlay="5" style="background-image: url(../images/gallery/landscape7.jpg)">
										<div class="box-header no-border">
											<h4 class="box-title mb-0">
												<span class="avatar avatar-lg bg-success">DK</span>
											</h4>
											<ul class="box-controls">
												<li><a href="javascript:void(0)"><i class="ti-reload text-white"></i></a></li>
											</ul>
										</div>
										<div class="box-body">
											<div class="text-right mt-100 pt-20">
												<h3 class="text-white"><small class="mr-10"><i class="fa fa-commenting"></i></small> 3</h3>
												<h2 class="text-white"><small class="mr-10"><i class="fa fa-heart"></i></small> 23</h2>
												<h1 class="text-white"><small class="mr-10"><i class="fa fa-eye"></i></small> 189</h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xxxl-7 col-xl-6 col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Recent Stats</h4>
						</div>
						<div class="box-body">
							<div id="recent_trend"></div>
						</div>
					</div>
				</div> --}} -->
				<div class="col-12">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title align-items-start flex-column">
								Vegitable Price List
								<small class="subtitle text-warning">Last Upadte At @php
                                   date_default_timezone_set('Asia/Kolkata');
                                   $date = date('m/d/Y H:i:s', time());
                                   echo $date;
                                 @endphp</small>
							</h4>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-border">
									<thead>
										<tr class="text-uppercase bg-lightest">
											<th style="min-width: 250px"><span class="text-white">products</span></th>
											<th style="min-width: 100px"><span class="text-fade">Today Price(per/Kg)</span></th>
											<th style="min-width: 100px"><span class="text-fade">Yesterday Price(per/Kg)</span></th>
											<th style="min-width: 150px"><span class="text-fade">Average Price(per/Kg)</span></th>
											{{-- <th style="min-width: 150px"><span class="text-fade">Last Month Price</span></th> --}}
											<th style="min-width: 130px"><span class="text-fade">Price Change</span></th>
											<th style="min-width: 50px"></th>
										</tr>
									</thead>
									<tbody>
										@foreach(json_decode($vegitables_summary) as $summary)
										<tr>										
											<td class="pl-0 py-8">
												<div class="d-flex align-items-center">
													<div class="flex-shrink-0 mr-20">
														<div class="bg-img h-50 w-50" style="background-image: url('{{asset($summary->image)}}')"></div>
													</div>

													<div>
														<a href="{{ route('vegetable.price.analysis',$summary->id) }}" class="text-white font-weight-600 hover-primary mb-1 font-size-16">{{ $summary->name }}</a>
														<span class="text-fade d-block">
														@if($summary->catagory == 'A')
                            Up Country Vegitable
														@elseif($summary->catagory == 'B')
                            Down Country Vegitable
														@elseif($summary->catagory == 'C')
														All Island Vegitable
														@endif
														</span>
													</div>
												</div>
											</td>
											<td>
												<span class="text-white font-weight-600 d-block font-size-16">
													@if($summary->todayPrice == 'No Data')
                                                       Not Update..
													@else
													Rs. {{ number_format($summary->todayPrice , 2) }}
													@endif
												</span>
											</td>
											<td>
												<span class="text-white font-weight-600 d-block font-size-16">
													@if($summary->yesterdayPrice == 'No Data')
                                                       Not Update...
													@else
                            Rs. {{ number_format($summary->yesterdayPrice , 2) }}
													@endif
													
												</span>
											</td>
											<td>
												<span class="text-white font-weight-600 d-block font-size-16">
                            Rs. {{ number_format($summary->avg , 2) }}
												</span>
											</td>

											<td>
												@if($summary->todayPrice != 'No Data' && $summary->yesterdayPrice != 'No Data')
												@if(($summary->todayPrice-$summary->yesterdayPrice) >= 0)
												<h3 class="text-success"><i class="fa fa-caret-up"></i>{{number_format((($summary->todayPrice-$summary->yesterdayPrice)/$summary->todayPrice)*100,2)}}%</h3>
												@else
												<h3 class="text-danger"><i class="fa fa-caret-down"></i>{{number_format((-($summary->todayPrice-$summary->yesterdayPrice)/$summary->todayPrice)*100,2)}}%</h3>
												@endif
												@else
												<h3 class="text-danger">Not Update...</h3>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>  
				</div>
				<div class="col-12">
				<!-- <div class="flourish-embed flourish-bar-chart-race" data-src="visualisation/8200520"><script src="https://public.flourish.studio/resources/embed.js"></script></div> -->
			</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  @endsection
  