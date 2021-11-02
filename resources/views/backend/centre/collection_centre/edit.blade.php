@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Edit Collection Centre Data</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('collection.centre.update',$editData->id) }}" >

								@csrf
								<div class="row">
									<div class="col-12">
										
    <div class="row">
	<div class="col-md-6" >

		<div class="form-group">
		<h5>Centre Name <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text" name="centre_name" class="form-control" value="{{$editData->centre_name}}">  </div>
	<span class="text-danger">@error('centre_name'){{$message}}@enderror</span>
	</div>

	</div> <!-- End Col Md-6 -->

<div class="col-md-6" >

 <div class="form-group">
	<h5>Economic Centre <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select name="ecenter" id="ecenter" class="form-control">
			<option value="" selected="" disabled="">Select Economic Centre</option>
            @foreach($ecenter as $ecenter)
                @if($ecenter->id == $editData->economic_centre_id)
				<option value="{{ $ecenter->id }}" selected="">{{$ecenter->centre_name }} </option>
				@else
                @if(Auth::user()->role =='Admin')
				<option value="{{ $ecenter->id }}">{{$ecenter->centre_name }} </option>
			  @elseif(Auth::user()->role =='EC-Officer' && $ecenter1 == $ecenter->centre_name)
                 <option value="{{ $ecenter->id }}">{{$ecenter->centre_name }} </option>
			  @endif
				@endif
		      @endforeach	 
		</select>
		<span class="text-danger">@error('ecenter'){{$message}}@enderror</span>
	 </div>
          </div>
	</div> <!-- End Col Md-6 -->
	

</div> <!-- End Row -->


 <div class="row">
	<div class="col-md-4" >

		<div class="form-group">
	<h5>Province <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select  id="province-dd" name="province" class="form-control">
			<option value="" selected="" disabled="">Select Province</option>
              @foreach($province as $province)
                @if($province->id == $editData->province_id)
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
	<h5>District <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select  id="district-dd" name="district" class="form-control ">

		</select>
		<span class="text-danger">@error('district'){{$message}}@enderror</span>
	 </div>
          </div>
	</div> <!-- End Col Md-4 -->
	<div class="col-md-4" >

		<div class="form-group">
	<h5>City <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select id="city-dd" name="city" class="form-control ">
			 
		</select>
		<span class="text-danger">@error('city'){{$message}}@enderror</span>
	 </div>
          </div>
	</div> <!-- End Col Md-4 -->
	

</div> <!-- End Row -->

												
												
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
												</div>
											</form>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</section>
						
					</div>
				</div>
    <script>
        $(document).ready(function () {
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
                        var cur_district = <?php echo $editData->district_id; ?>;
                        $.each(result.districts, function (key, value) {
                        	
                            if (cur_district == value.id) {
                            	$("#district-dd").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
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
        });

    </script>

@endsection