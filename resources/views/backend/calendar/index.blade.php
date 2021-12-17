@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="col-xl-9">
					<h3 class="page-title">Event Management System</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
					<a href="{{ route('dashboard') }}"  class="btn btn-rounded btn-primary btn-block my-10">
                    <i class="ti-user"></i> Dashboard
                    </a>
							</ol>
						</nav>
					</div>
				</div>
                <div class="col-xl-3">
                    <a href="#" data-toggle="modal" data-target="#add-new-event-normal" class="btn btn-rounded btn-success btn-block my-10">
                    <i class="ti-plus"></i> Add New Event
                    </a>
                </div>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">

		  <div class="row">
			
<div class="col-12">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-xl-12 col-lg-8 col-12">
                    <div id='full_calendar_events'></div>
                </div>
            </div>
        </div>
    </div>
</div>
			  
			</div>
		  <!-- /.row -->
          <div class="modal center-modal fade " id="add-new-events" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title">Craete New Event</h5>
                <a type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('calendar.create.normal') }}" >
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control"> <span class="text-danger">
                                        @error('title'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event Start Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="start" id="start" class="form-control" readonly> <span class="text-danger">
                                        @error('start'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event End Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="end" id="end" class="form-control" readonly> <span class="text-danger">
                                        @error('end'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" >
                        </form>
                    </div>
                </div>
            </div>
        </div>


   <div class="modal center-modal fade " id="add-new-event-normal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title">Craete New Event</h5>
                <a type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('calendar.create.normal') }}" >
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control"> <span class="text-danger">
                                        @error('title'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event Start Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="datetime-local" name="start" class="form-control"> <span class="text-danger">
                                        @error('start'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Event End Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="datetime-local" name="end" class="form-control"> <span class="text-danger">
                                        @error('end'){{$message}}@enderror</span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <input type="submit" class="btn btn-rounded btn-success mx-auto d-block" value="Submit" >
                        </form>
                    </div>
                </div>
            </div>
        </div>

  

  <div class="modal center-modal fade " id="delete-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title">User Event View</h5>
            <a type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </a>
          </div>
          <div class="modal-body">
             <div class="col-md-12">
                    <table class="table table-hover" id="tableData">
                        <tr>
                            <th><b>Event Title</b></th>
                            <td id="event_title_get" class="text-white"></td>
                        </tr>
                        <tr>
                            <th><b>Event Start Time</b></th>
                            <td id="event_start_get" class="text-white"></td>
                        </tr>
                        <tr>
                            <th><b>Event End Time</b></th>
                            <td id="event_end_get" class="text-white"><input type="text" name="event_id" ></td>
                        </tr>
                        <tr>
                            <th><b>Event Type</b></th>
                            <td id="event_type_get" class="text-white"></td>
                        </tr>
                    </table>
                </div>
             <input type="hidden" name="event_id" id="event_id_get">
          </div>
          <div class="modal-footer modal-footer-uniform">
            <a type="button" id="btn-delete" class="btn btn-rounded btn-danger ">Delete</a>
            <a type="button" class="btn btn-rounded btn-success float-right" data-dismiss="modal">Confirm</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal center-modal fade " id="update-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title">User Event Update</h5>
            <a type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </a>
          </div>
          <div class="modal-body">
            <p>Event Data updated Successfully</p>
          </div>
          <div class="modal-footer modal-footer-uniform text-center">
            <a type="button" class="btn btn-rounded btn-primary" data-dismiss="modal">Confirm</a>
          </div>
        </div>
      </div>
    </div>

		</section>
		<!-- /.content -->
	  </div>	  
	
  </div>

    {{-- Scripts --}}
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js'></script>


  <script type="text/javascript">

        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

           $('#add-new-event-normal').on('hidden.bs.modal', function () {
                 $(this).find('form').trigger('reset');
            });

            $(document).on('click', '#btn-delete', function(){
                   
                   var event_id = document.getElementById('event_id_get').value;
                   //alert(event_id);
                   $.ajax({
                        type: "POST",
                        url: SITEURL + '/calendar/delete',
                        data: "&id=" + event_id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                
                            }
                            window.location.reload();
                        }
                    });
                   $('#delete-modal').modal('hide');
             });


            var calendar = $('#full_calendar_events').fullCalendar({
                editable: true,
                header:{
                    left:'prev, today ,next ',
                    center:'title',
                    right:'month,agendaWeek,agendaDay,listMonth'
                },
                timezone: 'local',
                events: SITEURL + "/calendar",
                displayEventTime: true,
                selectable: true,
                selectHelper: true,
                //contentHeight:500,//1650
                aspectRatio:  2, 
                eventColor: '#0066ff',
                nowIndicator: 'true',
                select: function (start, end, allDay) {

                  var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");

                  var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $('#add-new-events').modal('show');

                  document.getElementById("start").value=start;

                  document.getElementById("end").value=end;

                 //calendar.fullCalendar('unselect');
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/calendar/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                                $('#update-modal').modal('show');
                            }
                        });
                    },
                eventClick: function (event) {

                $('#delete-modal').modal('show');
                document.getElementById('event_id_get').value=event.id;

                document.getElementById('event_title_get').innerText=event.title.toUpperCase();
                document.getElementById('event_start_get').innerText=event.start ;
                document.getElementById('event_end_get').innerText=event.end;
                //document.getElementById('event_type_get').innerText=event.event_type;

                if (event.event_type == 1) {

                document.getElementById('event_type_get').innerText = 'Personal Event';

                }
                else{
                
                document.getElementById('event_type_get').innerText = 'Booking System Event';

                }

            },
            eventRender: function (calev, elt) {
            
              var ntoday = new Date();

              if (calev.end._d.getTime() < ntoday.getTime() ) {

                  elt.css('background-color', '#5c5c3d');

              }else if(calev.start._d.getTime() <= ntoday.getTime() && calev.end._d.getTime() >= ntoday.getTime()){

                  elt.css('background-color', '#ff3300');

              }else if(calev.event_type == 1){
                         
                  elt.css('background-color', '#009933');

              }else if(calev.event_type == 2){

                  elt.css('background-color', '#0000ff');
              }
              else{

                  elt.css('background-color', '#000000');
              }

          },

            });
        });

    </script>

@endsection