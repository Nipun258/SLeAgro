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
   background-color: #660033;
   color: white;
   text-align: center;
   font-size: 15px;
}
img {
  border-radius: 50%;
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
  <p><b>Current System User List</b></p>
</div>
<br>
<div class="footer1">
  <p><b>Current Economic Centre List</b></p>
</div>
<table id="customers">
  <tr>
    <th width="10%">SN</th>
    <th>Centre Name</th>
    <th>Province</th>
    <th>District</th>
    <th>City</th>
  </tr>
  @foreach($ecentres as $key => $ecentre)
  <tr>
    <td>{{ $key+1 }}</td>
     <td>{{ $ecentre->centre_name }}</td>
     <td>{{ $ecentre->pname }}</td>
     <td>{{ $ecentre->dname }}</td>
     <td>{{ $ecentre->cname }}</td>
  </tr>
  @endforeach
</table>
<br>
<div class="footer1">
  <p><b>Current Collection Centre List</b></p>
</div>
<table id="customers">
  <tr>
    <th width="10%">SN</th>
    <th>Centre Name</th>
    <th>Province</th>
    <th>District</th>
    <th>City</th>
  </tr>
  @foreach($ccentres as $key => $ccentre)
  <tr>
    <td>{{ $key+1 }}</td>
     <td>{{ $ccentre->centre_name }}</td>
     <td>{{ $ccentre->pname }}</td>
     <td>{{ $ccentre->dname }}</td>
     <td>{{ $ccentre->cname }}</td>
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