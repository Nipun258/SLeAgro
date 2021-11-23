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
          <h3 class="box-title">Buyer buying Appointment Booking List <span class="text-danger">({{$mybooking->count()}})</span></h3>
        </div>
        <div class="box-header">
          <form method="GET" action="{{ route('app.filter') }}">
          @csrf
          Date Filter
          <div class="row">
          <div class="col-md-3">
            <input class="form-control" type="date" name="date">
          </div>
          <div class="coi-md-2">
            <input type="submit" class="btn btn-primary btn-sm" style="height: 5.5vh;" value="Search">
          </div>
          </div>
          </form>
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
                <th>Time</th>
                <th>Created Date</th>
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
                <td>{{ $booking->time}}</td>
                <td>{{ $booking->created_at}}</td>
                <td>
                  @if($booking->status == 0)
                  <a href="{{route('update.status',$booking->id)}}" type="button" class="btn btn-danger btn-sm">Pending</a>
                  @else
                  <a href="{{route('update.status',$booking->id)}}" type="button" class="btn btn-success btn-sm">Checked</a>
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
