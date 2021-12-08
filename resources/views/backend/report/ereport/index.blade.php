@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				
				<div class="col-xl-4 col-6">
					<a href="{{ route('ecentre.report.buyer.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Buyer's List Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="{{ route('ecentre.report.user.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-leaf"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">User's List Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#app-date" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Appiontment List Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('ecentre.report.ccentre.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-magnify-plus"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Collection Centre List Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('product.summary.month.ecenre.report') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-folder-multiple-image"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Product Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('product.summary.ecenre.report') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-email-secure"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Current State Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +25%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
               	<div class="col-xl-4 col-6">
					<a href="#payment-register" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-verified"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Registered Buyer Payment Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="#payment-normal" data-toggle="modal" >
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-information-outline"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Normal Buyer Payment Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#payment-transfer" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-publish"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Transfer Payment Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>

			</div>

<div class="modal center-modal fade " id="app-date" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Appointment Date</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ecentre.report.appointment') }}">
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

  <div class="modal center-modal fade " id="payment-register" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.register') }}">
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

   <div class="modal center-modal fade " id="payment-normal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.normal') }}">
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

  <div class="modal center-modal fade " id="payment-transfer" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.transfer') }}">
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