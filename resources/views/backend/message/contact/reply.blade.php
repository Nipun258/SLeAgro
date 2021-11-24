@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">  
		<!-- left content -->
		<section class="left-block content">
			<a class="mdi mdi-close mdi-menu btn btn-success open-left-block d-block d-md-none" href="javascript:void(0)"></a>
				<div class="scrollable" style="height: 100%;">
					<div class="left-content-area">
						<div class="h-p100">

						  <div class="p-20">
							<a href="{{ route('contact.message.view')}}" class="btn btn-rounded btn-success btn-block">Back to Contact Message</a>
						  </div>

						  <div class="box mb-0 no-shadow bg-transparent b-0">
							<div class="box-header with-border p-20">
							  <h4 class="box-title">Mail</h4>
							</div>
							<div class="box-body mailbox-nav p-20">
							  <ul class="nav nav-pills flex-column">
								<li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-ios-email-outline"></i> Inbox
								  <span class="label label-success pull-right">{{$messages->count()}}</span></a></li>
								<li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-paper-airplane"></i> Sent</a></li>
								<li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-email-unread"></i> Drafts</a></li>
								<li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-star"></i>  Starred <span class="label label-warning pull-right">14</span></a>
								</li>
								<li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-trash-a"></i> Trash</a></li>
							  </ul>
							</div>
							<!-- /.box-body -->
						  </div>
						  <!-- /. box -->
						  <!-- /.box -->	
						</div>				
					</div>
				</div>
		</section>
		<!-- /.left content -->

		<!-- right content -->
		<section class="right-block content">

			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Replay Contact Message</h3>
				</div>
				<!-- /.box-header -->
				<form method="post" action="{{ route('contact.message.email') }}">
                 @csrf
				<div class="box-body">
                   @foreach($messages as $key => $message)
				  <div class="form-group">
					<input type="email" class="form-control" name="email" value="{{$message->email}}" readonly>
				  </div>
				  <div class="form-group">
					<input type="text" class="form-control" name="subject" value="{{ $message->contact_reason}}">
					<input type="hidden" class="form-control" name="id" value="{{ $message->id}}">
				  </div>
				  @endforeach
				  <div class="form-group">
						<textarea id="compose-textarea" name="msg" class="form-control" style="height: 100px">
						  
						</textarea>
				  </div>
				  <span class="text-danger">@error('msg'){{$message}}@enderror</span>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				  <div class="pull-right">
					<a type="button" class="btn btn-rounded btn-default"><i class="fa fa-pencil"></i></a> 
					<input type="submit" class="btn btn-rounded btn-success" value="Send">
				  </div>
				  <a href="{{ route('contact.message.view')}}" class="btn btn-rounded btn-danger"><i class="fa fa-times"></i> Discard</a>
				</div>
			</form>
				<!-- /.box-footer -->
			</div>
		 <!-- /. box -->

		</section>
		<!-- /.right content -->	  
  </div>
@endsection