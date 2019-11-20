@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    create user

@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{asset('css/css-loader.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link href="{{ asset('admin/css/jquery-ui.css') }}"
          rel="stylesheet">
    <link href="{{ asset('admin/css/pages/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/advmodals.css') }}" rel="stylesheet"/>
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
    <!-- end of page level css-->
@stop

{{-- Page content --}}



@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Leave Archive</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">Create User</a>
            </li>
        </ol>
    </section>

    <!--section ends-->
    <section class="content">


        <div  class="row">
            <div class="col-md-12">
                <div class="panel panel-success filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Create User
                        </h3>
                    </div>

                    <div class="panel-body">
                        <form class="create_user">


                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-11">
                                @if(Sentinel::inRole('admin'))
                                    <div class="form-group form-inline ">
                                        <div class="row div1">
                                            <div style="float: left;line-height: 60px"
                                                 class="col-md-3 ">
                                                <label for="size">Username  </label>
                                            </div>
                                            <div class="col-md-9 ">
                                                <input autocomplete="off" type="text" class=" form-control"
                                                       id="username" name="username"
                                                       style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                                       placeholder="username" required>
                                            </div>
                                        </div>
                                        <select class="form-control hidden" id="sel2">
                                            <option value="User">User</option>
                                        </select>

                                    </div>

                                @else
                                    <div class="row div1">


                                        <div style="float: left;line-height: 60px"
                                             class="col-md-3 ">
                                            <label for="size">Username  </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input autocomplete="off" class=" form-control" style="width: 100%;border-radius: 0"
                                                   id="username" name="username"
                                                   placeholder="username" required>

                                        </div>


                                        <div style="float: left;line-height: 60px;"
                                             class="col-md-2 ">
                                            <label for="size">Type  </label>
                                        </div>
                                        <div class="col-md-4 ">
                                            <select name="user" class="form-control" id="user" style="border-radius: 0">
                                                <option value="" hidden selected disabled >Select</option>
                                                <option value="Authority">Authority</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>


                                    </div>

                                @endif
                                <div class="row div2">


                                    <div style="float: left;line-height: 60px" class="col-md-3 ">
                                        <label for="size">Full Name  </label>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input autocomplete="off" class=" form-control" style="width: 100%;border-radius: 0"
                                               id="english" name="english"
                                               placeholder="name" required>

                                    </div>

                                </div>
                                    <div class="row div8">


                                        <div style="float: left;line-height: 60px" class="col-md-3">
                                            <label for="size">Date of birth  </label>
                                        </div>
                                        <div class="col-md-3 ">
                                            <input readonly="true" type="text" autocomplete="off" class=" form-control" style="width: 100%;border-radius: 0;background:white"
                                            id="date" name="date" required placeholder="mm/dd/yyyy">

                                        </div>


                                        <div style="float: left;line-height: 60px;" class="col-md-2 ">
                                            <label for="size">Gender  </label>
                                        </div>
                                        <div style="line-height: 60px;" class="col-md-4 col-sm-12 col-xs-12">

                                                <label for="male">Male</label>&nbsp &nbsp;
                                                <input type="radio" name="gender" id="male" value="male" checked>
                                                 &nbsp &nbsp &nbsp &nbsp;
                                                <label for="female">Female</label>&nbsp &nbsp;
                                                <input type="radio" name="gender" id="female" value="female">

                                        </div>


                                    </div>
                                <div class="row div3">


                                    <div style="float: left;line-height: 60px" class="col-md-3 ">
                                        <label for="size">Phone No  </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input autocomplete="off" class=" form-control" style="width: 100%;border-radius: 0"
                                               id="phone" name="phone"
                                               placeholder="phone no" required>

                                    </div>


                                    <div style="float: left;line-height: 60px;" class="col-md-2">
                                        <label for="size">Designation  </label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="clas" class="form-control" id="clas" style="border-radius: 0">
                                            <option value="" hidden selected disabled>select</option>
                                            @foreach($info as $data)
                                              <option value="{{$data->designation}}">{{$data->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>

                                <div class="form-group form-inline ">
                                    <div class="row div4">
                                        <div style="float: left;line-height: 60px"
                                             class="col-md-3 ">
                                            <label for="size">Address  </label>
                                        </div>
                                        <div class="col-md-9 ">
                                            <input autocomplete="off" type="text" class=" form-control" id="address"
                                                   name="address" style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                                   placeholder="address" required>
                                        </div>
                                    </div>


                                </div>

                                    <div class="row div3">


                                        <div style="float: left;line-height: 60px" class="col-md-3 ">
                                            <label for="size">Email  </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input autocomplete="off" type="email" class=" form-control" id="email"
                                                   name="email" style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                                   placeholder=" email" required>

                                        </div>


                                        <div style="float: left;line-height: 60px;" class="col-md-3">
                                            <label for="size">Estimate Leave  </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" autocomplete="off" class=" form-control" style="width: 100%;border-radius: 0"
                                                   id="leave" name="leave"
                                                   placeholder=" days"  required>
                                        </div>


                                    </div>
                                <div class="form-group form-inline ">
                                    <div class="row div6">
                                        <div style="float: left;line-height: 60px"
                                             class="col-md-3 ">
                                            <label for="size">Password  </label>
                                        </div>
                                        <div class="col-md-9 ">
                                            <input autocomplete="off" type="password" class=" form-control"
                                                   id="password" name="password"
                                                   style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                                   placeholder="password" required>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group form-inline ">
                                    <div class="row div7">
                                        <div style="float: left;line-height: 60px"
                                             class="col-md-3 ">
                                            <label for="size">Confirm Password  </label>
                                        </div>
                                        <div class="col-md-9 ">
                                            <input autocomplete="off" type="password" class=" form-control"
                                                   id="password1" name="password1"
                                                   style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                                   placeholder="confirm password" required>
                                        </div>


                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-9 col-md-offset-3 wrong">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button class="btn btn-flat button-3d pull-right btn-raised btn-success create"
                                            type="submit">CREATE
                                    </button>


                                </div>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="loader loader-default" data-text="sending mail for verification . . ." data-blink></div>
    </section>


    <script type="text/javascript" src="{{ asset('jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('js/create_user.js')}}"></script>

@stop











