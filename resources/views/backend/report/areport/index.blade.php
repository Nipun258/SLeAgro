@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">

				<div class="col-xl-4 col-6">
					<a href="{{ route('admin.report.user.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
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
					<a href="{{ route('admin.report.centre.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-magnify-plus"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Centre's List Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="{{ route('admin.report.vegitable.list') }}" target="_blank">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-folder-multiple-image"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Vegitable Product Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#price-check" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-checkbox-multiple-marked-outline"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Vegitable Price Ckeck Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +25%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-xl-4 col-6">
					<a href="#ecentre-summary-daily" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-amplifier"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Economic Centre Daily Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="#ccentre-summary-daily" data-toggle="modal" >
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-information-outline"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Collection Centre Daily Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>

               	<div class="col-xl-4 col-6">
					<a href="#ecentre-summary-monthly" data-toggle="modal">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-verified"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Economic Centre Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"><!-- <small class="text-success"><i class="fa fa-caret-up"></i> +100%</small> --></h2>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-xl-4 col-6">
					<a href="#ccentre-summary-monthly" data-toggle="modal" >
					<div class="box overflow-hidden pull-up">
						<div class="box-body">							
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-information-outline"></i>
							</div>
							<div>
								<p class="text-white mt-20 mb-0 font-size-16">Collection Centre Summary Report</p>
								<h2 class="text-success mb-0 font-weight-500"> <!-- <small class="text-success"><i class="fa fa-caret-up"></i> +50%</small> --></h2>
							</div>
						</div>
					</div>
				</a>
				</div>


			</div>

<div class="modal center-modal fade " id="price-check" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Vegetable Price List</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.report.vegitable.price') }}" >
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

<div class="modal center-modal fade " id="ecentre-summary-daily" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Economic Centre Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.report.ecentre.summary.day') }}">
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
					<div class="col-md-12">
						<div class="form-group">
							<h5>Collection Centre Name<span class="text-danger">*</span></h5>
							<select name="ecentre" id="ecentre" class="form-control">
								<option value="" selected="" disabled="">Select Collection Centre</option>
								@foreach($economic_centres as $ecentre)
								<option value="{{ $ecentre->id }}">{{$ecentre->centre_name }} </option>
								@endforeach
							</select>
							<span class="text-danger">@error('ecentre'){{$message}}@enderror</span>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
			</form>
		</div>
	</div>
</div>
</div>

<div class="modal center-modal fade " id="ccentre-summary-daily" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Collection Centre Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.report.ccentre.summary.day') }}">
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
					<div class="col-md-12">
						<div class="form-group">
							<h5>Collection Centre Name<span class="text-danger">*</span></h5>
							<select name="ecentre" id="ecentre-dd" class="form-control">
								<option value="" selected="" disabled="">Select Collection Centre</option>
								@foreach($economic_centres as $ecentre)
								<option value="{{ $ecentre->id }}">{{$ecentre->centre_name }} </option>
								@endforeach
							</select>
							<span class="text-danger">@error('ecentre'){{$message}}@enderror</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="ccentre">Nearest Collection Centre </label><span class="text-danger">*</span>
							<select class="custom-select form-control" name="ccentre" id="ccentre-dd">
							</select>
						</div>
						<span class="text-danger">@error('ccentre'){{$message}}@enderror</span>
					</div>
				</div>
				<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
			</form>
		</div>
	</div>
</div>
</div>

<div class="modal center-modal fade " id="ecentre-summary-monthly" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Economic Centre Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.report.ecentre.summary.month') }}">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h5>Choose Date <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="month" name="month" class="form-control"> <span class="text-danger">
								@error('month'){{$message}}@enderror</span>
								<br>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<h5>Collection Centre Name<span class="text-danger">*</span></h5>
							<select name="ecentre" id="ecentre" class="form-control">
								<option value="" selected="" disabled="">Select Collection Centre</option>
								@foreach($economic_centres as $ecentre)
								<option value="{{ $ecentre->id }}">{{$ecentre->centre_name }} </option>
								@endforeach
							</select>
							<span class="text-danger">@error('ecentre'){{$message}}@enderror</span>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit">
			</form>
		</div>
	</div>
</div>
</div>

<div class="modal center-modal fade " id="ccentre-summary-monthly" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title">Collection Centre Summary</h5>
				<a type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.report.ccentre.summary.month') }}">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h5>Choose Month <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="month" name="month" class="form-control"> <span class="text-danger">
								@error('date'){{$message}}@enderror</span>
								<br>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<h5>Collection Centre Name<span class="text-danger">*</span></h5>
							<select name="ecentre" id="ecentre-dd1" class="form-control">
								<option value="" selected="" disabled="">Select Collection Centre</option>
								@foreach($economic_centres as $ecentre)
								<option value="{{ $ecentre->id }}">{{$ecentre->centre_name }} </option>
								@endforeach
							</select>
							<span class="text-danger">@error('ecentre'){{$message}}@enderror</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="ccentre">Nearest Collection Centre </label><span class="text-danger">*</span>
							<select class="custom-select form-control" name="ccentre" id="ccentre-dd1">
							</select>
						</div>
						<span class="text-danger">@error('ccentre'){{$message}}@enderror</span>
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

    $('#ecentre-dd').on('change', function () {
                var idCollectionCentre = this.value;
                $("#ccentre-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-collection_centres')}}",
                    type: "POST",
                    data: {
                        economic_centre_id: idCollectionCentre,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#ccentre-dd').html('<option value="" selected="" disabled="">Select Collection Centre</option>');
                        $.each(result.collection_centres, function (key, value) {
                            $("#ccentre-dd").append('<option value="' + value
                                .id + '">' + value.centre_name + '</option>');
                        });
                    }
                });
        });

        $('#ecentre-dd1').on('change', function () {
                var idCollectionCentre = this.value;
                $("#ccentre-dd1").html('');
                $.ajax({
                    url: "{{url('api/fetch-collection_centres')}}",
                    type: "POST",
                    data: {
                        economic_centre_id: idCollectionCentre,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#ccentre-dd1').html('<option value="" selected="" disabled="">Select Collection Centre</option>');
                        $.each(result.collection_centres, function (key, value) {
                            $("#ccentre-dd1").append('<option value="' + value
                                .id + '">' + value.centre_name + '</option>');
                        });
                    }
                });
        });

  });

  </script>
@endsection