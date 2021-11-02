@extends('admin.admin_master')
@section('admin')
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
{{--    <div class="content-header">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="page-title">Data Tables</h3>
          <div class="d-inline-block align-items-center">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> --}}

    <!-- Main content -->
    <section class="content">
      <div class="row">
        


      <div class="col-12">

       <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Fruit Price List</h3>
          <a href="{{ route('fruit.price.add') }}" style="float: right;" class="btn btn-success mb-5">Add New Fruit Price</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th scope="col" width="5%">SL </th>
                 <th scope="col" width="15%">Fruit</th>
                 <th scope="col" width="15%">Wholesale Price</th>
                 <th scope="col" width="15%">Retial Price</th>
                 <th scope="col" width="15%">Price Location</th>
                 <th scope="col" width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($fruit_prices as $key => $price)             
              <tr>
                <td>{{ $key+1 }}</td>
                <td> {{ $price->name }} </td>
                <td> Rs. {{ number_format($price->price_wholesale , 2) }} </td>
                <td> Rs. {{ number_format($price->price_retial , 2) }} </td>
                @if($price->price_location == 0) 
                <td> All Island </td>
                @elseif($price->price_location == 1)
                <td> Pettah </td>
                @elseif($price->price_location == 2)
                <td> Dambulla </td>
                @endif
                <td>
                  <a href="{{ route('fruit.price.edit',$price->id) }}" class="btn btn-info btn-sm">Update</a>
                  <a href="{{ route('fruit.price.delete',$price->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
{{--            <tfoot>
              <tr>
                <th width="10%">Centre Id</th>
                <th>Centre Name</th>
                <th width="10%">Centre Type</th>
                <th>Provice</th>
                <th>District</th>
                <th>City</th>
                <th width="25%">Action</th>
              </tr>
            </tfoot> --}}
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


{{-- Fresh vegetables & fruits
Freshly grown for customers --}}