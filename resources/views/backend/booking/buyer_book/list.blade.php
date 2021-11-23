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
          <h3 class="box-title">Buyer Havest buyinging Appointment Booking List <span class="text-danger">({{$mybooking->count()}})</span></h3>
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
                <th>Created Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mybooking as $key => $booking)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $booking->centre_name }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->created_at}}</td>
                <td>
                  @if($booking->status == 0)
                  <button class="btn btn-danger btn-sm">Not Visited</button>
                  @elseif($booking->status == 1)
                  <button class="btn btn-info btn-sm">Checked</button>
                  @else
                   <button class="btn btn-success btn-sm">Product Buy</button>
                  @endif
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
      <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    </div>
  </div>
@endsection
