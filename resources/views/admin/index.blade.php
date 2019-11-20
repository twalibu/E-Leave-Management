@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    home

@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('admin/vendors/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/vendors/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('admin/vendors/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/vendors/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Welcome to Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Home
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <!-- Trans label pie charts strats here-->
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-8 text-right">
                                    <span>Total Application</span>

                                    <div class="number" id="myTargetElement1">{{$user->no_app}}</div>
                                </div>
                                <i class="livicon  pull-right" data-name="folder-open" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                <!-- Trans label pie charts strats here-->
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-8 pull-left">
                                    <span>Accepted Application</span>

                                    <div class="number" id="myTargetElement2">{{$user->accepted_leave}}</div>
                                </div>
                                <i class="livicon pull-right" data-name="thumbs-up" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                <!-- Trans label pie charts strats here-->
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-8 pull-left">
                                    <span>Rejected Application</span>

                                    <div class="number" id="myTargetElement3">{{$user->rejected_leave}}</div>
                                </div>
                                <i class="livicon pull-right" data-name="thumbs-down" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-8 pull-left">
                                    <span>Pending Application</span>

                                    <div class="number" id="myTargetElement4">{{$user->pending_leave}}</div>
                                </div>
                                <i class="livicon pull-right" data-name="archive-add" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
        <div class="row ">
            <div class="col-md-8 col-sm-6">
                <div class="panel panel-border">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="dashboard" data-size="20" data-loop="true" data-c="#F89A14"
                               data-hc="#F89A14"></i>
                            Realtime Server Load
                            <small>- Load on the Server</small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div id="realtimechart" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="panel blue_gradiant_bg">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Server Stats
                            <small class="white-text">- Monthly Report</small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_bar"></div>
                                    <h3 class="title">Network</h3>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm"></div>
                            <div class="margin-bottom-10 visible-sm"></div>
                            <div class="col-sm-6">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_line"></div>
                                    <h3 class="title">Load Rate</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN Percentage monitor -->
                <div class="panel green_gradiante_bg ">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="spinner-six" data-size="16" data-loop="false" data-c="#fff"
                               data-hc="white"></i>
                            Result vs Target
                        </h3>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <h4 class="small-heading">Sales</h4>
                                <span class="chart cir chart-widget-pie widget-easy-pie-1" data-percent="45"><span
                                            class="percent">45</span>
                            </span>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-6 text-center">
                                <h4 class="small-heading">Reach</h4>
                                <span class="chart cir chart-widget-pie widget-easy-pie-3" data-percent="25">
                                <span class="percent">25</span>
                            </span>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- END BEGIN Percentage monitor-->
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel panel-success panel-border">
                    <div class="panel-heading  border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="calendar" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Calendar
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id='external-events'></div>
                        <div id="calendar"></div>
                        <div class="box-footer pad-5">
                            <a href="#" class="btn btn-success btn-block createevent_btn" data-toggle="modal" data-target="#myModal">Create event
                            </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <i class="fa fa-plus" style="margin-top: 8px;"></i> Create Event
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <input type="text" id="new-event" class="form-control" placeholder="Event">
                                            <div class="input-group-btn">
                                                <button type="button" id="color-chooser-btn" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    Type
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" id="color-chooser">
                                                    <li>
                                                        <a class="palette-primary" href="#">Primary</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-success" href="#">Success</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-info" href="#">Info</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-warning" href="#">warning</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-danger" href="#">Danger</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-default" href="#">Default</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                                            Close
                                            <i class="fa fa-times" style="margin-top: 4px;"></i>
                                        </button>
                                        <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                                            <i class="fa fa-plus" style="margin-top: 5px;"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- To do list -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel panel-primary todolist">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Tasks
                        </h4>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="panel-body">
                            <div style="overflow: hidden;width: auto;height: 286px;" class="row list_of_items ">
                            </div>
                        </div>
                        <div class="todolist_list adds">
                            {!! Form::open(['class'=>'form', 'id'=>'main_input_box']) !!}
                            <div class="form-group">
                                {!! Form::label('task_description', 'Task description: ') !!}
                                {!! Form::text('task_description', null, ['class' => 'form-control','id'=>'task_description', 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('task_deadline', 'Deadline: ') !!}
                                {!! Form::text('task_deadline', null, ['class' => 'form-control datepicker', 'id'=>'task_deadline', 'data-date-format'=> 'YYYY/MM/DD', 'required' => 'required']) !!}
                            </div>
                            <button type="submit" class="btn btn-primary add_button">
                                Add Task
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('admin/vendors/moment.min.js') }}"></script>

    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('admin/vendors/easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/jquery.easingpie.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('admin/vendors/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/vendors/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('admin/vendors/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/vendors/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('admin/vendors/jquery.sparkline.js') }}"></script>
    <!-- Back to Top-->
    <!--   maps -->
    <script src="{{ asset('admin/vendors/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!--  todolist-->
    <script src="{{ asset('admin/vendors/dashboard.js') }}" type="text/javascript"></script>

@stop