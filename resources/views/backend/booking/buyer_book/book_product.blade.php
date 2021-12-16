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
          <h3 class="box-title">Buyer Booking vegitable product List <span class="text-danger">( {{$bdate}} )</span></h3>
          <a href="{{ url()->previous() }}" style="float: right;" class="btn btn-success mb-5">Back Boooking List</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">SN</th>
                <th>Vegitable Name</th>
                <th>Quntity(Kg)</th>
                <th width="20%">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product_list as $key => $product)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quntity }}</td>
                <td>
                  @if($product->status == 0)
                  <a type="button" class="btn btn-danger btn-sm">Waiting buy</a>
                  @elseif($product->status == 1)
                  <a type="button" class="btn btn-info btn-sm">Checked</a>
                  @else
                   <a type="button" class="btn btn-success btn-sm">Product Buy</a>
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

