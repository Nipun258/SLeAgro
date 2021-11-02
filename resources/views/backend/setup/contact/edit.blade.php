@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">Update Contact Page</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('contact.update',$contact->id) }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Location<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="location" class="form-control" value ="{{$contact->location}}">
                                                                      <span class="text-danger">@error('location'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-6">  

                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Email<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="email" name="email" class="form-control" value ="{{$contact->email}}">
                                                                      <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>     
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Phone Number<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="phone" class="form-control" value ="{{$contact->phone}}">
                                                                      <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                                                 </div>
                                                            </div>

                                                       </div>

                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <h5>Fax Number <span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                 <input type="text" name="fax" class="form-control" value ="{{$contact->fax}}">
                                                                      <span class="text-danger">@error('fax'){{$message}}@enderror</span> 
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