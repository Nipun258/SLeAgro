@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Invoice</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Invoice</li>s
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>  

		<!-- Main content -->
		<section class="invoice printableArea">
			
			  <!-- title row -->
			  <div class="row">
				<div class="col-12">
			<form method="POST" action="{{ route('transfer.payment.store') }}" class="contact-form">
		     @csrf
				  <div class="bb-1 clearFix">
					<div class="text-right pb-15">
						<a class="btn btn-rounded btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span> </a>
						<a id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </a>
					</div>	
				  </div>
				</div>
				<div class="col-12">
				  <div class="page-header">
					<h2 class="d-inline"><span class="font-size-30">Product Transfer Invoice</span></h2>
					<div class="pull-right text-right">
						<h3>{{ date('d F Y') }}</h3>
					</div>	
				  </div>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- info row -->
			  <div class="row invoice-info">
				<div class="col-md-6 invoice-col">
				@foreach($ccenter as $key => $ccenter)
				  <strong class="text-danger">From</strong>	
				  <address>
					<strong class="text-blue font-size-24">{{ $ccenter->centre_name }} Collection Centre</strong><br>
					<strong class="d-inline">{{ $ccenter->address }}</strong><br>
					<strong>Phone: {{ $ccenter->mobile }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $ccenter->email }}</strong>  
				  </address>
				  <input type="hidden" name="to" value="{{$ccenter->id}}">
				  <input type="hidden" name="ccentre" value="{{$ccenter->centre_name}}">
				</div>
				@endforeach
				<!-- /.col -->
				<div class="col-md-6 invoice-col text-right">
				@foreach($ecenter as $key => $ecenter)
				  <strong class="text-danger">To</strong>
				  <address>
					<strong class="text-blue font-size-24">{{ $ecenter->centre_name}} Economic Centre</strong><br>
					{{ $ecenter->address}}<br>
					<strong>Phone: {{ $ecenter->mobile }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $ecenter->email }}</strong>
				  </address>
				  <input type="hidden" name="from" value="{{ $ecenter->id}}">
				  <input type="hidden" name="email" value="{{ $ecenter->email }}">
				  <input type="hidden" name="ecentre" value="{{$ecenter->centre_name}}">
				</div>
				@endforeach
				<!-- /.col -->
				<div class="col-sm-12 invoice-col mb-15">
					<div class="invoice-details row no-margin">
					  <div class="col-md-6 col-lg-3"><b>Invoice </b>{{$order_id}}</div>
					  <div class="col-md-6 col-lg-3"><b>Order ID:</b> {{$invoice_id}}</div>
					  <div class="col-md-6 col-lg-3"><b>Payment Due:</b> {{ date('d/m/Y') }}</div>
					  <div class="col-md-6 col-lg-3"><b>Account:</b> N/A</div>
					</div>
					<input type="hidden" name="invoice_id" value="{{$invoice_id}}">
					<input type="hidden" name="order_id" value="{{$order_id}}">
				</div>
				
			  <!-- /.col -->
			  </div>
			  <!-- /.row -->

			  <!-- Table row -->
			  <div class="row">
				<div class="col-12 table-responsive">
				  <table class="table table-bordered">
					<tbody>
					<tr>
					  <th>#</th>
					  <th>Description</th>
					  <th class="text-right">Quantity(Kg)</th>
					  <th class="text-right">Vegitable Price(p/Kg)</th>
					  <th class="text-right">Subtotal</th>
					</tr>
					@foreach($orders as $key => $order)
					<tr>
					  <td>{{ $key+1 }}</td>
					  <td>{{ $order->name }}</td>
					  <td class="text-right">{{ $order->quntity }}</td>
					  <td class="text-right">Rs. {{ number_format($order->price_wholesale , 2) }}</td>
					  <td class="text-right">{{ $order->price }}</td>
					</tr>
					@endforeach
					</tbody>
				  </table>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->

			  <div class="row">
				<div class="col-12 text-right">
					<p class="lead"><b>Payment Due</b><span class="text-danger"> {{ date('d/m/Y') }} </span></p>

					<div>
						@foreach($total_price as $price)
						<p>Sub - Total amount  :RS.{{number_format($price->total,2)}}</p>
						<p>Service Charge (0%)  :RS. {{number_format(($price->total/100)*0,2)}}</p>
					</div>
					<div class="total-payment">
						<h3><b>Total :</b>RS.{{number_format($price->total,2)}}</h3>
						<input type="hidden" name="total_payment" value="{{$price->total}}">
						<input type="hidden" name="net_payment" value="{{$price->total -($price->total/100)*0}}">
						@endforeach
					</div>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->

			  <!-- this row will not appear when printing -->
			  <div class="row no-print">
				<div class="col-12">
				  <input type="submit" class="btn btn-rounded btn-success pull-right" value="Submit Payment">
				</div>
			  </div>
				</form>
		</section>
		<!-- /.content -->
	  </div>
  </div>
@endsection