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
          <h3 class="box-title">Fruits List</h3>
          <a href="{{ route('fruit.add') }}" style="float: right;" class="btn btn-success mb-5">Add New Fruit</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th scope="col" width="5%">SL </th>
                 <th scope="col" width="15%">Name</th>
                 <th scope="col" width="15%">Discription</th>
                 <th scope="col" width="15%">Image</th>
                 <th scope="col" width="10%">Total Area Cultivate(Ha)</th>
                 <th scope="col" width="10%">Total Production(mt)</th>
                 <th scope="col" width="10%">Annual Crop Count</th>
                 <th scope="col" width="20%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($fruits as $key => $fruit)
              <tr>
                <td>{{ $key+1 }}</td>
                <td> {{ $fruit->name }} </td>
                <td> {{ $fruit->short_dis }} </td>
                <td> <img src="{{ asset($fruit->image) }}" style="height:40px; width:70px;" > </td>
                <td> {{ $fruit->total_area }} </td>
                <td> {{ $fruit->total_producation }} </td>
                <td> {{ $fruit->annual_crop_count }} </td> 
                <td>
                  <a href="{{ route('fruit.edit',$fruit->id) }}" class="btn btn-info btn-sm">Edit</a>
                  <a href="{{ route('fruit.delete',$fruit->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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