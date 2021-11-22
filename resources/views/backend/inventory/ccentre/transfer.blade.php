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
					<h3 class="box-title">Vegitable Transfer information</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body wizard-content">

					<form method="POST" action="{{ route('product.transfer.ecenter.store') }}" class="contact-form">
						@csrf
						<!-- Step 2 -->
						<div class="form-section">
							<h4 class="title text-warning">Vegitable Detials</h4>
							<hr style="height:2px;border-width:0;color:gray;background-color:gray">


							<div class="add_vegitable_product">
								@if($orders->count()>0)
								 @foreach($orders as $key => $order)
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											@if($key == 0)
											<label for="veg_id" class="text-light">Vegitable Name</label>
											@endif
										  <input type="hidden" class="form-control" name="veg_id[]" id="veg_id" value="{{$order->id}}">
									       <input type="text" class="form-control" name="veg_name[]" id="veg_name" value="{{$order->name}}" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											@if($key == 0)
											<label for="quntity" class="text-light">Net Quntity(Kg)</label>
											@endif
											<input type="text" class="form-control" name="quntity[]" id="quntity" value="{{$order->count}}" readonly>
										</div>
									</div>
								   <div class="col-md-3">
										<div class="form-group">
											@if($key == 0)
											<label for="price" class="text-light">Paid Price(Rs.)</label>
											@endif
											<input type="text" class="form-control" name="price[]" id="price" value="{{$order->total}}" readonly>
										</div>
									</div>
								</div>
								@endforeach
								@else
								<h4 class="title text-danger">There is No Vegitable Product to Transfer</h4>
								@endif
							</div>
						</div>
						<br>@if($orders->count()>0)						
							<input type="submit" class="btn btn-success float-left" value="submit">
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
