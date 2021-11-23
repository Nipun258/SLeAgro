@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Selling Vegitable product system</h3>
					<h6 class="box-subtitle">Fill out necessary data</h6>
				</div>
				<!-- /.box-header -->
				<div class="box-body wizard-content">

					<form method="POST" action="{{ route('buyer.booking.product.store') }}" class="contact-form">
						@csrf
						<div class="form-section">
							<h4 class="title text-warning ">Personal Information</h4>
							<hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            @foreach($booking as $booking)
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Farmer Name :</label>
										<input type="text" class="form-control" name="name" value="{{$booking->name}}" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="ccentre">Collection Center :</label>
										<input type="text" class="form-control" name="ccentre" value="{{$booking->centre_name}}" readonly>
									</div>
								</div>
							</div>
							<input type="hidden" name="user_id" value="{{$booking->user_id}}">
							<input type="hidden" name="ccentre_id" value="{{$booking->ccentre_id}}">
							<input type="hidden" name="date" value="{{$booking->date}}">
							<input type="hidden" name="booking_id" value="{{$booking->id}}">
                        @endforeach
						</div>
						<br>
						<!-- Step 2 -->
						<div class="form-section">
							<h4 class="title text-warning">Vegitable Detials</h4>
							<h6 class="box-subtitle">you can change product quanlity</h6>
							<hr style="height:2px;border-width:0;color:gray;background-color:gray">

							<div class="add_vegitable_product">
								@if($orders->count()>0)
								 @foreach($orders as $key => $order)
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											@if($key == 0)
											<label for="veg_id" class="text-light text-center">Vegitable Name</label>
											@endif
										  <input type="hidden" class="form-control" name="veg_id[]" id="veg_id" value="{{$order->id}}">
									       <input type="text" class="form-control " name="veg_name[]" id="veg_name" value="{{$order->name}}" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											@if($key == 0)
											<label for="quntity" class="text-light text-center">Product Quntity(Kg)</label>
											@endif
											<input type="text" class="form-control " name="quntity[]" id="quntity" value="{{$order->quntity}}" >
										</div>
									</div>
								</div>
								@endforeach
								@else
								<h4 class="title text-danger">There is No Vegitable Product to Transfer</h4>
								@endif
							</div>
						</div>
						<br>						
							<input type="submit" class="btn btn-success float-left" value="submit">
						</div>
					</form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>

	</div>
</div>
@endsection
