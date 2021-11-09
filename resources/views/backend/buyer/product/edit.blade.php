@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">New Farmer Havest Land Detials</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('buyer.product.update',$buyer_products->id)}}">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Vegitable Name<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <select name="veg_id" id="veg_id" class="form-control">
                                                            
                                                                  @foreach($vegitable as $vegitable)
                                                                   @if($vegitable->id == $buyer_products->product)
                                                                  <option value="{{ $vegitable->id }}" selected="">{{$vegitable->name }} </option>
                                                                  @else
                                                                  <option value="{{ $vegitable->id }}" >{{$vegitable->name }} </option>
                                                                   @endif
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
                                                                 <input type="text" name="quantity" class="form-control" value ="{{$buyer_products->quantity}}">
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
                                                       <option value="1" {{ ($buyer_products->type_id == "1" ? "selected": "") }}>Per Day Requirement</option>
                                                       <option value="2" {{ ($buyer_products->type_id == "2" ? "selected": "") }}>Per Week Requirement</option>
                                                       <option value="3" {{ ($buyer_products->type_id == "3" ? "selected": "") }}>Per Month Requirement</option>
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