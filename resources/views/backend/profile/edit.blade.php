@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Manage Profle</h4>
					@php
                  $buyer = DB::table('buyers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
                   $farmer = DB::table('farmers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
                   @endphp
                   @if(Auth::user()->role =='Farmer-Buyer' || Auth::user()->role =='Farmer') 
                   @if(!isset($farmer))
					<a href="{{ route('farmer.setup') }}" style="float: right; margin:5px;" class="btn btn-success mb-2">Farmer Setup</a>
				   @elseif(isset($farmer))
				   <a href="{{ route('farmer.edit') }}" style="float: right; margin:5px;" class="btn btn-danger mb-2">Farmer Update</a>
				   @endif
				  @endif
				  @if(Auth::user()->role =='Farmer-Buyer' || Auth::user()->role =='Buyer') 
                   @if(!isset($buyer))
					<a href="{{ route('buyer.setup') }}" style="float: right; margin:5px;" class="btn btn-success mb-2">Buyer Setup</a>
				   @elseif(isset($buyer))
				   <a href="{{ route('buyer.edit') }}" style="float: right; margin:5px;" class="btn btn-danger mb-2">Buyer Update</a>
				   @endif
				  @endif
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">

								@csrf
								<div class="row">
									<div class="col-12">
										
    <div class="row">
	<div class="col-md-6" >

		<div class="form-group">
		<h5>User Name <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text" name="name" class="form-control" value="{{ $editData->name }}" disabled="">  </div>
	<span class="text-danger">@error('name'){{$message}}@enderror</span>
	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >
		
 <div class="form-group">
		<h5>User Email <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="email" name="email" class="form-control" value="{{ $editData->email }}" disabled="">  </div>
	<span class="text-danger">@error('email'){{$message}}@enderror</span> 
	</div>

	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->


 <div class="row">
	<div class="col-md-6" >

		<div class="form-group">
		<h5>User Mobile <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text" name="mobile" class="form-control" value="{{ $editData->mobile }}" >  </div>
	<span class="text-danger">@error('mobile'){{$message}}@enderror</span> 
	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >
		
 <div class="form-group">
		<h5>User Address <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text" name="address" class="form-control" value="{{ $editData->address }}" >  </div>
	<span class="text-danger">@error('address'){{$message}}@enderror</span>  
	</div>

	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->







<div class="row">
	<div class="col-md-6" >

		<div class="form-group">
	<h5>User Gender <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select name="gender" id="gender" class="form-control">
			<option value="" selected="" disabled="">Select Gender</option>
 <option value="Male" {{ ($editData->gender == "Male" ? "selected": "") }}  >Male</option>
 <option value="Female" {{ ($editData->gender == "Female" ? "selected": "") }} >Female</option>
			 
		</select>
		<span class="text-danger">@error('gender'){{$message}}@enderror</span>
	 </div>
          </div>
	</div> <!-- End Col Md-6 -->

  @if(Auth::user()->role =='EC-Officer')
  <div class="col-md-6" >

		<div class="form-group">
	<h5>Economic Centre <span class="text-danger">*</span></h5>
	<div class="controls">
	 <select name="ecenter" id="ecenter" class="form-control">
			<option value="" selected="" disabled="">Select Ecomnomic Centre</option>
			@foreach($ecenter as $ecenter)
                @if($ecenter->id == $editData->ecentre_id)
				<option value="{{ $ecenter->id }}" selected="">{{$ecenter->centre_name }} </option>
				@else
                <option value="{{ $ecenter->id }}" >{{$ecenter->centre_name }} </option>
				@endif
		    @endforeach
			 
		</select>
		<span class="text-danger">@error('ecenter'){{$message}}@enderror</span>
	 </div>
          </div>
	</div> <!-- End Col Md-6 -->
  @endif
	<div class="col-md-6" >		
	<div class="form-group">
		<h5>Profile Image </h5>
		<div class="controls">
	 <input type="file" name="image" class="form-control" id="image" >  </div>
	 </div>

	 	<div class="form-group">
		<div class="controls">
	<img id="showImage" src="{{ (!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/images.png')}}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 

	 </div>
	 </div>


	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->
												
												
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-info mb-5" value="update">
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
				<script type="text/javascript">
	              $(document).ready(function(){
		           $('#image').change(function(e){
			        var reader = new FileReader();
			            reader.onload = function(e){
				       $('#showImage').attr('src',e.target.result);
			          }
		      	reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection