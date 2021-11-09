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
          <h3 class="box-title">Farmer Havest Land Detials  <small class="text-warning">(Add each product Area Seperately)</small></h3>

          <a href="{{ route('farmer.land.add') }}" style="float: right;" class="btn btn-success mb-5">Add New Land</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th scope="col" width="5%">SL </th>
                 <th scope="col" width="15%">Vegitable/Fruit</th>
                 <th scope="col" width="10%">Number of Area(perch)</th>
                 <th scope="col" width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($farmer_lands as $key => $land)
              <tr>
                <td>{{ $key+1 }}</td>
                <td> {{ $land->name}} </td>  
                <td> {{ $land->area }} </td>
                <td>
                  <a href="{{ route('farmer.land.edit',$land->id) }}" class="btn btn-info">Edit</a>
                  <a href="{{ route('farmer.land.delete',$land->id) }}" class="btn btn-danger" id="delete">Delete</a>
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
