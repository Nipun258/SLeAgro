@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				
				<div class="col-xl-4 col-6">
					<a href="{{ route('ccentre.report.farmer.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Farmer's List Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="{{ route('ccentre.report.user.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-leaf"></i>
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
					<a href="#" data-target="#app-date" data-toggle="modal">
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
					<a href="{{ route('product.month.summary.report') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-magnify-plus"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Product Transfer Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('ccentre.report.product.transfer') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-folder-multiple-image"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Product Transfer Sum Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('product.summary.report') }}" target="_blank">
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
					<a href="#" data-target="#payment-register" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-verified"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Registered Farmer Payment Report</p>
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
								<p class="text-white mt-20 mb-0 font-size-16">Normal Farmer Payment Report</p>
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
							<div class="col-xl-4 col-6">
					<a href="#inventory-list-day" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-soundcloud"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Inventory Transction Report(Day)</p>
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
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-soundcloud"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Inventory Transction Report(Month)</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
			<div class="col-xl-4 col-6">
					<a href="#" data-target="#payment-summary-register" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-cake-layered"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Registered Farmer Buying Payment Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#" data-target="#payment-summary-normal" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-forklift"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Normal Farmer Buying Payment Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#" data-target="#payment-summary-transfer" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-monitor-multiple"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Transfer Payment Reviced Summary Report</p>
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
				<form method="post" action="{{ route('ccentre.report.appointment') }}" target="_blank">
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
					
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="app-date-button">
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
				<form method="post" action="{{ route('ccentre.report.payment.register') }}" target="_blank">
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
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-register-button">
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
				<form method="post" action="{{ route('ccentre.report.payment.normal') }}" target="_blank">
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
					
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-normal-button">
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
				<form method="post" action="{{ route('ccentre.report.payment.transfer') }}" target="_blank">
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
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-transfer-button">
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
				<form method="post" action="{{ route('ccentre.report.inventory.daily') }}" target="_blank">
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
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="inventory-list-day-button">
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
				<form method="post" action="{{ route('ccentre.report.inventory.month') }}" target="_blank">
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
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="inventory-list-month-button">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal center-modal fade" id="payment-summary-register" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.summary.register') }}" target="_blank">
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
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-summary-register-button">
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="modal center-modal fade" id="payment-summary-normal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.summary.normal') }}" target="_blank">
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
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-summary-normal-button">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal center-modal fade" id="payment-summary-transfer" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Select Month</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('ccentre.report.payment.summary.transfer') }}" target="_blank">
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
						
							<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" id="payment-summary-transfer-button">
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

    $('#payment-register').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

    $('#payment-normal').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

    $('#payment-transfer').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#inventory-list-day').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#inventory-list-month').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#payment-summary-register').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#payment-summary-normal').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#payment-summary-transfer').on('hidden.bs.modal', function () {
                 
            $(this).find('form').trigger('reset');
     });

     $('#app-date-button').click(function() {
               
           $('#app-date').modal('hide');
      });

     $('#payment-register-button').click(function() {
               
           $('#payment-register').modal('hide');
      });

     $('#payment-normal-button').click(function() {
               
           $('#payment-normal').modal('hide');
      });

      $('#payment-transfer-button').click(function() {
               
           $('#payment-transfer').modal('hide');
      });

      $('#inventory-list-day-button').click(function() {
               
           $('#inventory-list-day').modal('hide');
      });

      $('#inventory-list-month-button').click(function() {
               
           $('#inventory-list-month').modal('hide');
      });

      $('#payment-summary-register-button').click(function() {
               
           $('#payment-summary-register').modal('hide');
      });

      $('#payment-summary-normal-button').click(function() {
               
           $('#payment-summary-normal').modal('hide');
      });

       $('#payment-summary-transfer-button').click(function() {
               
           $('#payment-summary-transfer').modal('hide');
      });

  });

  </script>
@endsection