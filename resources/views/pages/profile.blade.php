@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    profile

@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('admin/css/jquery-ui.css') }}"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/profile.css') }}"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>

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

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <!--section starts-->
        @if(Sentinel::getUser()->id==$user->id)
            <h1>My Profile</h1>
        @else
            <h1>User Profile</h1>
        @endif
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Profile</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <?php
        $members =Sentinel::findById($user->id)->roles()->get();
        foreach ($members as $use) {
            $role = $use->name;
        }

        ?>

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if(Sentinel::getUser()->id==$user->id)
                            <button style="" class="btn btn-default btn-xs pull-right" data-toggle="modal"
                                    data-target="#picture"><i class="livicon" data-name="camera" data-size="28"
                                                              data-c="#6CC66C" data-hc="#6CC66C"
                                                              data-loop="true"></i></button>
                            <!-- Modal -->
                            <div class="example-modal modal fade" id="picture" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Change Profile Picture</h4>
                                        </div>
                                        <div style="padding-left: 20%;" class="modal-body">
                                            <form enctype="multipart/form-data" action="{{route('profile_pic')}}"
                                                  method="post">

                                                <label for="avatar">Upload profile picture (128 x 128)</label>
                                                <input type="file" name="avatar">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <div style="margin-top: 20px;padding-bottom: 3px" class="modal-footer">
                                                    <button type="submit" class="btn btn-primary pull-right">Done
                                                    </button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endif

                        <img class="profile-user-img img-responsive " src="{{ Gravatar::src(Sentinel::getUser()->email) }}"
                             alt="User profile picture">


                        <h3 class="profile-username text-center">{{$user->fullName}}</h3>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div style="text-align: center;" class="box-header with-border">
                        <h3 class="box-title">Leave Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item">
                                Allowed Leave(days) <a class="pull-right">{{$leave->allow_leave}}</a>
                            </li>
                            <li class="list-group-item">
                                Rejected Application <a class="pull-right">{{$leave->rejected_leave}}</a>
                            </li>

                            <li class="list-group-item">
                                Pending Application <a class="pull-right">{{$leave->pending_leave}}</a>
                            </li>
                            <li class="list-group-item">
                                Emergency Leave(days) <a class="pull-right">{{$leave->emergency_leave}}</a>
                            </li>
                            <li class="list-group-item">
                                Remaining Leave(days) <a class="pull-right">{{$leave->remaining_leave}}</a>
                            </li>
                            <li class="list-group-item">
                                Accepted Application <a class="pull-right">{{$leave->accepted_leave}}</a>
                            </li>
                            <li class="list-group-item">
                                Total Leave(days) <a
                                        class="pull-right">{{($leave->allow_leave-$leave->remaining_leave)+$leave->emergency_leave}}</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9 ">
                <div class="nav-tabs-custom box-primary">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab"><i class="livicon" data-name="info"
                                                                                    data-size="16" data-c="#01BC8C"
                                                                                    data-hc="#01BC8C"
                                                                                    data-loop="true"></i> User Info</a>
                        </li>


                        @if((Sentinel::getUser()->id==$user->id || Sentinel::inRole('admin') || Sentinel::inRole('authority')) )

                           @if(Sentinel::getUser()->id==$user->id )
                                <li><a href="#edit" data-toggle="tab"><i class="livicon" data-name="gear" data-size="16"
                                                                         data-c="#01BC8C" data-hc="#01BC8C"
                                                                         data-loop="true"></i> Edit Info</a></li>
                                @elseif(Sentinel::inRole('admin') && $role=='User' )
                                    <li><a href="#edit" data-toggle="tab"><i class="livicon" data-name="gear" data-size="16"
                                                                             data-c="#01BC8C" data-hc="#01BC8C"
                                                                             data-loop="true"></i> Edit Info</a></li>
                            @elseif(Sentinel::inRole('authority') && $role!='Authority' )
                                <li><a href="#edit" data-toggle="tab"><i class="livicon" data-name="gear" data-size="16"
                                                                         data-c="#01BC8C" data-hc="#01BC8C"
                                                                         data-loop="true"></i> Edit Info</a></li>
                               @endif
                        @endif

                        @if(Sentinel::getUser()->id==$user->id)
                            <li><a href="#password" data-toggle="tab"><i class="livicon" data-name="key" data-size="16"
                                                                         data-c="#01BC8C" data-hc="#01BC8C"
                                                                         data-loop="true"></i> Change Password</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">

                        <div class="active tab-pane" id="settings">
                            <div style="margin: 5% 3% 5% 3%;" class="table-responsive">
                                <table class="table" id="users">
                                    <tbody>

                                    <tr>
                                        <td>User Name</td>
                                        <td>
                                            <a href="#">{{$user->userName}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>
                                            <a href="#">{{$user->fullName}}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <a href="#">
                                                {{$user->email}}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Designation</td>
                                        <td>
                                            <a href="#">
                                                {{$user->class}}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Phone Number
                                        </td>
                                        <td>
                                            <a href="#">
                                                {{$user->phoneNo}}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Date of Birth
                                        </td>
                                        <td>
                                            <a href="#">
                                                {{$user->date_of_birth}}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Gender
                                        </td>
                                        <td>
                                            <a href="#">
                                                {{$user->gender}}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                            <a href="#">
                                                {{$user->address}}
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Role</td>
                                        <td>
                                            <a href="#">{{$role}}</a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>Created At</td>
                                        <td>
                                            <a href="#">{{$user->created_at->diffforhumans()}}</a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class=" tab-pane edit_info" id="edit">
                            <div style="margin-top: 5%;" class="row">
                                <div class="col-md-12 pd-top">
                                    <form action="#" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        <input type="text" value="{{$user->id}}" name="id"
                                               class="form-control hidden"/>

                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    User Name
                                                    <span class='require'></span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="user"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="text" value="{{$user->userName}}" name="username"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(Sentinel::inRole('admin') || Sentinel::inRole('authority'))

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Full Name
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="user"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                            <input type="text" value="{{$user->fullName}}"
                                                                   name="fullName"
                                                                   class="form-control"/>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Designation
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="medal"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>


                                                            <select class="form-control" id="designation" name="designation">
                                                                <option class="designation"
                                                                        value="{{$user->class}}">{{$user->class}}</option>
                                                                @foreach($designation as $des)
                                                                    <option class="designation"
                                                                            value="{{$des->designation}}">{{$des->designation}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Date Of Birth
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="calendar"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                            <input style="background: white" type="text" readonly='true'
                                                                   id="dob" value="{{$user->date_of_birth}}"
                                                                   name="dob"
                                                                   class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Gender
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="tags"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>

                                                            <select class="form-control" id="gender" name="gender">
                                                                <option class="gender"
                                                                        value="{{$user->gender}}">{{$user->gender}}</option>
                                                                <option class="gender" value="male">male</option>
                                                                <option class="gender" value="female">female</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Address
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="location"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                            <input type="text" value="{{$user->address}}" name="address"
                                                                   class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>

                                           @if(Sentinel::inRole('authority'))
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Role
                                                        <span class='require'></span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="balance"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>

                                                            <select class="form-control" id="role" name="role">
                                                                <option class="gender"
                                                                        value="{{$role}}">{{$role}}</option>
                                                                <option value="Authority">Authority</option>
                                                                <option value="Admin">Admin</option>
                                                                <option value="User">User</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                               @else
                                                    <select class="form-control hidden" id="role" name="role">
                                                        <option class="gender"
                                                                value="{{$role}}">{{$role}}</option>

                                                    </select>
                                                @endif
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    Email
                                                    <span class='require'></span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="mail"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="email" value="{{$user->email}}" name="email"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    Phone
                                                    <span class='require'></span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="phone"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="text" value="{{$user->phoneNo}}" name="phone"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">

                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group input_val">

                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="form-actions">
                                            <div style="margin-top: 5%;margin-bottom: 5%;"
                                                 class="col-md-offset-3 col-md-9">
                                                <button type="submit"
                                                        class="btn btn-flat btn-success info_update pull-right">Update
                                                </button>
                                                &nbsp
                                                &nbsp;
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class=" tab-pane edit_password" id="password">
                            <div style="margin-top: 5%;" class="row">
                                <div class="col-md-12 pd-top">
                                    <form action="#" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    Current Password
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="key"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="password" placeholder="Password" name="cpassword"
                                                               class="form-control" autocomplete="off"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    New Password
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="key"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="password" placeholder="Password" name="npassword"
                                                               class="form-control" autocomplete="off"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">
                                                    Confirm Password
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="livicon" data-name="key"
                                                                           data-size="16" data-loop="true" data-c="#000"
                                                                           data-hc="#000"></i>
                                                                    </span>
                                                        <input type="password" placeholder="Confirm Password"
                                                               name="confirmpassword"
                                                               class="form-control" autocomplete="off"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="input-group wrong">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <div style="margin-top: 5%;margin-bottom: 5%;"
                                                 class="col-md-offset-3 col-md-9">
                                                <button type="submit"
                                                        class="btn btn-flat btn-success submit_pass pull-right">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>


    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('js/profile.js')}}"></script>



@stop


