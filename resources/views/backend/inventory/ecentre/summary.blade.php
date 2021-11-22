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
          <h3 class="box-title">Total Availble Product List<span class="text-danger">({{$products->count()}})</span></h3>
          <a href="{{ route('product.summary.ecenre.report') }}" style="float: right;" class="btn btn-success mb-5" target="_blank">Print</a>
        </div>
        <div class="box-header">
          <form method="GET" action="{{ route('product.list.ecentre.filter') }}">
          @csrf
          Month Filter
          <div class="row">
          <div class="col-md-3">
            <input class="form-control" type="month" name="month">
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
                <th>Quntity(KG)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $key => $product)
              <tr>
                <td>{{ $key+1 }}</td>
                <td><img width="70" style="border-radius: 10%;" src="{{ (!empty($product->image))? url($product->image):url('upload/images.png')}}" alt="User Avatar"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->total }}</td>
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
