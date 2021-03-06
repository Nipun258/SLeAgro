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
					<h3 class="box-title">Vegitable Booking information</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body wizard-content">

					<form method="POST" action="{{ route('booking.buyer.app') }}" class="contact-form">
						@csrf
						<!-- Step 2 -->
						<div class="form-section">
							<h3 class="title text-warning">Vegitable Detials</h3>
							<h6 class="title text-">Please Enter your Vegitable requirment.please selecct only requried amount only</h6>
							<hr style="height:2px;border-width:0;color:gray;background-color:gray">


							<div class="add_vegitable_product">
								@if(count(json_decode($vegitables_summary))>0)
								 @foreach(json_decode($vegitables_summary) as $order)
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											@if(count(json_decode($vegitables_summary)) == 1)
											<label for="veg_id" class="text-light text-center">Vegitable Name</label>
											@endif
										  <input type="hidden" class="form-control" name="veg_id[]" id="veg_id" value="{{$order->id}}">
									       <input type="text" class="form-control bg-dark text-center " name="veg_name[]" id="veg_name" value="{{$order->name}}" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											@if(count(json_decode($vegitables_summary)) == 1)
											<label for="quntity" class="text-light text-center">Availble Quntity(Kg)</label>
											@endif
											<input type="text" class="form-control bg-dark text-center" name="quntity[]" id="quntity" value="{{$order->quntity}}" readonly>
										</div>
									</div>
								   <div class="col-md-3">
										<div class="form-group">
											@if(count(json_decode($vegitables_summary)) == 1)
											<label for="cus_order" class="text-light text-center">Requried Vegitable Qunntity(Kg)</label>
											@endif
											<input type="number" class="form-control border border-white text-center" name="cus_order[]" id="cus_order" >
											<span class="text-danger">@error('cus_order'){{$message}}@enderror</span>
										</div>
									</div>
								</div>
							   <input type="hidden" name="appointmentId" value="{{$app_id}}">
			                   <input type="hidden" name="date" value="{{$date}}">
								@endforeach
								@else
								<h4 class="title text-danger">There is No Vegitable Product to Booking</h4>
								@endif
							</div>
						</div>
						<br>@if(count(json_decode($vegitables_summary))>0)						
							<input type="submit" class="btn btn-success float-left" value="Booking Request" style="width:100%;">
							@endif
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
