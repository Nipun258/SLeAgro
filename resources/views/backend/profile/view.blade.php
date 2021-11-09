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
					  <hr>
					  @php
             $farmer = DB::table('farmers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
					  @if(Auth::user()->role =='Farmer' && isset($farmer))
					  <div class="row">
						<div class="col-sm-6">
						  <div class="description-block">
							<h5 class="description-header">Economic Center</h5>
							<span class="description-text">{{$ecenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-6 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <hr>
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">City</h5>
							<span class="description-text">{{$city}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">District</h5>
							<span class="description-text">{{$discrict}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Province</h5>
							<span class="description-text">{{$province}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <hr>
					  <h4 class="title text-warning">Bank Detials</h4>
					  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
						<div class="row">
						<div class="col-sm-3">
						  <div class="description-block">
							<h5 class="description-header">Pass Book Name</h5>
							<span class="description-text">{{$pass_name}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Account Number</h5>
							<span class="description-text">{{$acc_num}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Bank</h5>
							<span class="description-text">{{$bank}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3">
						  <div class="description-block">
							<h5 class="description-header">Branch</h5>
							<span class="description-text">{{$branch}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @endif
					  @php
             $buyer = DB::table('buyers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
					  @if(Auth::user()->role =='Buyer' && isset($buyer))
					 <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Economic Center</h5>
							<span class="description-text">{{$ecenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Buyer Type</h5>
							@if($buyer_type == 1)
							<span class="description-text">WholeSale</span>
							@elseif($buyer_type == 2)
							<span class="description-text">Retailers</span>
							@endif
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <hr>
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">City</h5>
							<span class="description-text">{{$buyer_city}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">District</h5>
							<span class="description-text">{{$buyer_discrict}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Province</h5>
							<span class="description-text">{{$buyer_province}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @endif
					  @php
             $buyer = DB::table('buyers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
             $farmer = DB::table('farmers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
            @if(Auth::user()->role =='Farmer-Buyer' && isset($farmer))
					  @if(!isset($buyer))
					  <div class="row">
						<div class="col-sm-6">
						  <div class="description-block">
							<h5 class="description-header">Economic Center</h5>
							<span class="description-text">{{$ecenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-6 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @elseif(isset($buyer))
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Economic Center</h5>
							<span class="description-text">{{$ecenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Collction Center</h5>
							<span class="description-text">{{$ccenter}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Buyer Type</h5>
							@if($buyer_type == 1)
							<span class="description-text">WholeSale</span>
							@elseif($buyer_type == 2)
							<span class="description-text">Retailers</span>
							@endif
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @endif
					  <hr>
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">City</h5>
							<span class="description-text">{{$city}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">District</h5>
							<span class="description-text">{{$discrict}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Province</h5>
							<span class="description-text">{{$province}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <hr>
					  <h4 class="title text-warning">Bank Detials</h4>
					  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
						<div class="row">
						<div class="col-sm-3">
						  <div class="description-block">
							<h5 class="description-header">Pass Book Name</h5>
							<span class="description-text">{{$pass_name}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Account Number</h5>
							<span class="description-text">{{$acc_num}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Bank</h5>
							<span class="description-text">{{$bank}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-3">
						  <div class="description-block">
							<h5 class="description-header">Branch</h5>
							<span class="description-text">{{$branch}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  @endif
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