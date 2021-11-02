@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
     <div class="container-full">
          <!-- Main content -->
          <section class="content">
               <!-- Basic Forms -->
               <div class="box">
                    <div class="box-header with-border">
                         <h4 class="box-title">Add New FAQ</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="row">
                              <div class="col">
                                   <form method="post" action="{{ route('question.store') }}">
                                        @csrf
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="row">
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Question<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <textarea class="form-control" id="question" rows="3" name="question"></textarea>
                                                                      <span class="text-danger">@error('answer'){{$message}}@enderror</span> 
                                                                 </div>
                                                            </div class="col-md-12">  

                                                            </div>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <h5>Answer<span class="text-danger">*</span></h5>
                                                                 <div class="controls">
                                                                      <textarea class="form-control" id="answer" rows="3" name="answer"></textarea>
                                                                      <span class="text-danger">@error('answer'){{$message}}@enderror</span>
                                                                 </div>
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