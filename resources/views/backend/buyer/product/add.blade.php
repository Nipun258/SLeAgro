@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">New Buyers Product Requirment Detials</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('buyer.product.store') }}">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Vegitable Name<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <select name="veg_id" id="veg_id" class="form-control">
                                                                  <option value="" selected="" disabled="">Select Vegitable</option>
                                                                  @foreach($vegitable as $vegitable)
                                                                   <option value="{{ $vegitable->id }}">{{$vegitable->name }} </option>
                                                                    @endforeach    
                                                                 </select>
                                                                      <span class="text-danger">@error('veg_id'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>
                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                                 <h5>Product Quantity<span class="text-warning">(Kg)<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="quantity" class="form-control" value ="">
                                                                      <span class="text-danger">@error('quantity'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                      
                                                   <div class="col-md-6">
                                                     <div class="form-group">
                                                                 <h5>Product Request Type<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <select name="type_id" id="type_id" class="form-control">
                                                       <option value="" selected="" disabled="">Select Relevent Request Type</option>
                                                       <option value="1">Per Day Requirement</option>
                                                       <option value="2">Per Week Requirement</option>
                                                       <option value="3">Per Month Requirement</option>
                                                       </select>
                                                               <span class="text-danger">@error('type_id'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>                                                     
               
                                                            <div class="text-xs-right">
                                                                 <input type="submit" class="btn btn-rounded btn-info mb-5" value="submit">
                                                            </div>
                                                       </form>
                                                  </div>
                                                  <!-- /.col -->
                                             </div>
                                             <!-- /.row -->
                                        </div>
                                        <!-- /.box-body -->
                                   </div>
                                   <!-- /.box -->
                              </section>
                              
                         </div>
                    </div>
                    @endsection