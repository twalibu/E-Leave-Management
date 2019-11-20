@extends('emails/layouts/default')

@section('content')
<p>Hello {!! $user->userName !!},</p>


password:{{$password}}<br>

<br>
<p>Welcome to e-Leave! Please click on the following link to active your e-Leave account:</p>

<p><a href="{{env('APP_URL')}}/E-LeaveManagement/public/activate/{{$user->email}}/{{$code}}">activate account</a></p>

<p>Best regards,</p>

@stop
