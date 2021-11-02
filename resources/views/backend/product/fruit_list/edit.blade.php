@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">Update Fruit Detials</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('fruit.update',$fruits->id) }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Fruit Name<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="name" class="form-control" value ="{{$fruits->name}}">
                                                                      <span class="text-danger">@error('name'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                  <div class="col-md-3">
                                                     <div class="form-group">
                                                                 <h5>Total Crop Area(Ha)<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="total_area" class="form-control" value ="{{$fruits->total_area}}">
                                                                      <span class="text-danger">@error('total_area'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                      <div class="col-md-3">
                                                     <div class="form-group">
                                                                 <h5>Total Producation(mt)<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="total_producation" class="form-control" value ="{{$fruits->total_producation}}">
                                                                      <span class="text-danger">@error('total_producation'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                   <div class="col-md-3">
                                                     <div class="form-group">
                                                                 <h5>Annual Crop Count<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="annual_crop_count" class="form-control" value ="{{$fruits->annual_crop_count}}">
                                                                      <span class="text-danger">@error('annual_crop_count'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                      </div>
                                                      <input type="hidden" name="old_image" value="{{ $fruits->image }}">
                                                      <div class="col-md-3">
                                                            <div class="form-group">
                                                                 <h5>Vegetable Image</h5>
                                                                 <div class="controls">
                                                                 <input type="file" name="image"
                                                                 class="form-control" value="{{ $fruits->image }}"> 
                                                                      <span class="text-danger">@error('image'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>      
                                                  

                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Description</h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="short_dis" class="form-control" value ="{{$fruits->short_dis}}">
                                                                      <span class="text-danger">@error('short_dis'){{$message}}@enderror</span> 
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