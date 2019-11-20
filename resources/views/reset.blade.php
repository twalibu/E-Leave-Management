<!DOCTYPE html>
<html>

<head>
    <title>e-Leave | Reset Password</title>
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
                        <form action="" autocomplete="on" method="post" role="form" id="login_form">
                            <h3 class="black_bg">
                                <img src="{{ asset('images/e-leave.png') }}" alt="exodias logo">
                                <br>Reset Password</h3>
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            @if(count($errors)>0)
                                <div style="border-radius: 0px;" class="alert alert-danger">
                                   @foreach($errors->all() as $error)
                                       <li>{{$error}}</li>
                                       @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <label style="margin-bottom:0px;" for="password" class="uname control-label"> <i class="livicon"
                                                                                                                 data-name="key"
                                                                                                                 data-size="16"
                                                                                                                 data-loop="true"
                                                                                                                 data-c="#3c8dbc"
                                                                                                                 data-hc="#3c8dbc"></i>
                                    Password
                                </label>
                                <input id="password" name="password" type="password" placeholder="password" required/>

                            </div>
                            <div class="form-group">
                                <label style="margin-bottom:0px;" for="confirm-password" class="youpasswd"> <i class="livicon"
                                                                                                       data-name="key"
                                                                                                       data-size="16"
                                                                                                       data-loop="true"
                                                                                                       data-c="#3c8dbc"
                                                                                                       data-hc="#3c8dbc"></i>
                                    confirm Password
                                </label>
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="confirm password" required/>

                            </div>

                            <p class="login button">
                                <input type="submit" value="Reset" class="btn btn-success"/>
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