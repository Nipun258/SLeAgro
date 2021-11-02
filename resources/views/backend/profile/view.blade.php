@extends('admin.admin_master')
@section('admin')

  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
             <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" >
					  <h3 class="widget-user-username text-success">User Name : {{ $user->name}}</h3>
					  <a href="{{ route('profile.edit') }}" style="float: right;" class="btn btn-success mb-4">Edit Profile</a>
					  <h6 class="widget-user-desc">Accout Type : {{ $user->usertype}}</h6>
					  <h6 class="widget-user-desc text-warning">User Role : {{ $user->role}}</h6>
					  <h6 class="widget-user-desc">User Email : {{ $user->email}}</h6>
                    
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" src="{{ (!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/images.png')}}" alt="User Avatar">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Mobile No</h5>
							<span class="description-text">{{$user->mobile}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Address</h5>
							<span class="description-text">{{$user->address}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Gender</h5>
							<span class="description-text">{{$user->gender}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @if(Auth::user()->role =='RC-Officer')
					  <div class="row">
					  	<div class="col-sm-12">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
					  </div>
					  @endif
					  @if(Auth::user()->role =='EC-Officer')
					  <div class="row">
					  	<div class="col-sm-12">
						  <div class="description-block">
							<h5 class="description-header">Economic Center</h5>
							<span class="description-text">{{$ecenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
					  </div>
					  @endif
					  @if(Auth::user()->role =='FD-Officer')
					  <div class="row">
					  	<div class="col-sm-12">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
					  </div>
					  @endif
					  <!-- /.row -->
					</div>
				  </div>

			<div class="col-12">


			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>
@endsection