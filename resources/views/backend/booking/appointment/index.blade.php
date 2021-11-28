@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">The Vegitable Selling Booking Appointment Check</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('app.check') }}">
								@csrf
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<h5>Choose Date <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="date" name="date" class="form-control"> <span class="text-danger">
														@error('date'){{$message}}@enderror</span>
														<br>
														<input type="submit" class="btn btn-danger mb-5" value="Check"> 
													</div>
												</div>	
											</div>
											
											</form>
                                          @if(Route::is('app.check'))
						                 <div class="col-md-12">
											<div class="col-md-8" >
												<input type="checkbox" name="" id="all" class="filled-in chk-col-info" style="float: right;" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked = this.checked" />
						                        <label for="all" style="float: right;">Select All Time Slot</label>
											</div>
											<div class="col-md-4">
													@if(isset($date))
													<h4><div class="text-info">Your Alocation List For</div>{{$date}}</h4>
													
													@endif
											</div>
						<form method="post" action="{{ route('app.time.update') }}">
						@csrf
					    <h5 class="box-title text-warning">Morning Appointment</h5>
						<table class="table table-bordered table-striped">
						<tbody>
							<input type="hidden" name="appointmentId" value="{{$appointmentId}}">
							<tr>
								<th scope="row">1</th>
								<td align="center"><input type="checkbox" name="time[]" id="08.00" class="filled-in chk-col-success" value="08.00" @if(isset($times)){{$times->contains('time','08.00') ? 'Checked':''}}@endif/>
						        <label for="08.00">8.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="08.30" class="filled-in chk-col-primary" value="08.30" @if(isset($times)){{$times->contains('time','08.30') ? 'Checked':''}}@endif/>
						        <label for="08.30">8.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td align="center"><input type="checkbox" name="time[]" id="09.00" class="filled-in chk-col-success" value="09.00" @if(isset($times)){{$times->contains('time','09.00') ? 'Checked':''}}@endif/>
						        <label for="9.00">9.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="09.30" class="filled-in chk-col-primary" value="09.30" @if(isset($times)){{$times->contains('time','09.30') ? 'Checked':''}}@endif/>
						        <label for="09.30">9.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td align="center"><input type="checkbox" name="time[]" id="10.00" class="filled-in chk-col-success" value="10.00" @if(isset($times)){{$times->contains('time','10.00') ? 'Checked':''}}@endif/>
						        <label for="10.00">10.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="10.30" class="filled-in chk-col-primary" value="10.30" @if(isset($times)){{$times->contains('time','10.30') ? 'Checked':''}}@endif/>
						        <label for="10.30">10.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td align="center"><input type="checkbox" name="time[]" id="11.00" class="filled-in chk-col-success" value="11.00" @if(isset($times)){{$times->contains('time','11.00') ? 'Checked':''}}@endif/>
						        <label for="11.00">11.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="11.30" class="filled-in chk-col-primary" value="11.30" @if(isset($times)){{$times->contains('time','11.30') ? 'Checked':''}}@endif/>
						        <label for="11.30">11.30 Am</label></td>
							</tr>
						</tbody>
					  </table>
					  <h5 class="box-title text-warning">Evening Appointment</h5>
						<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th scope="row">5</th>
								<td align="center"><input type="checkbox" name="time[]" id="13.00" class="filled-in chk-col-success" value="13.00" @if(isset($times)){{$times->contains('time','13.00') ? 'Checked':''}}@endif/>
						        <label for="13.00">1.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="13.30" class="filled-in chk-col-primary" value="13.30" @if(isset($times)){{$times->contains('time','13.30') ? 'Checked':''}}@endif/>
						        <label for="13.30">1.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">6</th>
								<td align="center"><input type="checkbox" name="time[]" id="14.00" class="filled-in chk-col-success" value="14.00" @if(isset($times)){{$times->contains('time','14.00') ? 'Checked':''}}@endif/>
						        <label for="14.00">2.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="14.30" class="filled-in chk-col-primary" value="14.30" @if(isset($times)){{$times->contains('time','14.30') ? 'Checked':''}}@endif/>
						        <label for="14.30">2.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">7</th>
								<td align="center"><input type="checkbox" name="time[]" id="15.00" class="filled-in chk-col-success" value="15.00" @if(isset($times)){{$times->contains('time','15.00') ? 'Checked':''}}@endif/>
						        <label for="15.00">3.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="15.30" class="filled-in chk-col-primary" value="15.30" @if(isset($times)){{$times->contains('time','15.30') ? 'Checked':''}}@endif/>
						        <label for="15.30">3.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">8</th>
								<td align="center"><input type="checkbox" name="time[]" id="16.00" class="filled-in chk-col-success" value="16.00" @if(isset($times)){{$times->contains('time','16.00') ? 'Checked':''}}@endif/>
						        <label for="16.00">4.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="16.30" class="filled-in chk-col-primary" value="16.30" @if(isset($times)){{$times->contains('time','16.30') ? 'Checked':''}}@endif/>
						        <label for="16.30">4.30 Pm</label></td>
							</tr>
						</tbody>
					  </table>	
					  </div>				
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-info mb-5" value="update">
												</div>
											</form>
										</div>
										<!-- /.col -->
									</div>
									@else
									<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h5 class="box-title text-warning">Collection Centre Appointment List <span class="text-danger">({{$myappointment->count()}})</span></h5>
				</div>
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
                                <th>Action</th>
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
									<form method="post" action="{{ route('app.check') }}">
								     @csrf
								     <input type="hidden" name="date" value="{{$app->date}}">
								     <input type="submit" class="btn btn-rounded btn-success mb-5" value="View/Update">
								 </form>
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
									@endif
									<!-- /.row -->
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</section>
						
					</div>
				</div>
				@endsection