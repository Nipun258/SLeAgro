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
          <h3 class="box-title">Contact Messages</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th scope="col" width="5%">SL </th>
                 <th scope="col" >Name</th>
                 <th scope="col" >Email</th>
                 <th scope="col" >Phone Number</th>
                 <th scope="col" width="15%">contact Reason</th>
                 <th scope="col" width="10%">District</th>
                 <th scope="col" width="25%">Message</th>
                 <th scope="col" width="20%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($messages as $key => $message)
              <tr>
                <td>{{ $key+1 }}</td>
                <td> {{ $message->name }} </td>  
                <td> {{ $message->email }} </td>
                <td> {{ $message->phone }} </td>
                <td> {{ $message->contact_reason }} </td>
                <td> {{ $message->district }} </td>
                <td> {{ $message->message }} </td>
                <td>
                  @if($message->status == 0)
                  <a href="{{ route('contact.message.reply',$message->id) }}" class="btn btn-info btn-sm">Reply</a>
                  @else
                  <a href="" class="btn btn-success btn-sm">Done</a>
                  @endif
                  <a href="{{ route('contact.message.delete',$message->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
