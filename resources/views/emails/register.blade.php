@component('mail::message')
<h1>Welcome SleAgro Agricultural Product Management System </h1>

you can loging to the system using following credetail .

<b>User name : </b> {{ $data["email"] }}
<br> 
<b>password :  </b>{{ $data["password"] }}
<br>
<b>Account Type :  </b>{{ $data["role"] }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
