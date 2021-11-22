@component('mail::message')
<h1>Welcome SleAgro Agricultural Product Management System </h1>

<br>
       <p style="text-align: center;">There is Vegetable stoke transfered.For more detial visit our SleAgro System .</p>
<br>
<b>Transfer From :  </b><span style="color:red;">{{ $data["from"] }} Collection Centre</span> 
<br>
<b>Transfer To :  </b><span style="color:red;">{{ $data["to"] }} Economic Centre</span>
<br>
<b>Transfer Date :  </b><span style="color:red;">{{ $data["date"] }}</span> 

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login','color' => 'green'])
ViSit 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent