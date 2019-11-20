<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('images/fevicon.png') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->

    <link rel="stylesheet" type="text/css" href="{{ asset('logins/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('logins/css/bootstrapValidator.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('logins/css/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('logins/css/blue.css') }}">

    <style>
        @-webkit-keyframes autofill {
            to {
                color: #666;
                background: transparent;
            }
        }

        input:-webkit-autofill {
            -webkit-animation-name: autofill;
            -webkit-animation-fill-mode: both;
        }
    </style>


</head>

<body>
<div class="container">
    <div class="row vertical-offset-100">


        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">

                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="{{route('login')}}" autocomplete="on" method="post" role="form" id="login_form">
                            <h3 class="black_bg">
                                <img src="{{ asset('images/e-leave.png') }}" alt="exodias logo">
                                <br>Apply for Leave</h3>
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            @if(session('error'))
                                <div style="border-radius: 0px;" class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif

                            @if(session('success'))
                                <div style="border-radius: 0px;" class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif

                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                <label style="margin-bottom:0px;" for="email" class="uname control-label"> <i
                                            class="livicon" data-name="mail" data-size="16" data-loop="true"
                                            data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                    E-mail
                                </label>
                                <input id="email" name="email" type="email" placeholder="E-mail"
                                       value="{!! old('email') !!}"/>
                                <div class="col-sm-12">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                <label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon"
                                                                                                       data-name="key"
                                                                                                       data-size="16"
                                                                                                       data-loop="true"
                                                                                                       data-c="#3c8dbc"
                                                                                                       data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input id="password" name="password" type="password" placeholder="Enter a password"/>
                                <div class="col-sm-12">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="remember_me" id="remember_me" value="remember_me"
                                           class="square-blue"/>
                                    Keep me logged in
                                </label>
                            </div>
                            <p class="login button">
                                <input type="submit" value="Log In" class="btn btn-success"/>
                            </p>
                            <p class="change_link">
                                <a href="{{url('forgot-password')}}">
                                    <button type="button"
                                            class="btn btn-responsive botton-alignment btn-warning btn-sm">Forgot
                                        password
                                    </button>
                                </a>
                            </p>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script type="text/javascript" src="{{ asset('logins/js/jquery-1.11.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/jquery-1.11.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/bootstrapValidator.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/raphael-min.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/livicons-1.4.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/icheck.js') }}"></script>

<script type="text/javascript" src="{{ asset('logins/js/login.js') }}"></script>


</body>
</html>