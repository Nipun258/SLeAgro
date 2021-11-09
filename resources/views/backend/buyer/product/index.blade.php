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
          <h3 class="box-title">Buyer Product Requirment Detials  <small class="text-warning">(Add each product Seperately)</small></h3>

          <a href="{{ route('buyer.product.add') }}" style="float: right;" class="btn btn-success mb-5">Add New Product Request</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th scope="col" width="5%">SL </th>
                 <th scope="col" width="15%">Vegitable/Fruit</th>
                 <th scope="col" width="10%">Quntity(Kg)</th>
                 <th scope="col" width="10%">Request Type</th>
                 <th scope="col" width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($buyer_products as $key => $product)
              <tr>
                <td>{{ $key+1 }}</td>
                <td> {{ $product->name}} </td>  
                <td> {{ $product->quantity }} </td>
                @if($product->type_id == 1)
                <td> Per Day Requirement </td>
                @elseif($product->type_id == 2)
                <td> Per Week Requirement </td>
                @elseif($product->type_id == 3)
                <td> Per Month Requirement </td>
                @endif
                <td>
                  <a href="{{ route('buyer.product.edit',$product->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ route('buyer.product.delete',$product->id) }}" class="btn btn-danger" id="delete">Delete</a>
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
