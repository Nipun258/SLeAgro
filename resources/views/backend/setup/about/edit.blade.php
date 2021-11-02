@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">Update About Page</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('about.update',$about->id) }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Discription<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="discription">{{$about->discription}}
                                                                      </textarea>
                                                                      <span class="text-danger">@error('discription'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                            </div>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Vision<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="text" name="vision" class="form-control" value ="{{$about->vision}}">
                                                                      <span class="text-danger">@error('vision'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>

                                                            <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Mision <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <input type="text" name="mision" class="form-control" value ="{{$about->mision}}">
                                                                      <span class="text-danger">@error('mision'){{$message}}@enderror</span> 
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