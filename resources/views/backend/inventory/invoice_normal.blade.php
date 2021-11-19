@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
<!-- 		<div class="content-header">
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
		</div>  --> 

		<!-- Main content -->
		<section class="invoice printableArea">
			
			  <!-- title row -->
			  <div class="row">
				<div class="col-12">
				  <div class="bb-1 clearFix">
					<div class="text-right pb-15">
						<a class="btn btn-rounded btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span> </a>
						<a id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </a>
					</div>	
				  </div>
				</div>
				<div class="col-12">
				  <div class="page-header">
					<h2 class="d-inline"><span class="font-size-30">Normal Selling Invoice</span></h2>
					<div class="pull-right text-right">
						<h3>{{ date('d F Y') }}</h3>
					</div>	
				  </div>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- info row -->
			  <div class="row invoice-info">
			  	@foreach($ccenter as $key => $ccenter)
				<div class="col-md-6 invoice-col">
				  <strong>From</strong>	
				  <address>
					<strong class="text-blue font-size-24">{{ $ccenter->centre_name }} Collection Centre</strong><br>
					<strong class="d-inline">{{ $ccenter->address }}</strong><br>
					<strong>Phone: {{ $ccenter->mobile }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $ccenter->email }}</strong>  
				  </address>
				</div>
				@endforeach
				<!-- /.col -->
				<div class="col-md-6 invoice-col text-right">
				  <!-- <strong>To</strong>
				  <address>
					<strong class="text-blue font-size-24">Doe Shina</strong><br>
					124 Lorem Ipsum, Suite 478, Dummuy, USA 123456<br>
					<strong>Phone: (00) 789-456-1230 &nbsp;&nbsp;&nbsp;&nbsp; Email: conatct@example.com</strong>
				  </address> -->
				</div>
				<!-- /.col -->
				<div class="col-sm-12 invoice-col mb-15">
					<div class="invoice-details row no-margin">
					  <div class="col-md-6 col-lg-3"><b>Invoice: </b>{{$order_id}}</div>
					  <div class="col-md-6 col-lg-3"><b>Order ID:</b> {{$invoice_id}}</div>
					  <div class="col-md-6 col-lg-3"><b>Payment Due:</b> {{ date('d/m/Y') }}</div>
					  <div class="col-md-6 col-lg-3"><b>Bank Account:</b> N/A</div>
					</div>
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
					  <th>No</th>
					  <th>Description</th>
					  <th class="text-right">Quantity(Kg)</th>
					  <th class="text-right">Unit Cost</th>
					  <th class="text-right">Subtotal</th>
					</tr>
					@foreach($orders as $key => $order)
					<tr>
					  <td>{{ $key+1 }}</td>
					  <td>{{ $order->name }}</td>
					  <td class="text-right">{{ $order->quntity }}</td>
					  <td class="text-right">{{ $order->price_wholesale }}</td>
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
						<p>Service Charge (5%)  :RS. {{number_format(($price->total/100)*5,2)}}</p>
					</div>
					<div class="total-payment">
						<h3><b>Total :</b>RS.{{number_format(($price->total -($price->total/100)*5),2)}}</h3>
						@endforeach
					</div>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->

			  <!-- this row will not appear when printing -->
			  <div class="row no-print">
				<div class="col-12">
				  <a type="submit" class="btn btn-rounded btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
				  </a>
				</div>
			  </div>
				
		</section>
		<!-- /.content -->
	  </div>
  </div>
@endsection