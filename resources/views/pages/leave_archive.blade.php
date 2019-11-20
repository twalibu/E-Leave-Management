@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    archive

@stop


{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('admin/css/jquery-ui.css') }}"
          rel="stylesheet">
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
        <h1>Leave Archive</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">Leave Archive</a>
            </li>
        </ol>
    </section>

    <!--section ends-->
    <section class="content">

        <div class="modal fade pullDown application_form" id="modal-6" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="text-align: center" class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalLabelnews"> Application </h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button style="float:left;" class="btn btn-flat button1-3d btn-raised btn-danger"
                                data-dismiss="modal">CLOSE
                        </button>
                        <button class="btn btn-flat button-3d pull-right btn-raised btn-success send_data print_data"
                                type="button"
                                data-toggle="modal">PRINT
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade slideRight modal_report" id="modal-2" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="text-align: center" class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalLabelnews"> Time Frame </h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding: 0" class="row">
                            <div class="col-md-6">
                                <input type="text" class="start form-control" style="width: 100%;" id="start_day"
                                       name="start_date" required placeholder="From">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="end form-control" style="width: 100%;" id="end_day"
                                       name="end_date" required placeholder="To">
                            </div>
                        </div>
                        <div class="r_warning">

                        </div>
                    </div>
                    <div style="padding-top: 0" class="modal-footer">
                        <button style="float:left;" class="btn btn-flat button1-3d btn-raised btn-danger report_cancel"
                                data-dismiss="modal">CLOSE
                        </button>
                        <button class="btn btn-flat button-3d pull-right btn-raised btn-success print_report"
                                type="button"
                                data-toggle="modal">PRINT
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="panel panel-success filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Leave Archive
                        </h3>
                    </div>

                    <div class="panel-body">

                        <div  class="row">
                            <div class="col-md-10">
                                <h4>{{$user->fullName}}</h4>
                                <p>{{$user->address}}</p>
                                <p>Advance Engineering Solution.</p>
                                <p>{{$user->phoneNo}}</p>
                            </div>

                            <div class="col-md-2">
                                <button style="font-size: 15px;" class="btn btn-block btn-flat btn-info btn-sm report" >
                                    Print <i style="padding-left: 10px;" class="livicon" data-name="printer"
                                             title="printer" data-loop="true"
                                             data-color="#ffffff" data-hc="#ffffff" data-s="18"></i></button>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Authority</th>
                                <th>Start (mm/dd/yy)</th>
                                <th>End (mm/dd/yy)</th>
                                <th>Total Day</th>
                                <th>App Date (mm/dd/yy)</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($multi_data as $key=> $data)
                                <?php
                                $st = ($data->start_date);
                                $ed = ($data->end_date);
                                $ap = ($data->app_date);
                                $t = ($data->total_day);

                                ?>

                                <tr>
                                    <td>{{$key+1}}</td>
                                    @if($data->status=='Pending')
                                        <td>{{$data->send_to}}</td>
                                    @elseif($data->status=='Accepted')
                                        <td>{{$data->approved_by}}</td>
                                    @else
                                        <td>{{$data->rejected_by}}</td>
                                    @endif
                                    <td>{{$st}}</td>
                                    <td>{{$ed}}</td>

                                    <td>{{$t}}</td>
                                    <td>{{$ap}}</td>
                                    <td>{{$data->type}}</td>
                                    @if($data->status=='Pending')
                                        <td><a href=""
                                               class="show_app btn btn-flat  btn-raised btn-xs btn-warning btn-block"
                                               id="{{$data->id}}">Pending</a></td>
                                    @elseif($data->status=='Accepted')
                                        <td><a href=""
                                               class="show_app btn btn-flat  btn-raised btn-xs btn-success btn-block"
                                               id="{{$data->id}}">Accepted</a></td>
                                    @else
                                        <td><a href=""
                                               class="show_app btn btn-flat btn-raised btn-xs btn-danger btn-block"
                                               id="{{$data->id}}">Rejected</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden" id="printReport">
            <div style="margin-bottom:2em" class="row r_pic">

                <div class="col-md-12"><h3>{{$user->fullName}}</h3>
                    <p >{{$user->address}}</p>
                    <p >Advance Engineering Solution .</p>
                    <p>{{$user->phoneNo}}</p></div>
                <h3 style="text-align: center">Leave Report</h3>
            </div>
            <table class="table table-bordered report_table">
                <thead>
                <tr>
                    <th style="text-align: left">No</th>
                    <th style="text-align: left">Authority</th>
                    <th style="text-align: left">Start (mm/dd/yy)</th>
                    <th style="text-align: left">End (mm/dd/yy)</th>
                    <th style="text-align: left">Total Day</th>
                    <th style="text-align: left">App Date (mm/dd/yy)</th>
                    <th style="text-align: left">Type</th>
                    <th style="text-align: left">Status</th>
                </tr>
                </thead>
                <tbody class="report_body">

                </tbody>
            </table>
            <div class="row r_foot">
               <div class="col-md-12 report_date"></div>
                <div class="col-md-12 footer"></div>
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
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>


        $('.print_data').click(function (e) {
            e.preventDefault();

            PrintElem('printElement');


        });

        function myFunction(data) {

            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            var current_date = new Date(data);
            month_value = current_date.getMonth();
            day_value = current_date.getDate();
            year_value = current_date.getFullYear();

            return day_value + " " + months[month_value] + " " + year_value;
        }


        function PrintElem(areaID) {
            var mywindow = window.open('', 'PRINT', 'height=750,width=800');

            mywindow.document.write('<html><head><title>Advance Engineering Solution.</title>');
            mywindow.document.write('</head><body style="margin-top: 5%;margin-left: 5%;font-size: 25px">');

            mywindow.document.write(document.getElementById(areaID).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

        }

        $('#example').DataTable({
            "scrollX": true
        });

        $('table').on('click', '.show_app', function (e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var tab = $(this).text();

            $.ajax({
                type: "post",
                url: "{{route('fetch_data')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id': id,
                    'tab': tab
                },
                success: function (s) {


                    var st = (s.start_date);
                    var ed = (s.end_date);
                    var ap = (s.app_date);
                    var t = (s.total_day);

                    var type, abc;
                    if (s.type == 'Advance') {
                        type = 'Leave in advance.'
                        abc = 'For why I need ' + t + ' days leave from ' + myFunction(st) + ' to ' + myFunction(ed);
                    }
                    else {
                        type = 'Leave of absence.'
                        abc = 'For why I was unable to attend from ' + myFunction(st) + ' to ' + myFunction(ed);
                    }

                    if (tab == 'Pending') {
                        var auth = s.send_to;
                        var img = '';
                    }
                    else if (tab == 'Accepted') {
                        var auth = s.approved_by;
                        var img = '{{ asset("images/accepted.png") }}';
                    }
                    else if (tab == 'Rejected') {
                        var auth = s.rejected_by;
                        var img = '{{ asset("images/rejected.png") }}';
                    }


                    var app = '<div class="leave" id="printElement" style="margin:0 10% 0 10%;"><p>To<br>' + auth + '<br>Advance Engineering Solution.<br>' + myFunction(ap) + '<br><br> <strong>Subject : ' + type + '</strong><br><br><br>This is to inform you that I, ' + s.name + ' have been working as ' + s.class + ' in your company.' + s.reason + '.' + abc + '.<br><br>Hope you will consider my applcation. I will be very thankful to you for your favor.</p><br><br>Regards<br>' + s.fullName + '<br>' + s.class + '<br>Advance Engineering Solution.<br><img class="modal_img" style="padding-left:10%;" src="' + img + '"></div>';

                    $('#modal-6').find('.modal-body').html(app);
                    $('#modal-6').modal('show');


                }
            });

        });



        $("#start_day").datepicker({
            onSelect: function (date) {
                $("#end_day").datepicker('option', 'minDate', date);
            }
        });

        $("#end_day").datepicker({});


       $(".report_table tbody tr:nth-child(1)").remove();

        $("#printReport .dataTables_wrapper .row:nth-child(1)").remove();
        $("#printReport .dataTables_wrapper .row:nth-child(2)").remove();




        function printdiv() {
            var divToPrint = document.getElementById('printReport');
            var htmlToPrint = '' +
                    '<style type="text/css">' +
                    'table td,table th{' +
                    'border:1px solid #ddd;' +
                    'padding:1em;' +
                    'border-collapse: collapse;'+
                    'border-spacing: 5px;'+
                    '}' +
                    'h3{' +
                    'margin:0px;' +
                    'padding:2px;' +
                    'font-size: 22px;'+
                    '}' +
                    'p {' +
                    'margin:0px;' +
                    'padding:2px;' +
                    'font-size: 15px;'+
                    '}' +
                    '.r_foot {' +
                    'margin-top:10em;' +
                    'margin-right:3em;' +
                    '}' +
                    'h4 {' +
                    'text-align:right' +
                    '}' +
                    '.footer {' +
                    'margin-top:5em' +
                    '}' +
                    '.r_pic {' +
                    'background-image: url("{{asset('/images/e-leave.png')}}");' +
                            'background-repeat: no-repeat ;'+
                            ' background-position: right top;'+
                            'right:2px'+

                    '}' +
                    '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open('', 'Print', 'height=800,width=1000');
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        }

        $('.panel-body').on('click', '.report', function (e) {
            e.preventDefault();

            $('#modal-2').modal('show');
        });

        $('.modal_report').on('click', '.print_report', function (e) {
            e.preventDefault();

            start = $(".modal_report").find("input[name='start_date']").val();

            end = $(".modal_report").find("input[name='end_date']").val();

            if(start>end || start=='' || end=='' ){
                $('.r_warning').html('<p style="color: firebrick">Something goes wrong !</p>');
            }

           else{
                $('.r_warning').html('');
                var object = JSON.parse('<?php echo json_encode($multi_data)?>');
                var user = JSON.parse('<?php echo json_encode($user)?>');
                var preview='';
                for (i = 0; i < object.length; i++) {

                    if (object[i].app_date >= start && object[i].app_date <= end) {
                        var auth;

                        if (object[i].status == 'Pending') {
                            auth = object[i].send_to;
                        }
                        else if (object[i].status == 'Accepted') {
                            auth = object[i].approved_by;
                        }
                        else {
                            auth = object[i].rejected_by;
                        }

                        preview += '<tr><td >' + (i + 1) + '</td><td>' + auth + '</td><td>' + object[i].start_date + '</td><td>' + object[i].end_date + '</td><td>' + object[i].total_day + '</td><td>' + object[i].app_date + '</td><td>' + object[i].type + '</td><td>' + object[i].status + '</td></tr>';


                    }
                }

                $('.report_body').html(preview);
                var date=Date();
                var getdate=myFunction(date);
                $('.report_date').html('<h4 class="sign">Signature</h4><h4>Date: '+getdate+'</h4>');
                $('.footer').html('Note: The report is generated between '+start+' and '+end);


                printdiv();


            }

        });




        $('.report_cancel').click(function () {
            $('.r_warning').html('');
            start = $(".modal_report").find("input[name='start_date']").val('');

            end = $(".modal_report").find("input[name='end_date']").val('');
        });
        $('.close').click(function () {
            $('.r_warning').html('');
            start = $(".modal_report").find("input[name='start_date']").val('');

            end = $(".modal_report").find("input[name='end_date']").val('');
        });



    </script>

@stop




