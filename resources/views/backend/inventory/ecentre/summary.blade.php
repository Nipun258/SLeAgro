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
          <h3 class="box-title">Total Availble Product List<span class="text-danger">({{count(json_decode($products))}})</span></h3>
<!--           <a href="{{ route('product.summary.ecenre.report') }}" style="float: right;" class="btn btn-success " target="_blank">Current Stock Summary Report</a>
          <a href="{{ route('product.summary.month.ecenre.report') }}" style="float: right;" class="btn btn-info" target="_blank">Month Summary Report</a> -->
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
            <a type="button" href="{{ route('product.summary.ecentre') }}" class="btn btn-success btn-md" >Back Current State</a>
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
              @foreach(json_decode($products) as $product)
              <tr>
                @php
                $i = 0;
                $i++
                @endphp
                <td>{{ $i}}</td>
                <td><img width="70" style="border-radius: 10%;" src="{{ (!empty($product->image))? url($product->image):url('upload/images.png')}}" alt="User Avatar"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quntity }}</td>
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
