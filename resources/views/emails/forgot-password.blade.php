@extends('emails/layouts/default')

@section('content')
    <p>Hello {!! $user->userName !!},</p>

    <p>Welcome to e-Leave! Please click on the following link to reset your e-Leave password</p>

    <p><a href="{{config('app.url')}}/reset-password/{{$user->email}}/{{$code}}">reset password</a></p>

    <p>Best regards,</p>

@stop
