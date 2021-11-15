@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">New Vegitable Price Set</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('vegitable.price.store') }}">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                      <div class="col-md-6">
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
                                                                 <h5>Whole Sale Price Location<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <select name="price_location" id="price_location" class="form-control">
                                                                  <option value="" selected="" disabled="">Select Price Location</option>
                                                                  <option {{ old('price_location') == "0" ? "selected" : "" }} value="0">All Island</option>
                                                                  <!-- <option {{ old('price_location') == "1" ? "selected" : "" }} value="1"> Pettah
                                                                  </option>
                                                                  <option {{ old('price_location') == "1" ? "selected" : "" }} value="2"> Dambulla
                                                                  </option>  -->
                                                                 </select>
                                                                      <span class="text-danger">@error('price_location'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                                 <h5>Whole Sale Price(Per/KG)<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="price_wholesale" class="form-control" value ="">
                                                                      <span class="text-danger">@error('price_wholesale'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                      
                                                   <div class="col-md-6">
                                                     <div class="form-group">
                                                                 <h5>Retial Sale Price(Per/KG)<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="price_retial" class="form-control" value ="">
                                                                      <span class="text-danger">@error('price_retial'){{$message}}@enderror</span> 
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