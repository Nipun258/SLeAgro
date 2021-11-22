@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Sell Vegitable product</h3>
					<h6 class="box-subtitle">Fill out necessary data</h6>
				</div>
				<!-- /.box-header -->
				<div class="box-body wizard-content">

					<form method="POST" action="{{ route('normal.sell.store') }}" class="contact-form">
						@csrf
						<!-- Step 2 -->
						<div class="form-section">
							<h4 class="title text-warning">Vegitable Detials</h4>
							<hr style="height:2px;border-width:0;color:gray;background-color:gray">


							<div class="add_vegitable_product">
								<label>Enter vegitable detials here.you can add multiple vegitable product:</label>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="veg_id" class="text-light">Vegitable Name</label>
											<select name="veg_id[]" id="veg_id" class="form-control">
                                                <option value="" selected="" disabled="">Select Vegitable</option>
                                                 @foreach($vegitablelist01 as $vegitable)
                                                <option value="{{ $vegitable->id }}">{{$vegitable->name }} </option>
                                                @endforeach
                                             </select>
                                              <span class="text-danger">@error('veg_id'){{$message}}@enderror</span>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="quntity" class="text-light">Net Quntity(Kg)</label>
											<input type="text" class="form-control" name="quntity[]" id="quntity">
											<span class="text-danger">@error('quntity'){{$message}}@enderror</span>
										</div>
									</div>

									<div class="col-md-2" style="padding-top: 25px;">
										<span class="btn btn-success btn-md addeventmore"><i class="fa fa-plus-circle"></i> </span>
									</div>
								</div>
							</div>
					      <div style="display: none;">
								<div class="whole_extra_item_add_2" id="whole_extra_item_add_2">
									<div class="delete_whole_extra_item_add_2" id="delete_whole_extra_item_add_2">
										<div class="form-row">
								<div class="col-md-4" style="padding-right: 18px;">
								<div class="form-group">
									<select class="form-control" name="veg_id[]" id="veg_id">
										<option value="" selected="" disabled="">Select Vegitable</option>
										@foreach($vegitablelist02 as $vegitable)
                                        <option value="{{ $vegitable->id }}">{{$vegitable->name }} </option>
                                         @endforeach
									</select>
								</div>
							</div>
											<div class="col-md-3" style="padding-right: 10px;padding-left: 12px;">
												<div class="form-group">
											<input type="text" class="form-control" name="quntity[]" id="quntity">
												</div>
											</div>

											<div class="col-md-2" style="padding-left: 18px;">
												<span class="btn btn-success btn-md addeventmore"><i class="fa fa-plus-circle"></i> </span>
												<span class="btn btn-danger btn-md removeeventmore"><i class="fa fa-minus-circle"></i> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>						
							<input type="submit" class="btn btn-success float-left" value="submit">
						</div>
					</form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		var counter2 = 0;
		$(document).on("click", ".addeventmore", function() {
			var whole_extra_item_add_2 = $('#whole_extra_item_add_2').html();
			$(this).closest(".add_vegitable_product").append(whole_extra_item_add_2);
			counter2++;
		});
		$(document).on("click", '.removeeventmore', function(event) {
			$(this).closest(".delete_whole_extra_item_add_2").remove();
			counter2 -= 1
		});

		
	});
</script>

@endsection
