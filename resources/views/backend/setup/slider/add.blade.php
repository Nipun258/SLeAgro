@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">Add New Slider</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('slider.store') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Text 01 <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="text" name="text1" class="form-control">
                                                                      <span class="text-danger">@error('text1'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                            </div>
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>HighLight Text <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="text" name="spectext" class="form-control">
                                                                      <span class="text-danger">@error('spectext'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Text 02 <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="text" name="text2" class="form-control">
                                                                      <span class="text-danger">@error('text2'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                            </div>

                                                            <div class="col-md-6">
                                                               <div class="form-group">
                                                                 <h5>Slider Image <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="file" name="image" class="form-control-file" id="image">
                                                                      <span class="text-danger">@error('image'){{$message}}@enderror</span> 
                                                                 </div>  
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