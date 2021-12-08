@php
 $prefix = Request::route()->getPrefix();
 $route = Route::current()->getName();

 @endphp
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="http://127.0.0.1:8000">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png')}}" alt="">
						  <h3><b>SL</b> e-Agro</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="{{ ($route == 'dashboard')?'active':'' }}">
          <a href="{{ route('dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		@if(Auth::user()->role =='Admin' || Auth::user()->role =='EC-Officer' || Auth::user()->role =='RC-Officer')
        <li class="treeview {{ ($prefix == '/users')?'active':'' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
            <li><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
          </ul>
        </li>

      @endif
        <li class="treeview  {{ ($prefix == '/profile')?'active':'' }}">
          <a href="#">
            <i data-feather="users"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
            <li><a href="{{ route('password.view') }}"><i class="ti-more"></i>Change Password</a></li>
          </ul>
        </li>
        @if(Auth::user()->role =='Admin')
        <li class="treeview  {{ ($prefix == '/centres')?'active':'' }}">
          <a href="#">
            <i data-feather="settings"></i> <span>Manage Centre</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ecomomic.centre.view') }}"><i class="ti-more"></i>View Economic Centre</a></li>
            <li><a href="{{ route('ecomomic.centre.add') }}"><i class="ti-more"></i>Add New Economic Centre</a></li>
            <li><a href="{{ route('collection.centre.view') }}"><i class="ti-more"></i>View Collection Centre</a></li>
            <li><a href="{{ route('collection.centre.add') }}"><i class="ti-more"></i>Add New Collection Centre</a></li>
          </ul>
        </li>
		    @endif
         @if(Auth::user()->role =='EC-Officer')
         <li class="treeview  {{ ($prefix == '/centres')?'active':'' }}">
          <a href="#">
            <i data-feather="settings"></i> <span>Manage Centre</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('collection.centre.view') }}"><i class="ti-more"></i>View Collection Centre</a></li>
            <li><a href="{{ route('collection.centre.add') }}"><i class="ti-more"></i>Add New Collection Centre</a></li>
          </ul>
        </li>
         @endif
         @if(Auth::user()->role =='Admin')
        <li class="treeview {{ ($prefix == '/setups')?'active':'' }}">
          <a href="#">
            <i data-feather="anchor"></i>
            <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('slider.view') }}"><i class="ti-more"></i>Slider Setup</a></li>
            <li><a href="{{ route('about.view') }}"><i class="ti-more"></i>About Us Setup</a></li>
            <li><a href="{{ route('contact.view') }}"><i class="ti-more"></i>Contact Us Setup</a></li>
            <li><a href="{{ route('question.view') }}"><i class="ti-more"></i>FAQ Setup</a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Admin')
        <li class="treeview {{ ($prefix == '/products')?'active':'' }}">
          <a href="#">
            <i data-feather="gift"></i>
            <span>Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('vegitable.view') }}"><i class="ti-more"></i>Vegetables List </a></li>
            <li><a href="{{ route('vegitable.price.view') }}"><i class="ti-more"></i>Vegetable Price Set</a></li>
            <!-- <li><a href="{{ route('fruit.view') }}"><i class="ti-more"></i>Furits List </a></li>
            <li><a href="{{ route('fruit.price.view') }}"><i class="ti-more"></i>Furits Price Set</a></li> -->
          </ul>
        </li> 
        @endif

        <li class="treeview {{ ($prefix == '/calculator')?'active':'' }}">
          <a href="#">
            <i data-feather="calendar"></i>
            <span>Calculator</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('calculator.view') }}"><i class="ti-more"></i>havest Predictor Calculator</a></li>
            <li><a href="{{ route('price.calculator.view') }}"><i class="ti-more"></i>Price Calculator</a></li>
          </ul>
        </li> 

        @if(Auth::user()->role =='Admin')
        <li class="treeview {{ ($prefix == '/messages')?'active':'' }}">
          <a href="#">
            <i data-feather="send"></i>
            <span>Message Managment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('contact.message.view') }}"><i class="ti-more"></i>Contact Message </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Farmer')
        <li class="treeview {{ ($prefix == '/farmers')?'active':'' }}">
          <a href="#">
            <i data-feather="save"></i>
            <span>Farmer Setup </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @php
             $farmer = DB::table('farmers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
            @if(!isset($farmer))
            <li><a href="{{ route('farmer.setup') }}"><i class="ti-more"></i>Account SetUp </a></li>
            @elseif(isset($farmer))
            <li><a href="{{ route('farmer.edit') }}"><i class="ti-more"></i>Account Update</a></li>
            @endif
            <li><a href="{{ route('farmer.land.view') }}"><i class="ti-more"></i>Product Setup</a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Buyer')
        <li class="treeview {{ ($prefix == '/buyers')?'active':'' }}">
          <a href="#">
            <i data-feather="save"></i>
            <span>Buyer Setup </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @php
             $buyer = DB::table('buyers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
            @if(!isset($buyer))
            <li><a href="{{ route('buyer.setup') }}"><i class="ti-more"></i>Account SetUp </a></li>
            @elseif(isset($buyer))
            <li><a href="{{ route('buyer.edit') }}"><i class="ti-more"></i>Account Update</a></li>
            @endif
            <li><a href="{{ route('buyer.product.view') }}"><i class="ti-more"></i>Product Requirement</a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Farmer-Buyer')
        <li class="treeview {{ ($prefix == '/buyers' || $prefix == '/farmers')?'active':'' }}">
          <a href="#">
            <i data-feather="save"></i>
            <span>Farmer/Buyer Setup </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @php
            $buyer = DB::table('buyers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            $farmer = DB::table('farmers')
                       ->where('user_id', Auth::user()->id)
                       ->first();
            @endphp
            @if(!isset($farmer))
            <li><a href="{{ route('farmer.setup') }}"><i class="ti-more"></i>Farmer Account SetUp </a></li>
            @elseif(isset($farmer))
            <li><a href="{{ route('farmer.edit') }}"><i class="ti-more"></i>Farmer Account Update</a></li>
            @endif
            <li><a href="{{ route('farmer.land.view') }}"><i class="ti-more"></i>Farmer Product Setup</a></li>
            @if(!isset($buyer))
            <li><a href="{{ route('buyer.setup') }}"><i class="ti-more"></i>Buyer Account SetUp </a></li>
            @elseif(isset($buyer))
            <li><a href="{{ route('buyer.edit') }}"><i class="ti-more"></i>Buyer Account Update</a></li>
            @endif
            <li><a href="{{ route('buyer.product.view') }}"><i class="ti-more"></i>Buyer Product Request</a></li>
            
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='RC-Officer' )
        <li class="treeview {{ ($prefix == '/appointments')?'active':'' }}">
          <a href="#">
            <i data-feather="check-circle"></i>
            <span>Appointment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('app.setup') }}"><i class="ti-more"></i>Setup </a></li>
            <li><a href="{{ route('app.check.view') }}"><i class="ti-more"></i>Check </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Farmer')
        <li class="treeview {{ ($prefix == '/bookings')?'active':'' }}">
          <a href="#">
            <i data-feather="check-circle"></i>
            <span>Booking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('booking.view') }}"><i class="ti-more"></i>Make Booking </a></li>
            <li><a href="{{ route('booking.list') }}"><i class="ti-more"></i>Booking List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='RC-Officer')
        <li class="treeview {{ ($prefix == '/farmerapps')?'active':'' }}">
          <a href="#">
            <i data-feather="filter"></i>
            <span>Farmer App List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('app.list.today') }}"><i class="ti-more"></i>Today Appointment </a></li>
            <li><a href="{{ route('app.list') }}"><i class="ti-more"></i>All Appointment </a></li>
          </ul>
        </li>
        <li class="treeview {{ ($prefix == '/cinventory')?'active':'' }}">
          <a href="#">
            <i data-feather="home"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('booking.lists') }}"><i class="ti-more"></i>Add New Products(RU) </a></li>
            <li><a href="{{ route('product.add.normal.view') }}"><i class="ti-more"></i>Add New Products(N) </a></li>
            <li><a href="{{ route('product.transfer.ecenter.view') }}"><i class="ti-more"></i>Transfer Products </a></li>
            <li><a href="{{ route('product.summary')}}"><i class="ti-more"></i>Invetory Summary </a></li>
          </ul>
        </li>
        @endif
        @if(Auth::user()->role =='EC-Officer')
        <li class="treeview {{ ($prefix == '/bappointments')?'active':'' }}">
          <a href="#">
            <i data-feather="check-circle"></i>
            <span>Appointment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('buyer.app.setup') }}"><i class="ti-more"></i>Setup </a></li>
            <li><a href="{{ route('buyer.app.check.view') }}"><i class="ti-more"></i>Check </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='EC-Officer')
        <li class="treeview {{ ($prefix == '/buyerreqs')?'active':'' }}">
          <a href="#">
            <i data-feather="filter"></i>
            <span>Buyer Request List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('product.request.list.today') }}"><i class="ti-more"></i>Today Request </a></li>
            <li><a href="{{ route('product.request.list') }}"><i class="ti-more"></i>All Request List </a></li>
          </ul>
        </li>
        <li class="treeview {{ ($prefix == '/einventory')?'active':'' }}">
          <a href="#">
            <i data-feather="home"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('booking.buyer.lists') }}"><i class="ti-more"></i>Sell Products Buyer(RU) </a></li>
            <li><a href="{{ route('product.sell.normal.view') }}"><i class="ti-more"></i>Sell Products Buyer(N) </a></li>
            <li><a href="{{ route('product.transfer.market.view') }}"><i class="ti-more"></i>Distributed Retail Market </a></li>
            <li><a href="{{ route('product.summary.ecentre')}}"><i class="ti-more"></i>Invetory Summary </a></li>
          </ul>
        </li>
        @endif
        @if(Auth::user()->role =='Buyer')
        <li class="treeview {{ ($prefix == '/bbookings')?'active':'' }}">
          <a href="#">
            <i data-feather="check-circle"></i>
            <span>Booking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('buyer.booking.view') }}"><i class="ti-more"></i>Make Booking </a></li>
            <li><a href="{{ route('buyer.booking.list') }}"><i class="ti-more"></i>Booking List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Farmer-Buyer')
          <li class="treeview {{ ($prefix == '/bbookings')?'active':'' }}">
          <a href="#">
            <i data-feather="check-circle"></i>
            <span>Buyer Booking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('buyer.booking.view') }}"><i class="ti-more"></i>Make Booking </a></li>
            <li><a href="{{ route('buyer.booking.list') }}"><i class="ti-more"></i>Booking List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Farmer-Buyer')
          <li class="treeview {{ ($prefix == '/bookings')?'active':'' }}">
          <a href="#">
            <i data-feather="airplay"></i>
            <span>Farmer Booking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('booking.view') }}"><i class="ti-more"></i>Make Booking </a></li>
            <li><a href="{{ route('booking.list') }}"><i class="ti-more"></i>Booking List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='RC-Officer' )
        <li class="treeview {{ ($prefix == '/creport')?'active':'' }}">
          <a href="#">
            <i data-feather="file-plus"></i>
            <span>Summary Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ccentre.report.view') }}"><i class="ti-more"></i>Summary Report List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='EC-Officer' )
        <li class="treeview {{ ($prefix == '/ereport')?'active':'' }}">
          <a href="#">
            <i data-feather="file-plus"></i>
            <span>Summary Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ecentre.report.view') }}"><i class="ti-more"></i>Summary Report List </a></li>
          </ul>
        </li> 
        @endif
        @if(Auth::user()->role =='Admin' )
        <li class="treeview {{ ($prefix == '/areport')?'active':'' }}">
          <a href="#">
            <i data-feather="file-plus"></i>
            <span>Summary Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('app.setup') }}"><i class="ti-more"></i>Product Report </a></li>
            <li><a href="{{ route('app.check.view') }}"><i class="ti-more"></i>Economic Centre Report </a></li>
            <li><a href="{{ route('app.check.view') }}"><i class="ti-more"></i>Collection Centre Report </a></li>
          </ul>
        </li> 
        @endif

<!-- {{--         <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
            <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
            <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
            <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
            <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
          </ul>
        </li>  --}} -->		  
		 
<!-- {{--         <li class="header nav-small-cap">User Interface</li> --}}
		  
        {{-- <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
            <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
            <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li>
            <li><a href="components_dropdown.html"><i class="ti-more"></i>Dropdown</a></li>
            <li><a href="components_modals.html"><i class="ti-more"></i>Modal</a></li>
            <li><a href="components_nestable.html"><i class="ti-more"></i>Nestable</a></li>
            <li><a href="components_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li>
          </ul>
        </li> --}} -->
		
		<!-- {{-- <li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i>
            <span>Cards</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
			<li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
			<li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
		  </ul>
        </li>  
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="hard-drive"></i>
            <span>Content</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="content_typography.html"><i class="ti-more"></i>Typography</a></li>
            <li><a href="content_media.html"><i class="ti-more"></i>Media</a></li>
            <li><a href="content_grid.html"><i class="ti-more"></i>Grid</a></li>
          </ul>
        </li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="package"></i>
            <span>Utilities</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="utilities_border.html"><i class="ti-more"></i>Border</a></li>
            <li><a href="utilities_color.html"><i class="ti-more"></i>Color</a></li>
            <li><a href="utilities_ribbons.html"><i class="ti-more"></i>Ribbons</a></li>
            <li><a href="utilities_tab.html"><i class="ti-more"></i>Tabs</a></li>
            <li><a href="utilities_animations.html"><i class="ti-more"></i>Animation</a></li>
          </ul>
        </li>
		  
		<li class="treeview">
          <a href="#">
            <i data-feather="edit-2"></i>
            <span>Icons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="icons_fontawesome.html"><i class="ti-more"></i>Font Awesome</a></li>
            <li><a href="icons_glyphicons.html"><i class="ti-more"></i>Glyphicons</a></li>
            <li><a href="icons_material.html"><i class="ti-more"></i>Material Icons</a></li>	
            <li><a href="icons_themify.html"><i class="ti-more"></i>Themify Icons</a></li>
            <li><a href="icons_simpleline.html"><i class="ti-more"></i>Simple Line Icons</a></li>
            <li><a href="icons_cryptocoins.html"><i class="ti-more"></i>Cryptocoins Icons</a></li>
            <li><a href="icons_flag.html"><i class="ti-more"></i>Flag Icons</a></li>
            <li><a href="icons_weather.html"><i class="ti-more"></i>Weather Icons</a></li>
          </ul>
        </li> 
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="inbox"></i>
			<span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="forms_advanced.html"><i class="ti-more"></i>Advanced Elements</a></li>
            <li><a href="forms_editors.html"><i class="ti-more"></i>Editors</a></li>
            <li><a href="forms_code_editor.html"><i class="ti-more"></i>Code Editor</a></li>
            <li><a href="forms_validation.html"><i class="ti-more"></i>Form Validation</a></li>
            <li><a href="forms_wizard.html"><i class="ti-more"></i>Form Wizard</a></li>
            <li><a href="forms_general.html"><i class="ti-more"></i>General Elements</a></li>
            <li><a href="forms_dropzone.html"><i class="ti-more"></i>Dropzone</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i data-feather="server"></i>
			<span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="tables_simple.html"><i class="ti-more"></i>Simple tables</a></li>
            <li><a href="tables_data.html"><i class="ti-more"></i>Data tables</a></li>
          </ul>
        </li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="charts_chartjs.html"><i class="ti-more"></i>ChartJS</a></li>
            <li><a href="charts_flot.html"><i class="ti-more"></i>Flot</a></li>
            <li><a href="charts_inline.html"><i class="ti-more"></i>Inline</a></li>	
            <li><a href="charts_morris.html"><i class="ti-more"></i>Morris</a></li>
            <li><a href="charts_peity.html"><i class="ti-more"></i>Peity</a></li>
            <li><a href="charts_chartist.html"><i class="ti-more"></i>Chartist</a></li>
          </ul>
        </li>  
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="map"></i>
			<span>Map</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="map_google.html"><i class="ti-more"></i>Google Map</a></li>
            <li><a href="map_vector.html"><i class="ti-more"></i>Vector Map</a></li>
          </ul>
        </li> 			  
		  
		<li class="treeview">
          <a href="#">
            <i data-feather="alert-triangle"></i>
			<span>Authentication</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="auth_login.html"><i class="ti-more"></i>Login</a></li>
			<li><a href="auth_register.html"><i class="ti-more"></i>Register</a></li>
			<li><a href="auth_lockscreen.html"><i class="ti-more"></i>Lockscreen</a></li>
			<li><a href="auth_user_pass.html"><i class="ti-more"></i>Password</a></li>
			<li><a href="error_404.html"><i class="ti-more"></i>Error 404</a></li>
			<li><a href="error_maintenance.html"><i class="ti-more"></i>Maintenance</a></li>	
          </ul>
        </li> 	 --}}	  		  
		  
{{-- 		<li class="header nav-small-cap">EXTRA</li>		  
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="layers"></i>
			<span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Level One</a></li>
            <li class="treeview">
              <a href="#">Level One
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Level Two</a></li>
                <li class="treeview">
                  <a href="#">Level Two
                    <span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Level Three</a></li>
                    <li><a href="#">Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Level One</a></li>
          </ul>
        </li> --}}  
		  
{{-- 		<li>
          <a href="auth_login.html">
            <i data-feather="lock"></i>
			<span>Log Out</span>
          </a>
        </li> 
         --}} -->
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="{{ route('log-viewer::dashboard')}}" class="link" data-toggle="tooltip" title="" data-original-title="System logs" aria-describedby="tooltip92529" target="_blank"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a type="button" data-original-title="Logout" data-toggle="modal" data-target="#modal-center"><i class="ti-lock"></i></a>
	</div>
  </aside>
  <div class="modal center-modal fade " id="modal-center" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title">User Logout</h5>
            <a type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </a>
          </div>
          <div class="modal-body">
            <p>Are realy want to logout?</p>
          </div>
          <div class="modal-footer modal-footer-uniform">
            <a type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">Cancel</a>
            <a type="submit" href="{{ route('admin.logout') }}"  class="btn btn-rounded btn-success float-right">Logout</a>
          </div>
        </div>
      </div>
    </div>