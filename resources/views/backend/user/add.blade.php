@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Add User</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('user.store') }}">
								@csrf
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<h5>User Role <span class="text-danger">*</span></h5>
													<div class="controls">
														<select name="role" id="role"  class="form-control">
															<option value="" disabled="" selected="">Select Role</option>
															<!-- <option {{ old('role') == "Admin" ? "selected" : "" }} value="Admin" disabled="">Admin Account</option> -->
															@if(Auth::user()->role =='Admin')
															
															<option {{ old('role') == "EC-Officer" ? "selected" : "" }} value="EC-Officer">Economic Center Officer Account</option>
															<!-- <option {{ old('role') == "FD-Officer" ? "selected" : "" }} value="FD-Officer">Field Officer Account</option> -->
															@elseif(Auth::user()->role =='RC-Officer')
															<!-- <option {{ old('role') == "RC-Officer" ? "selected" : "" }} value="RC-Officer">Regional Center Officer Account</option> -->
															<option {{ old('role') == "FD-Officer" ? "selected" : "" }} value="FD-Officer">Field Officer Account</option>
															@elseif(Auth::user()->role =='EC-Officer')
															<option {{ old('role') == "RC-Officer" ? "selected" : "" }} value="RC-Officer">Regional Center Officer Account</option>
															@endif
														</select>
														<span class="text-danger">@error('role'){{$message}}@enderror</span>
													</div>
												</div>
												<div class="form-group">
													<h5>User Email <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="email" name="email" class="form-control" value="{{old('email')}}"> <span class="text-danger">@error('email'){{$message}}@enderror</span> 
													</div>
												</div>	
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h5>Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="name" class="form-control" value="{{old('name')}}">
														<span class="text-danger">@error('name'){{$message}}@enderror</span>  
													</div>
												</div>
												@if(Auth::user()->role =='EC-Officer')	
													<div class="form-group">
														<h5>Collection Centre <span class="text-danger">*</span></h5>
														<div class="controls">
														<select name="ccenter" id="ccenter" class="form-control">
			                                   <option value="" selected="" disabled="">Select Collection Centre</option>
			                                   @foreach($ccenter as $ccenter)
                                          @if(Auth::user()->ecentre_id == $ccenter->economic_centre_id)
				                              <option value="{{ $ccenter->id }}" >{{$ccenter->centre_name }} </option>
				                           @endif
		                                        @endforeach
			 
		                                      </select>	
															 </div>
														</div>
												@endif 
												</div>
												
												
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-info mb-5" value="submit">
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
				@endsection