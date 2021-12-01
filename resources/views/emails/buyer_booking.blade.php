@component('mail::message')
<h1>Welcome SleAgro Agricultural Product Management System </h1>
Dear {{ $data["name"] }} ,
<br>
       you need come economic Centre to collect your Harvest  .
<br>
<b>Booking Date :  </b><span style="color:red;">{{ $data["date"] }}</span>
<br>
<b>Booking Location :  </b><span style="color:red;">{{ $data["location"] }}</span> Economic Centre

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login','color' => 'green'])
View Booking Item
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
