@extends('admin.admin_master')
@section('admin')
<style type="text/css">
	label.btn{
		padding: 0px;
	}

	label.btn input{
		opacity: 0;
		position: absolute;
	}

	label.btn span{
		text-align: center;
		padding: 6px 12px;
		display: block;
		max-width: 80px;
	}

   label.btn input:checked+span{
        background-color: rgba(37, 13, 255, 1.0);
        color: #fff;
   }

</style>
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        


      <div class="col-12">

       <form method="post" action="{{ route('booking.app') }}">
		@csrf
       <div class="box">

        <div class="box-header with-border">
          <h4 class="box-title">Farmer Havest selling time Selection </h4>
          <h5>Date : <span class="text-danger">{{$date}}</span></h5>
        </div>
               @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{$error}}</div>
      	@endforeach
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
             @foreach($times as $time)
             <div class="col-md-4">
		      <label class="btn btn-outline-primary">
		      	<input type="radio" name="time" value="{{$time->time}}">
		      	<span>{{$time->time}}</span>
		      </label>
			</div>
			<input type="hidden" name="appointmentId" value="{{$time->appointment_id}}">
			<input type="hidden" name="date" value="{{$date}}">
			@endforeach
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	<input type="submit" class="btn btn-success" value="Book Appointment" style="width:100%;" >
        </div>
        </div>
    </form>
        <!-- /.box -->


        <!-- /.box -->          
      </div>
      <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    </div>
  </div>
@endsection