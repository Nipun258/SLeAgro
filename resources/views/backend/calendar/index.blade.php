@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="col-xl-10">
					<h3 class="page-title">Calendar</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Farmer</li>
								<li class="breadcrumb-item active" aria-current="page">Calendar</li>
							</ol>
						</nav>
					</div>
				</div>
                <div class="col-xl-2s">
                    <a href="#" data-toggle="modal" data-target="#add-new-events" class="btn btn-rounded btn-success btn-block my-10">
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
                <form method="post" action="{{ route('calendar.create') }}" >
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

		</section>
		<!-- /.content -->
	  </div>	  
	
  </div>

    {{-- Scripts --}}
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>


  <script type="text/javascript">

        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                //editable: true,
                eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                var title = prompt('Event Title:');
 
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
 
                    $.ajax({
                        url: SITEURL + "/calendar/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                    true
                            );
                }
                calendar.fullCalendar('unselect');
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/calendar/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                                displayMessage("Updated Successfully");
                            }
                        });
                    },
                eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/calendar/delete',
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                }
            }

            });
        });

        function displayMessage(message) {
                
            $(".response").html(""+message+"");
            setInterval(function() { $(".success").fadeOut(); }, 1000);
       }

    </script>

@endsection