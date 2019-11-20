@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    setting

@stop




{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('admin/css/pages/advmodals.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/jquery-ui.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/vendors/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('admin/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet"/>


@stop

{{-- Page content --}}



@section('content')

    <div class="modal fade pullDown " id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="text-align: center" class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelnews">Edit Designation</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row ">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-12">
                                <div style="float: left;line-height: 60px"
                                     class="col-md-3 ">
                                    <label for="size">DESIGNATION</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input autocomplete="off" type="text" class=" form-control"
                                           id="des" name="des"
                                           style="resize: none;padding-left: 2%;width: 100%;border-radius: 0">

                                    <input type="text" class="hidden form-control"
                                           id="des_id" name="des_id">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button style="float:left;" class="btn btn-flat button1-3d btn-raised btn-danger" data-dismiss="modal">CLOSE</button>
                    <button style="background: #418BCA" class="btn btn-flat button-3d pull-right btn-raised edit_des" type="button"
                            data-toggle="modal" >EDIT
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="content-header">
        <!--section starts-->
        <h1>Settings</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">Settings</a>
            </li>
        </ol>
    </section>

    <!--section ends-->
    <section class="content">


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-success filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Setting Option
                        </h3>
                    </div>

                    <div class="new_year panel-body">
                        <h3>Start a new calendar year</h3>
                        <form action="" method="post">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">ALLOW LEAVE</label>
                                    </div>
                                    <div class="col-md-4 ">
                                        {{csrf_field()}}
                                        <input autocomplete="off" type="number" class=" form-control"
                                               id="day" name="day"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               placeholder=" days" required>
                                    </div>
                                </div>
                                <div  class="checkbox checkbox-success checkbox-inline col-md-4 col-md-offset-3">
                                    <div style="margin-left: 25px;">
                                        <input type="checkbox" name="checkbox" id="inlineCheckbox2" value="1" >
                                        <label for="inlineCheckbox2"> Delete Application Archive </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <button class="btn btn-flat button-3d pull-right btn-raised btn-success start">Start
                                </button>
                            </div>
                        </form>

                        <div style="margin-top: 4%;" class="col-md-12 col-xs-12">
                            <p style="opacity: .6;">Important Note: It will remove all the leave record of this year but
                                all the application will remain safe if checkbox is unchecked.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Setting Option
                        </h3>
                    </div>

                    <div class="add_des panel-body">

                        <h3>Add New Designation</h3>
                        <form action="" method="post">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">DESIGNATION</label>
                                    </div>
                                    <div class="col-md-4 ">
                                        {{csrf_field()}}
                                        <input  autocomplete="off" type="text" class=" form-control"
                                               id="designation" name="designation"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">

                                <button style="background: #418BCA"
                                        class="btn btn-flat button-3d pull-right btn-raised btn-primary add">Add
                                </button>
                            </div>
                        </form>



                    <div style="margin-top: 3em" class="row">
                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($des as $key=>$value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->designation}}</td>
                                    <td>{{$value->created_at}}</td>
                                    <td>{{$value->updated_at}}</td>
                                    <td style="padding-left: 3%;">

                                        <form action="" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <a style="padding-top:0" data-toggle="modal"  href="#modal-4" id="{{$value->id}}" name="{{$value->designation}}" class="edit">
                                                <i title="edit " style="color:royalblue;font-size:20px;" class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <a style="padding-top:0;margin-left: 1em;" href="#" id="{{$value->id}}" class="delete">
                                                <i title="delete " style="color:red;font-size:20px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>



                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Setting Option
                        </h3>
                    </div>

                    <div class="add_des panel-body">
                        <h3>SMTP Setting</h3>
                        <form action="" method="post">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_DRIVER</label>
                                    </div>
                                    <div class="col-md-4 ">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="driver" name="driver"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_HOST</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="host" name="host"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_PORT</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="port" name="port"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_USERNAME </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="username" name="username"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_PASSWORD</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="password" name="password"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="float: left;line-height: 60px"
                                         class="col-md-3 ">
                                        <label for="size">MAIL_ENCRYPTION</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" class=" form-control"
                                               id="enc" name="enc"
                                               style="resize: none;padding-left: 2%;width: 100%;border-radius: 0"
                                               required>
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-7">

                                <button style="background: #EF6F6C;"
                                        class="btn btn-flat button-3d-danger pull-right btn-raised update hidden">Update
                                </button>
                                <button class="btn btn-flat button-3d-default pull-right btn-raised cancel hidden">
                                    Cancel
                                </button>
                                <button style="background: #67C5DF;"
                                        class="btn btn-flat button-3d pull-right btn-raised btn-info show">Show
                                </button>
                                <button class="btn btn-flat button-3d-danger pull-right btn-raised reset ">Reset
                                </button>

                            </div>
                        </form>
                        <div style="margin-top: 4%;" class="col-md-12 col-xs-12">
                            <p style="opacity: .6">Important Note: For Gmail Configaration<br>1.Go to the "Less secure apps" section in My Account.<br>
                               2. Next to "Access for less secure apps," select Turn on. (Note to G Suite users: This setting is hidden if your administrator has locked less secure app account access.)</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </section>

    <script type="text/javascript" src="{{ asset('admin/vendors/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/setting.js')}}"></script>
    <script>


    </script>
@stop











