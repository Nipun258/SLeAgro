@component('mail::message')
<h1>SleAgro System Vegitable Transfer payment Economic Centre to Collection Centre</h1>

<br>
     <p style="text-align: center;">We have payment account number <b>{{ $data["ccentre"] }} Collection Centre </b> to <b>{{ $data["ecentre"] }} Economic Centre </b>.</p>
<br>
<b> Tatal payment :  </b><span style="color:red;">Rs.{{ $data["net_payment"] }}.00 </span> 
<br>
<b> Invoice No :  </b><span style="color:red;">{{ $data["invoice_id"] }} </span> 
<br>
<b>Order Id :  </b><span style="color:red;">{{ $data["order_id"] }} </span>
<br>
<b> Date :  </b><span style="color:red;">{{ $data["date"] }}</span> 
</br></br>
  
  <p style="text-align: center;">Thank you !!</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login','color' => 'green'])
More Order 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
