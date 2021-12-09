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
.footer1 {
   width: 100%;
   background-color: #9534eb;
   color: white;
   text-align: center;
   font-size: 13px;
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
      @foreach($ccenter as $ccenter)
<p>Centre Location : {{ $ccenter->centre_name}}</p>
<p>Phone : {{ $ccenter->mobile}}</p>
<p>Email : {{ $ccenter->email}}</p>
      @endforeach
    </td> 
  </tr>
  
   
</table>

<div class="footer">
  <p><b>Inventory Transction Monthly Summary</b>(<span style="color:yellow;">{{$req_date}}</span>)</p>
</div>
<br>
<div class="footer1">
  <p><b>Registered Farmer's Inventory</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <th width="10%">Farmer's Name</th>
    <!-- <th>Economic Centre</th> -->
    <th>Date</th>
    <th>Order ID</th>
    <th>Invoice ID</th>
    <th>Vegitable</th>
    <th>Quntity(Kg)</th>
    <!-- <th>Price</th> -->
    <th>Inventory Create At</th>
  </tr>
  @foreach($book_inventories as $key => $inventory)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $inventory->name }}</td>
    <!-- <td>{{ $inventory->centre_name }}</td> -->
    <td>{{ $inventory->date }}</td>
    <td>{{ $inventory->order_id }}</td>
    <td>{{ $inventory->invoice_id }}</td>
    <td>{{ $inventory->vegname }}</td>
    <td>{{ $inventory->quntity }}</td>
<!--     <td>Rs. {{ number_format($inventory->price , 2) }}</td> -->
    <td>{{ $inventory->created_at}}</td>
  </tr>
  @endforeach
</table>
<br>
<div class="footer1">
   <p><b>UnRegistered Farmer's Inventory</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <th width="10%">Economic Centre</th>
    <th>Date</th>
    <th>Order ID</th>
    <th>Invoice ID</th>
    <th>Vegitable</th>
    <th>Quntity(Kg)</th>
    <!-- <th>Price</th> -->
    <th>Inventory Create At</th>
  </tr>
  @foreach($normal_inventories as $key => $inventory)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $inventory->centre_name }}</td>
    <td>{{ $inventory->date }}</td>
    <td>{{ $inventory->order_id }}</td>
    <td>{{ $inventory->invoice_id }}</td>
    <td>{{ $inventory->vegname }}</td>
    <td>{{ $inventory->quntity }}</td>
    <!-- <td>Rs. {{ number_format($inventory->price , 2) }}</td> -->
    <td>{{ $inventory->created_at}}</td>
  </tr>
  @endforeach
</table>
<br>
<div class="footer1">
   <p><b>Collection Centre to Economic Centre Transfer Inventory</b></p>
</div>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <th width="10%">Economic Centre</th>
    <th>Date</th>
    <th>Order ID</th>
    <th>Invoice ID</th>
    <th>Vegitable</th>
    <th>Quntity(Kg)</th>
    <!-- <th>Price</th> -->
    <th>Inventory Create At</th>
  </tr>
  @foreach($trans_inventories as $key => $inventory)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $inventory->centre_name }}</td>
    <td>{{ $inventory->date }}</td>
    <td>{{ $inventory->order_id }}</td>
    <td>{{ $inventory->invoice_id }}</td>
    <td>{{ $inventory->vegname }}</td>
    <td>{{ $inventory->quntity }}</td>
    <!-- <td>Rs. {{ number_format($inventory->price , 2) }}</td> -->
    <td>{{ $inventory->created_at}}</td>
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