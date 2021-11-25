@component('mail::message')
<h1>SleAgro System Vegitable Selling payment conformation to Buyer</h1>

<br>
     <p style="text-align: center;">you have paid <b>Rs.{{ $data["net_payment"] }}.00</b> to <b>{{ $data["name"] }} Economic Centre</b>.</p>
<br>
<b> Invoice No :  </b><span style="color:red;">{{ $data["invoice_id"] }} </span> 
<br>
<b>Order Id :  </b><span style="color:red;">{{ $data["order_id"] }} </span>
<br>
<b> Date :  </b><span style="color:red;">{{ $data["date"] }}</span> 
</br></br>
  
  <p style="text-align: center;">Thank you !!.Come agian to get fresh vegitable in reasonble price</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login','color' => 'green'])
More Order 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
