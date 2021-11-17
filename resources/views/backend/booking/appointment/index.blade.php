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
								<td align="center"><input type="checkbox" name="time[]" id="8.00am" class="filled-in chk-col-success" value="8.00am" @if(isset($times)){{$times->contains('time','8.00am') ? 'Checked':''}}@endif/>
						        <label for="8.00am">8.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="8.30am" class="filled-in chk-col-primary" value="8.30am" @if(isset($times)){{$times->contains('time','8.30am') ? 'Checked':''}}@endif/>
						        <label for="8.30am">8.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td align="center"><input type="checkbox" name="time[]" id="9.00am" class="filled-in chk-col-success" value="9.00am" @if(isset($times)){{$times->contains('time','9.00am') ? 'Checked':''}}@endif/>
						        <label for="9.00am">9.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="9.30am" class="filled-in chk-col-primary" value="9.30am" @if(isset($times)){{$times->contains('time','9.30am') ? 'Checked':''}}@endif/>
						        <label for="9.30am">9.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td align="center"><input type="checkbox" name="time[]" id="10.00am" class="filled-in chk-col-success" value="10.00am" @if(isset($times)){{$times->contains('time','10.00am') ? 'Checked':''}}@endif/>
						        <label for="10.00am">10.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="10.30am" class="filled-in chk-col-primary" value="10.30am" @if(isset($times)){{$times->contains('time','10.30am') ? 'Checked':''}}@endif/>
						        <label for="10.30am">10.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td align="center"><input type="checkbox" name="time[]" id="11.00am" class="filled-in chk-col-success" value="11.00am" @if(isset($times)){{$times->contains('time','11.00am') ? 'Checked':''}}@endif/>
						        <label for="11.00am">11.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="11.30am" class="filled-in chk-col-primary" value="11.30am" @if(isset($times)){{$times->contains('time','11.30am') ? 'Checked':''}}@endif/>
						        <label for="11.30am">11.30 Am</label></td>
							</tr>
						</tbody>
					  </table>
					  <h5 class="box-title text-warning">Evening Appointment</h5>
						<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th scope="row">5</th>
								<td align="center"><input type="checkbox" name="time[]" id="1.00pm" class="filled-in chk-col-success" value="1.00pm" @if(isset($times)){{$times->contains('time','1.00pm') ? 'Checked':''}}@endif/>
						        <label for="1.00pm">1.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="1.30pm" class="filled-in chk-col-primary" value="1.30pm" @if(isset($times)){{$times->contains('time','1.30pm') ? 'Checked':''}}@endif/>
						        <label for="1.30pm">1.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">6</th>
								<td align="center"><input type="checkbox" name="time[]" id="2.00pm" class="filled-in chk-col-success" value="2.00pm" @if(isset($times)){{$times->contains('time','2.00pm') ? 'Checked':''}}@endif/>
						        <label for="2.00pm">2.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="2.30pm" class="filled-in chk-col-primary" value="2.30pm" @if(isset($times)){{$times->contains('time','2.30pm') ? 'Checked':''}}@endif/>
						        <label for="2.30pm">2.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">7</th>
								<td align="center"><input type="checkbox" name="time[]" id="3.00pm" class="filled-in chk-col-success" value="3.00pm" @if(isset($times)){{$times->contains('time','3.00pm') ? 'Checked':''}}@endif/>
						        <label for="3.00pm">3.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="3.30pm" class="filled-in chk-col-primary" value="3.30pm" @if(isset($times)){{$times->contains('time','3.30pm') ? 'Checked':''}}@endif/>
						        <label for="3.30pm">3.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">8</th>
								<td align="center"><input type="checkbox" name="time[]" id="4.00pm" class="filled-in chk-col-success" value="4.00pm" @if(isset($times)){{$times->contains('time','4.00pm') ? 'Checked':''}}@endif/>
						        <label for="4.00pm">4.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="4.30pm" class="filled-in chk-col-primary" value="4.30pm" @if(isset($times)){{$times->contains('time','4.30pm') ? 'Checked':''}}@endif/>
						        <label for="4.30pm">4.30 Pm</label></td>
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