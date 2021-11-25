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
</style>
</head>
<body>


<table id="customers">
  <tr>
   <td>
    <h2>
  <?php $image_path = '/upload/logo.png'; ?>
  <img src="{{ public_path() . $image_path }}" width="200" height="100">
    </h2>

  </td> 
    <td><h2>Easy SleAgro System</h2>
      @foreach($ecenter as $ecenter)
<p>Centre Location : {{ $ecenter->centre_name}}</p>
<p>Phone : {{ $ecenter->mobile}}</p>
<p>Email : {{ $ecenter->email}}</p>
      @endforeach
      
    </td> 
  </tr>
</table>



<table id="customers">
  <tr>
    <th width="10%">SN</th>
    <!-- <th>Photo</th> -->
    <th>Name</th>
    <th>Quntity(KG)</th>
  </tr>
  @foreach(json_decode($products) as $product)
  <tr>
    <td>{{ $product->id }}</td>
     <td>{{ $product->name }}</td>
     <td>{{ $product->quntity }}</td>
  </tr>
  @endforeach
</table>
<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

</body>
</html>