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
			  <h3 class="box-title text-success">Farmer Account Setup</h3>
			  <h6 class="box-subtitle text-info">Fill out necessary data</h6>		
			</div>
			<!-- /.box-header -->
			<div class="box-body wizard-content">

				<form method="POST" action="{{ route('farmer.store') }}" class="contact-form" enctype="multipart/form-data">
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
									<input type="text" class="form-control" name="nic" id="nic" value="{{ old('nic') }}"> </div>
									<span class="text-danger">@error('nic'){{$message}}@enderror</span>
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
										<option value="" selected="" >Select Economic Centre</option>
										@foreach($ecenter as $ecenter)
				               <option value="{{ $ecenter->id }}">{{$ecenter->centre_name }} </option>
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
                <option value="{{ $province->id }}" >{{$province->name_en }} </option>
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
					<div class="form-section">
						<h4 class="title text-warning">Bank Detials</h4>
						<hr style="height:2px;border-width:0;color:gray;background-color:gray">
                    	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="pass_name">Name in Passbook <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="pass_name" id="pass_name" value="{{ old('pass_name') }}"> </div>
									<span class="text-danger">@error('pass_name'){{$message}}@enderror</span>
								</div>
								
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="account_number">Account Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="account_number" id="account_number" value="{{ old('account_number') }}"> </div>
									<span class="text-danger">@error('account_number'){{$message}}@enderror</span>
								</div>
								
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="bank">Bank Name <span class="text-danger">*</span></label>
									<select class="custom-select form-control" name="bank" id="bank-dd">
									<option value="" selected="" disabled="">Select Bank Name</option>
					@foreach($bank as $bank)
                <option value="{{ $bank->strBankCode }}">{{ucfirst($bank->strBankName) }} </option>
				
					@endforeach
									</select>
								</div>
								<span class="text-danger">@error('bank'){{$message}}@enderror</span>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="branch">Bank Branch <span class="text-danger">*</span></label>
									<select class="custom-select form-control" name="branch" id="branch-dd">
										
									</select>
								</div>
								<span class="text-danger">@error('branch'){{$message}}@enderror</span>
							</div>
						</div>
						<div class="row">
								<div class="col-md-6" >		
	<div class="form-group">
		<label>Passbook Front Page Image</label> 
		<div class="controls">
	 <input type="file" name="image" class="form-control" id="image" >  </div>
	 </div>

     {{-- <div class="form-group">
		<div class="controls">
	<img id="showImage" src="{{ (!empty($farmer->image))? url('upload/bank_pass_book'.$farmer->image):url('upload/images.png')}}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 

	 </div>
	 </div>  --}}


	</div><!-- End Col Md-6 -->
						</div>
<!-- 						<div class="add_school_sport">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="schoolSport">Sport/Sports Participate in & out of School:</label>
									<select class="custom-select form-control" name="schoolSport[]" id="schoolSport">
										<option value="" selected="" disabled="">Select Sport</option>

									</select>
								</div>
							</div>
							<div class="col-md-2" style="padding-top: 25px;">
							  <span class="btn btn-success btn-md addeventmore"><i class="fa fa-plus-circle"></i> </span>
							</div>

						</div>
						<span class="text-danger">@error('schoolSport'){{$message}}@enderror</span>
                     </div>

<div style="display: none;">
	<div class="whole_extra_item_add" id="whole_extra_item_add">
		<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
			<div class="form-row">
				<div class="col-md-4" style="padding-right: 17px;">
					<div class="form-group">
						<select class="custom-select form-control" name="schoolSport[]" id="schoolSport">
							<option value="" selected="" disabled="">Select Sport</option>
						</select>
					</div>
				</div>
				<div class="col-md-2" style="padding-left: 11px;">
					<span class="btn btn-success btn-md addeventmore"><i class="fa fa-plus-circle"></i> </span>
					<span class="btn btn-danger btn-md removeeventmore"><i class="fa fa-minus-circle"></i> </span>
				</div>
			</div>
		</div>
	</div>
</div> -->
				    </div>

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


	/**************************************************************************************************/
     $('#bank-dd').on('change', function () {
                var bankCode = this.value;
                $("#branch-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-bank_branches')}}",
                    type: "POST",
                    data: {
                        bank_code : bankCode,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#branch-dd').html('<option value="" selected="" disabled="">Select Branch</option>');
                        $.each(result.bank_branches, function (key, value) {
                            $("#branch-dd").append('<option value="' + value
                                .strBranchCode + '">' + value.strBranchLocation + '</option>');
                        });
                    }
                });
        });
     /***********************************************************************************/
});
</script>

@endsection
