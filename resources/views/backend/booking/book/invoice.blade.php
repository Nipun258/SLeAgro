@extends('admin.admin_master')
@section('admin')
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        


      <div class="col-12">

       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Farmer Havest selling Appointment Booking List <span class="text-danger">({{$mybooking->count()}})</span></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">SN</th>
                <th>Location</th>
                <th>Date For</th>
                <th>Time</th>
                <th>Created Date</th>
                <th width="20%">View Invoice</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mybooking as $key => $booking)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $booking->centre_name }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time}}</td>
                <td>{{ $booking->created_at}}</td>
                <td><a href="{{route('farmer.booking.invoice.generate',$booking->id)}}" type="button" class="btn btn-primary btn-md">Invoice</a></td>
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
      <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    </div>
  </div>
@endsection