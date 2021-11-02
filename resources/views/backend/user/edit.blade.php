@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Update User</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('user.update',$editData->id) }}">
								@csrf
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<h5>User Role <span class="text-danger">*</span></h5>
													<div class="controls">
														<select name="role" id="role" required class="form-control">
															<option value="" disabled="">Select Role</option>
															<!-- <option value="Admin" {{($editData->role == "Admin" ? "selected" : "")}} >Admin</option> -->
															<option value="RC-Officer" {{($editData->role == "RC-Officer" ? "selected" : "")}}>Regional Center Officer</option>
															<option value="EC-Officer" {{($editData->role == "EC-Officer" ? "selected" : "")}}>Economic Center Officer</option>
															<option value="FD-Officer" {{($editData->role == "FD-Officer" ? "selected" : "")}}>Field Officer</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<h5>User Email <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="email" name="email" class="form-control" value={{$editData->email}} > 
														<span class="text-danger">@error('email'){{$message}}@enderror</span> 
													</div>
												</div>	
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<h5>Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="name" class="form-control" value={{$editData->name}} > 
														<span class="text-danger">@error('name'){{$message}}@enderror</span> 
													</div>
												</div>	
													{{-- <div class="form-group">
														<h5>User Password <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="password" name="password" class="form-control" required > </div>
														</div> --}}
												</div>
												
												
												
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
				@endsection