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
  <p><b>Booking List </b>(<span style="color:yellow;">{{$req_month}}</span>)</p>
</div>
<br>
<table id="customers">
  <tr>
    <th width="5%">SN</th>
    <th>Date</th>
    <th>Time</th>
    <th>Booking Create At</th>
    <th>Status</th>
  </tr>
  @foreach($mybookings as $key => $mybooking)
  <tr>
    <td>{{ $key+1 }}</td>
    <td>{{ $mybooking->date }}</td>
    <td>{{ $mybooking->time}}</td>
    <td>{{ $mybooking->created_at}}</td>
    @if($mybooking->status == 0)
    <td style="color: red;">Not Visit</td>
    @elseif($mybooking->status == 1)
    <td style="color: blue;">Visited</td>
    @elseif($mybooking->status == 2)
    <td style="color: green;">Completed</td>
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