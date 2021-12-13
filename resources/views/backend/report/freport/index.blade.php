@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				
				<div class="col-xl-4 col-6">
					<a href="#" data-target="#app-date" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Booking List Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				
               	<div class="col-xl-4 col-6">
					<a href="#" data-target="#payment-register" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-verified"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Payment Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="#inventory-list-day" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-soundcloud"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Farmer Selling Product Report(Day)</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
			  <div class="col-xl-4 col-6">
					<a href="#inventory-list-month" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-soundcloud"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Farmer Selling Product Report(Month)</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>

			<div class="col-xl-4 col-6">
					<a href="#" data-target="#payment-summary" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-cake-layered"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Payment Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>

			</div>

<div class="modal center-modal fade" id="app-date" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Appointment Date</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('farmer.report.appointment') }}">
					@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h5>Choose Month <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="month" name="month" class="form-control"> <span class="text-danger">
										@error('month'){{$message}}@enderror</span>
										<br>
									</div>
								</div>
							</div>
						</div>
					
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" >
						</form>
					</div>
				</div>
			</div>
		</div>

  <div class="modal center-modal fade" id="payment-register" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('farmer.report.payment.register') }}">
					        @csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h5>Choose Relavent Month <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="month" name="month" class="form-control"> <span class="text-danger">
										@error('month'){{$message}}@enderror</span>
										<br>
									</div>
								</div>
							</div>
						</div>
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>

   

				<div class="modal center-modal fade " id="inventory-list-day" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Inventory Transction Dialy Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('farmer.report.inventory.daily') }}">
					@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h5>Choose Date <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="date" name="date" class="form-control"> <span class="text-danger">
										@error('date'){{$message}}@enderror</span>
										<br>
									</div>
								</div>
							</div>
						</div>
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" >
						</form>
					</div>
				</div>
			</div>
		</div>

 <div class="modal center-modal fade " id="inventory-list-month" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Inventory Transction Monthly Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('farmer.report.inventory.month') }}">
					        @csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h5>Choose Relavent Month <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="month" name="month" class="form-control"> <span class="text-danger">
										@error('month'){{$message}}@enderror</span>
										<br>
									</div>
								</div>
							</div>
						</div>
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>

		  <div class="modal center-modal fade" id="payment-summary" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('farmer.report.payment.summary') }}">
					        @csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h5>Choose Relavent Month <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="month" name="month" class="form-control"> <span class="text-danger">
										@error('month'){{$message}}@enderror</span>
										<br>
									</div>
								</div>
							</div>
						</div>
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <script type="text/javascript">

  	$(document).ready(function () {
    
    $('#app-date').on('hidden.bs.modal', function () {
       
       $(this).find('form').trigger('reset');

     });

  });

  </script>
@endsection