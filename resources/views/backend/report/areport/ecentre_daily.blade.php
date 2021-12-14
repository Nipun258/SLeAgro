e<!DOCTYPE html>
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
.footer1 {
   width: 100%;
   background-color: #3232a8;
   color: white;
   text-align: center;
   font-size: 15px;
}
.footer2 {
   width: 100%;
   background-color: #009999;
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
      @foreach($admin as $admin)
<p>System Administrator</p>
<p><b>Department of Agriculture</b></p>
<p>Phone : {{ $admin->mobile}}</p>
<p>Email : {{ $admin->email}}</p>
      @endforeach
    </td> 
  </tr>
  
   
</table>

<div class="footer">
  <p><b>Economic Centre Summary Report</b>(<span style="color:yellow;">{{$req_date}}</span>)</p>
  <h2>{{$ecentre}} Econimic Centre</h2>
</div>
<br>
<div class="footer2">
  <p><b>Register Buyer Payment Summary</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <!-- <th>Image</th> -->
    <th>Vegitable</th>
    <th>Vegitable Stock(Kg)</th>
    <th>Total Earn Money (Rs.)</th>
  </tr>
  @foreach($payment_registers as $key => $payment)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $payment->name }}</td>
    <td>{{ $payment->total }}</td>
    <td>Rs. {{ number_format($payment->count , 2) }}</td>
  </tr>
  @endforeach
</table>
<br>
<div class="footer2">
  <p><b>Register Buyer Payment Summary</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <!-- <th>Image</th> -->
    <th>Vegitable</th>
    <th>Vegitable Stock(Kg)</th>
    <th>Total Earn Money (Rs.)</th>
  </tr>
  @foreach($payment_normals as $key => $payment)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $payment->name }}</td>
    <td>{{ $payment->total }}</td>
    <td>Rs. {{ number_format($payment->count , 2) }}</td>
  </tr>
  @endforeach
</table>
<br>
<div class="footer2">
  <p><b>Retials Distribution Payment Summary</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <!-- <th>Image</th> -->
    <th>Vegitable</th>
    <th>Vegitable Stock(Kg)</th>
    <th>Total Earn Money (Rs.)</th>
  </tr>
  @foreach($payment_transfers as $key => $payment)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $payment->name }}</td>
    <td>{{ $payment->total }}</td>
    <td>Rs. {{ number_format($payment->count , 2) }}</td>
  </tr>
  @endforeach
</table>
<br> <br>
<div class="footer1">
  <p>{{date("Y F d", strtotime($req_date))}} Economic Centre Total Payment Recived  <span style="color:yellow;font-size: 25px;font-weight: bold;">Rs. {{ number_format($ecentre_income , 2)}}</span></p>
</div>
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