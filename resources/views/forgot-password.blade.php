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

                    <div id="login"  class="animate form">
                        <form action="{{url('get-password')}}" autocomplete="on" method="post" role="form" id="reset_pw">
                            <h3 class="black_bg">
                                <img src="{{ asset('images/e-leave.png') }}" alt="exodias logo">
                                Forgot Password</h3>
                            <p>
                                Enter your email address below and we'll send password to your E-mail.
                            </p>

                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            @if(session('success'))
                                <div style="border-radius: 0px;" class="alert alert-success">
                                    {{session('success')}}
                                </div>
                                @elseif(session('error'))
                                    <div style="border-radius: 0px;" class="alert alert-danger">
                                        {{session('error')}}
                                    </div>
                            @endif

                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                <label style="margin-bottom:0px;" for="emailsignup1" class="youmai">
                                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc"
                                       data-hc="#3c8dbc"></i>
                                    Your email
                                </label>
                                <input id="email" name="email" required type="email" placeholder="your@mail.com"
                                       value="{!! old('email') !!}"/>
                                <div class="col-sm-12">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <p class="login button">
                                <input type="submit" value="Get Password" class="btn btn-success"/>
                            </p>
                            <p class="change_link">
                                <a href="/" class="to_register">
                                    <button type="button"
                                            class="btn btn-responsive botton-alignment btn-warning btn-sm">Back
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