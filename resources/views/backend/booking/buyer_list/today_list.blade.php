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
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Date For</th>
                <th>View Product</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mybooking as $key => $booking)
              <tr>
                <td>{{ $key+1 }}</td>
                <td><img width="60" style="border-radius: 50%;" src="{{ (!empty($booking->image))? url('upload/user_images/'.$booking->image):url('upload/images.png')}}" alt="User Avatar"></td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->email }}</td>
                <td>{{ $booking->mobile }}</td>
                <td>{{ $booking->date }}</td>
                <td><a href="{{route('buyer.booking.product.view',$booking->id)}}" type="button" class="btn btn-primary btn-md">View Product</a></td>
                <td>
                  @if($booking->status == 0)
                  <a href="{{route('product.request.update.status',$booking->id)}}" type="button" class="btn btn-danger btn-sm">Pending</a>
                  @elseif($booking->status == 1)
                  <a href="{{route('product.request.update.status',$booking->id)}}" type="button" class="btn btn-success btn-sm">Checked</a>
                  @else
                  <a href="" type="button" class="btn btn-info btn-sm">Completed</a>
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
