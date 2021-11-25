@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Setup New Vegitable Selling Booking Appointment</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('app.store') }}">
								@csrf
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<h5>Choose Date <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="date" name="date" class="form-control" value="{{old('email')}}"> <span class="text-danger">@error('date'){{$message}}@enderror</span> 
													</div>
												</div>	
											</div>
											

											<div class="col-md-12">

					    <h5 class="box-title text-warning">Morning Appointment</h5>
					    <div class="col-sm-8" >
												<input type="checkbox" name="" id="all" class="filled-in chk-col-info" style="float: right;" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked = this.checked" />
						                        <label for="all" style="float: right;">Select All Time Slot</label>
											</div>
						<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td align="center"><input type="checkbox" name="time[]" id="8.00am" class="filled-in chk-col-success" value="08.00" />
						        <label for="8.00am">8.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="8.30am" class="filled-in chk-col-primary" value="08.30"/>
						        <label for="8.30am">8.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td align="center"><input type="checkbox" name="time[]" id="9.00am" class="filled-in chk-col-success" value="09.00" />
						        <label for="9.00am">9.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="9.30am" class="filled-in chk-col-primary" value="09.30"/>
						        <label for="9.30am">9.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td align="center"><input type="checkbox" name="time[]" id="10.00am" class="filled-in chk-col-success" value="10.00" />
						        <label for="10.00am">10.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="10.30am" class="filled-in chk-col-primary" value="10.30"/>
						        <label for="10.30am">10.30 Am</label></td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td align="center"><input type="checkbox" name="time[]" id="11.00am" class="filled-in chk-col-success" value="11.00" />
						        <label for="11.00am">11.00 Am</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="11.30am" class="filled-in chk-col-primary" value="11.30"/>
						        <label for="11.30am">11.30 Am</label></td>
							</tr>
						</tbody>
					  </table>
					  <h5 class="box-title text-warning">Evening Appointment</h5>
						<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th scope="row">5</th>
								<td align="center"><input type="checkbox" name="time[]" id="1.00pm" class="filled-in chk-col-success" value="13.00" />
						        <label for="1.00pm">1.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="1.30pm" class="filled-in chk-col-primary" value="13.30"/>
						        <label for="1.30pm">1.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">6</th>
								<td align="center"><input type="checkbox" name="time[]" id="2.00pm" class="filled-in chk-col-success" value="14.00" />
						        <label for="2.00pm">2.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="2.30pm" class="filled-in chk-col-primary" value="14.30"/>
						        <label for="2.30pm">2.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">7</th>
								<td align="center"><input type="checkbox" name="time[]" id="3.00pm" class="filled-in chk-col-success" value="15.00" />
						        <label for="3.00pm">3.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="3.30pm" class="filled-in chk-col-primary" value="15.30"/>
						        <label for="3.30pm">3.30 Pm</label></td>
							</tr>
							<tr>
								<th scope="row">8</th>
								<td align="center"><input type="checkbox" name="time[]" id="4.00pm" class="filled-in chk-col-success" value="16.00" />
						        <label for="4.00pm">4.00 Pm</label></td>
								<td align="center"><input type="checkbox" name="time[]" id="4.30pm" class="filled-in chk-col-primary" value="16.30"/>
						        <label for="4.30pm">4.30 Pm</label></td>
							</tr>
						</tbody>
					  </table>	
					  </div>				
												
												<div class="text-xs-right">
													<input type="submit" class="btn btn-rounded btn-success mb-5" value="submit">
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