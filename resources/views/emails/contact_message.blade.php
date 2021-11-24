@component('mail::message')
<h1>{{ $data["subject"] }} </h1>

The system admin reply your question ,
<br> 
{{ $data["subject"] }} <b>Related Replay</b>

<b>Meassage Reply :  </b>{{ $data["meassage"] }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/register','color' => 'green'])
Register Our Web App
@endcomponent

Thanks,<br>
{{ config('app.name') }}
{{ $data["date"] }}
@endcomponent
