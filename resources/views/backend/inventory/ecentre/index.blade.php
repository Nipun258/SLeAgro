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
          <h3 class="box-title">Sell Vegitable From System<span class="text-danger">({{$mybooking->count()}})</span></h3>
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
                <td>{{ $booking->created_at}}</td>
                <td>
                  <a href="{{route('product.sell.view',$booking->id)}}" type="button" class="btn btn-info btn-sm">Add Product</a>
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