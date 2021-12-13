<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
.footer {
   width: 100%;
   background-color: #3232a8;
   color: white;
   text-align: center;
   font-size: 15px;
}
@page { margin: 20px 30px 40px 50px; }
@page {
  footer: page-footer;
  border: 1px solid red;
}

</style>
</head>
<body>


<table id="customers">
  <tr>
   <td><h2>
  <?php $image_path = '/upload/logo.png'; ?>
  <img src="{{ public_path() . $image_path }}" width="200" height="100">

    </h2></td> 
    <td><h2>Easy SleAgro System</h2>
      @foreach($farmer as $farmer)
<p>Name : {{ $farmer->name}}</p>
<p>Phone : {{ $farmer->mobile}}</p>
<p>Email : {{ $farmer->email}}</p>
<p>Collection Centre : {{ $farmer->centre_name}}</p>
    @endforeach
    </td> 
  </tr>
  
   
</table>

<div class="footer">
  <p><b>Farmer Payment List </b>(<span style="color:yellow;">{{$req_month}}</span>)</p>
</div>
<br>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <th>Date</th>
    <th>Order ID</th>
    <th>Invoice ID</th>
    <th>Total Payment</th>
    <th>Payment Type</th>
  </tr>
  @foreach(json_decode($payments) as $key => $payment)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $payment->date }}</td>
    <td>{{ $payment->order_id }}</td>
    <td>{{ $payment->invoice_id }}</td>
    <td>Rs. {{ number_format($payment->net_payment , 2) }}</td>
    @if($payment->payment_type == 1)
    <td>Bank Payment</td>
    @else
    <td>Cash Payment</td>
    @endif
  </tr>
  @endforeach
</table>
<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
<htmlpagefooter name="page-footer">
  <table width="100%">
    <tr>
        <td width="33%">{DATE d M Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">SL e Agro</td>
    </tr>
</table>
</htmlpagefooter>
</body>
</html>