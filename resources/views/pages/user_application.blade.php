@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    requested application

@stop


{{-- page level styles --}}
@section('header_styles')
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/css/pages/jquery-ui.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/vendors/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('admin/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/advmodals.css') }}" rel="stylesheet"/>
    <!-- end of page level css-->
@stop

{{-- Page content --}}



@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Requested Leave</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">Requested Leave </a>
            </li>
        </ol>
    </section>




    <!--section ends-->
    <section class="content">
        <div class="modal fade pullDown application_form" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="text-align: center" class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalLabelnews"> Application</h4>
                    </div>
                    <div class="app_modal">


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-success filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Requested Application
                        </h3>
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Send To</th>
                                <th>Start (mm/dd/yy)</th>
                                <th>End (mm/dd/yy)</th>
                                <th>Total Day</th>
                                <th>App Date (mm/dd/yy)</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=>$detail)
                                <?php
                                $st = ($detail->start_date);
                                $ed = ($detail->end_date);
                                $ap = ($detail->app_date);
                                $t = ($detail->total_day);

                                ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->send_to}}</td>
                                    <td>{{$st}}</td>
                                    <td>{{$ed}}</td>
                                    <td style="text-align: center">{{$t}}</td>
                                    <td>{{$ap}}</td>
                                    <td>{{$detail->type}}</td>
                                    <td style="text-align: center">
                                        <button class="btn btn-flat button-3d btn-raised btn-xs btn-success show_btn btn-block"
                                                type="button"
                                                data-toggle="modal" value="{{$detail->id}}">SHOW
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="{{ asset('jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/user_application.js')}}"></script>

@stop




