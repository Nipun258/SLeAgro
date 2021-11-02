@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
             <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" >
					  <h3 class="widget-user-username text-center text-warning">Price Calculator</h3>

					  <h5 class="widget-user-username text-center text-danger">{{$name}}</h5>
					  <a href="{{ route('price.calculator.view') }}" style="float: right;" class="btn btn-success mb-4">Back</a>
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" src="{{ (!empty($image))? url($image):url('upload/images.png')}}" alt="User Avatar">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-6">
						  <div class="description-block">
							<h5 class="description-header">Total Havest(Kg)</h5>
							<h2><span class="description-text text-success">{{$product_harvest}}</span></h2>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-6 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Total Income(Rs.)</h5>
							<h2><span class="description-text text-success">{{number_format($total_price , 2)}}</span></h2>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  <!-- /.row -->
					</div>
				  </div>

			<div class="col-12">


			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>

@endsection