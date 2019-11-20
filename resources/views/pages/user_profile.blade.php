@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    user list
@stop



{{-- page level styles --}}
@section('header_styles')
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/css/pages/jquery-ui.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/icon.css') }}" rel="stylesheet" type="text/css" />
    <!-- end of page level css-->

    <style>
        table.dataTable thead th:nth-child(odd){
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
    </style>
@stop

{{-- Page content --}}


@section('content')

    <section  class="content-header">
        <!--section starts-->
        <h1>User List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">User List</a>
            </li>
        </ol>
    </section>




    <!--section ends-->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Users List
                    </h4>
                </div>
                <br/>
                <div class="panel-body">
                    <table style="border-top:1px solid #ddd; " id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Class</th>
                            <th>Created At</th>
                            <th>Leave Archive</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)

                            <tr>
                                <td style="border-left:1px solid #ddd;border-right:1px solid #ddd;">{{$key+1}}</td>
                                <td style="text-align: center"><img style="width: 60px;height: 35px;margin-top: 5%"
                                                                    src="{{ asset('images/'.$user->image)}}"></td>
                                <td style="border-left:1px solid #ddd;border-right:1px solid #ddd;">{{$user->userName}}</td>
                                <td>{{$user->class}}</td>
                                <td style="border-left:1px solid #ddd;border-right:1px solid #ddd;">{{$user->created_at}}</td>
                                <td style="text-align: center"><a href="{{url('leave_archive/user_'.$user->id)}}"
                                                                  class="btn btn-sm btn-flat button-3d btn-raised btn-success"
                                                                  value="{{$user->id}}">Archive
                                    </a></td>
                                <td style="padding-left: 3%;border-left:1px solid #ddd;border-right:1px solid #ddd;">

                                    <form style="float: left" action="{{url('user_profile')}}" method="get">
                                        <input name="prf" id="prf" type="hidden" value="{{$user->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <a style="padding-top:0" href="javascript::void(0)" onclick="$(this).closest('form').submit()" class="btn btn-xs "><i title="view profile" style="color:#428BCA;font-size:20px;" class="fa fa-user" aria-hidden="true"></i></a>
                                    </form>


                                    <?php
                                    $member = Sentinel::findById($user->id)->roles()->get();
                                    foreach ($member as $use) {
                                        $role = $use->slug;
                                    }
                                    ?>

                                    @if(Sentinel::inRole('admin'))

                                        @if($role=='user')
                                            <a style="padding-top:0" href="#" id="{{$user->id}}" class="delete btn btn-xs">
                                                <i title="delete user" style="color:red;font-size:20px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        @endif

                                    @elseif(Sentinel::inRole('authority'))
                                        @if($role=='user' || $role=='admin')
                                            <a style="padding-top:0" href="#" id="{{$user->id}}" class="delete btn btn-xs ">
                                                <i title="delete user" style="color:red;font-size:20px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>    <!-- row-->
    </section>

    <script type="text/javascript" src="{{ asset('jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/table.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/user_profile.js')}}"></script>

@stop




