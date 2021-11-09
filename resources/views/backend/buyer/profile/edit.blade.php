@extends('admin.admin_master')
@section('admin')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title text-success">Buyer Account Update</h3>
			  <h6 class="box-subtitle text-info">Fill out necessary data</h6>		
			</div>
			<!-- /.box-header -->
			<div class="box-body wizard-content">

				<form method="POST" action="{{ route('buyer.update') }}" class="contact-form">
					@csrf
	                  <div class="form-section">
	                  	<h4 class="title text-warning ">Personal Information</h4>
	                  	<hr style="height:2px;border-width:0;color:gray;background-color:gray">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Name :</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ $editData->name }}" readonly=""> </div>
									<span class="text-danger">@error('name'){{$message}}@enderror</span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email :</label>
									<input type="text" class="form-control" name="email" id="email" value="{{ $editData->email }}" readonly=""> </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="address">Permenant Address :</label>
									<input type="text" class="form-control" name="address" id="address" value="{{ $editData->address }}"> </div>
									<span class="text-danger">@error('address'){{$message}}@enderror</span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mobile">Phone Number :</label>
									<input type="tel" class="form-control" name="mobile" id="mobile" value="{{ $editData->mobile }}"> </div>
									<span class="text-danger">@error('mobile'){{$message}}@enderror</span>
							</div>
						</div>

					    <div class="row">
							 <div class="col-md-6">
								<div class="form-group">
									<label for="gender">Gender :</label>
									<select class="custom-select form-control" name="gender" id="gender">
										<option value="" selected="" disabled="">Select Gender</option>
                                         <option value="Male" {{ ($editData->gender == "Male" ? "selected": "") }}  >Male</option>
                                        <option value="Female" {{ ($editData->gender == "Female" ? "selected": "") }} >Female</option>
									</select>
								</div>
								<span class="text-danger">@error('gender'){{$message}}@enderror</span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nic">NIC Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="nic" id="nic" value="{{ $buyer->nic }}"> </div>
									<span class="text-danger">@error('nic'){{$message}}@enderror</span>
							</div>
						</div>

                        <div class="row">
							 <div class="col-md-12">
								<div class="form-group">
									<label for="type_id">Buyer Type :</label>
									<select class="custom-select form-control" name="type_id" id="gender">
										<option value="" selected="" disabled="">Select Relavent Buyer Type</option>
                                         <option value="1" {{ ($buyer->type_id == "1" ? "selected": "") }}  >Whole Sale Buyer</option>
                                        <option value="2" {{ ($buyer->type_id == "2" ? "selected": "") }} >Retials Buyer</option>
									</select>
								</div>
								<span class="text-danger">@error('type_id'){{$message}}@enderror</span>
							</div>
						</div>
				        <div class="row">
						</div>
					</div>
					<br>
					{{-- </section> --}}
					<!-- Step 2 -->

					<div class="form-section">
						<h4 class="title text-warning">Location Detials</h4>
						<hr style="height:2px;border-width:0;color:gray;background-color:gray">
												<div class="row">
						<div class="col-md-6">
								<div class="form-group">
									<label for="ecentre">Nearest Economic Centre </label><span class="text-danger">*</span>
									<select class="custom-select form-control" name="ecentre" id="ecentre-dd">
										<option value="" selected="" disabled="">Select Economic Centre</option>
										@foreach($ecenter as $ecenter)
                              @if($ecenter->id == $editData->ecentre_id)
				              <option value="{{ $ecenter->id }}" selected="">{{$ecenter->centre_name }} </option>
				               @else
				               <option value="{{ $ecenter->id }}">{{$ecenter->centre_name }} </option>
				               @endif
		                      @endforeach
									</select>
								</div>
								<span class="text-danger">@error('ecentre'){{$message}}@enderror</span>
							</div>
						<div class="col-md-6">
								<div class="form-group">
									<label for="ccentre">Nearest Collection Centre </label><span class="text-danger">*</span>
									<select class="custom-select form-control" name="ccentre" id="ccentre-dd">
										
									</select>
								</div>
								<span class="text-danger">@error('ccentre'){{$message}}@enderror</span>
							</div>
						</div>
<div class="row">
	<div class="col-md-4" >
		<div class="form-group">
			<label>Province <span class="text-danger">*</span></label>
			<div class="controls">
				<select  id="province-dd" name="province" class="form-control">
					<option value="" selected="" disabled="">Select Province</option>
					@foreach($province as $province)
					@if($province->id == $buyer->province_id)
				<option value="{{ $province->id }}" selected="">{{$province->name_en }} </option>
				@else
                <option value="{{ $province->id }}" >{{$province->name_en }} </option>
				@endif
					@endforeach
					
				</select>
				<span class="text-danger">@error('province'){{$message}}@enderror</span>
			</div>
		</div>
		</div> <!-- End Col Md-4 -->
		<div class="col-md-4" >
			<div class="form-group">
				<label>District <span class="text-danger">*</span></label>
				<div class="controls">
					<select  id="district-dd" name="district" class="form-control ">
					</select>
					<span class="text-danger">@error('district'){{$message}}@enderror</span>
				</div>
			</div>
			</div> <!-- End Col Md-4 -->
			<div class="col-md-4" >
				<div class="form-group">
					<label>City <span class="text-danger">*</span></label>
					<div class="controls">
						<select id="city-dd" name="city" class="form-control ">
							
						</select>
						<span class="text-danger">@error('city'){{$message}}@enderror</span>
					</div>
				</div>
				</div> <!-- End Col Md-4 -->
				
				</div> <!-- End Row -->

						

					   </div>
					   <br>
					{{-- </section> --}}
					<!-- Step 3 -->

					<!-- Step 4 -->
					<div class="form-section">

					<div class="form-group">
						<div class="c-inputs-stacked">
							<input type="checkbox" id="checkbox_1">
							<label for="checkbox_1" class="d-block">I hereby certify that the above information are true and correct to the best of my knowledge</label>

						</div>
					</div>
					</div>
					<br>	
					{{-- </section> --}}
				
				<div class="form-navigation">
					<input type="submit" class="btn btn-success float-left" value="Submit">
				</div>
			</form>
			</div>
			<!-- /.box-body -->
		  </div>
						<!-- /.box -->
		</section>
					
				</div>
			</div>

<script type="text/javascript">

   $(document).ready(function(){
      
	$('#province-dd option').each(function() {
              if (this.selected){
               var idProvince = this.value;
               $("#district-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-districts')}}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district-dd').html('<option value="" selected="" disabled="">Select District</option>');
                        var cur_district = <?php echo $buyer->district_id; ?>;
                        $.each(result.districts, function (key, value) {
                        	
                            if (cur_district == value.id) {
                            	$("#district-dd").append('<option selected="" value="' + value
                                .id + '">' + value.name_en + ' </option>');
                            }else{
                            $("#district-dd").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
                            }
                        });
                        $('#city-dd').html('<option value="" selected="" disabled="">Select City</option>');
                    }
                });
              }
           });

      /*************************************************************/

     $('#province-dd').on('change', function () {
                var idProvince = this.value;
                $("#district-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-districts')}}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district-dd').html('<option value="" selected="" disabled="">Select District</option>');
                        $.each(result.districts, function (key, value) {
                            $("#district-dd").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
                        });
                        $('#city-dd').html('<option value="" selected="" disabled="">Select City</option>');
                    }
                });
        });

     /******************************************************************************/
        $('#district-dd').on('change', function () {
                var idDistrict = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        district_id: idDistrict,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="" selected="" disabled="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
                        });
                    }
                });
            });
      /********************************************************************************/
	  $('#ecentre-dd option').each(function() {
              if (this.selected){
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
                        $('#ccentre-dd').html('<option value="" selected="" disabled="">Select Collection Center</option>');
                        var cur_ccenter = <?php echo $editData->ccentre_id; ?>;
                        $.each(result.collection_centres, function (key, value) {
                        	
                            if (cur_ccenter == value.id) {
                            	$("#ccentre-dd").append('<option selected="" value="' + value
                                .id + '">' + value.centre_name + ' </option>');
                            }else{
                            $("#ccentre-dd").append('<option value="' + value
                                .id + '">' + value.centre_name + '</option>');
                            }
                        });
                    }
                });
              }
           });

		   /****************************************************************************/
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
     /**************************************************************************/

});
</script>

@endsection
