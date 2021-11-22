@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			 <div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title ">Collection Centre Appointment List <span class="text-danger">({{$myappointment->count()}})</span></h4>
				  <a href="{{ route('buyer.app.setup') }}" style="float: right;" class="btn btn-success mb-5">Add New Appointment</a>
				</div>				<!-- /.box-header -->
				<div class="box-body">


				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SN</th>
								<th>Name</th>
								<th>Centre</th>
								<th>Date</th>
                                <th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
                           @foreach($myappointment as $key => $app)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $app->name }}</td>
								<td>{{ $app->centre_name }}</td>
								<td>{{ $app->date }}</td>
								<td>
                                   <a href="{{ route('buyer.app.delete',$app->id) }}" class="btn btn-danger" id="delete">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			  <!-- /.box -->          
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