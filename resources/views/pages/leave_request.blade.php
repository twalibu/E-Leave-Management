@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    my application
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
        <h1>Application List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">My Application </a>
            </li>
        </ol>
    </section>




    <!--section ends-->
    <section class="content">

        <div class="modal fade pullDown application_form" id="modal-5" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="text-align: center" class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title" id="modalLabelnews"> Application</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button style="float:left;" class="btn btn-flat button1-3d btn-raised btn-danger" data-dismiss="modal">CLOSE</button>
                        @if($flag!=0) <button class="btn btn-flat button-3d pull-right btn-raised btn-success print_data" type="button"
                                              data-toggle="modal" >PRINT
                        </button>
                        @endif
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
                            @if($flag==0)
                                Pending Application
                                @elseif($flag==1) Accepted Application
                                @else($flag==2) Rejected Application
                                @endif
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
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=>$detail)
                                <?php
                                $st=($detail->start_date);
                                $ed=($detail->end_date);
                                $ap=($detail->app_date);
                                $t=($detail->total_day);
                                ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{Sentinel::getUser()->userName}}</td>
                                    @if($flag==0) <td>{{$detail->send_to}}</td>
                                    @elseif($flag==1) <td>{{$detail->approved_by}}</td>
                                    @else <td>{{$detail->rejected_by}}</td>
                                    @endif
                                    <td>{{$st}}</td>
                                    <td>{{$ed}}</td>
                                    <td>{{$t}}</td>
                                    <td>{{$ap}}</td>
                                    <td>{{$detail->type}}</td>
                                    @if($flag==0) <td ><a  href="" class="show_app btn btn-flat  btn-raised btn-xs btn-warning btn-block" id="{{$detail->id}}" >Pending</a></td>
                                    @elseif($flag==1) <td><a  href="" class="show_app btn btn-flat  btn-raised btn-xs btn-success btn-block" id="{{$detail->id}}">Accepted</a></td>
                                    @else <td ><a href="" class="show_app btn btn-flat  btn-raised btn-xs btn-danger btn-block " id="{{$detail->id}}" >Rejected</a></td>
                                    @endif

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
    <script type="text/javascript" src="{{ asset('js/eleave.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/table-responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>


<script>

    $('#example').DataTable({
        "scrollX": true
    });

    $('.print_data').click(function (e) {
        e.preventDefault();

        PrintElem('printElement');


    });

    function PrintElem(areaID)
    {
        var mywindow = window.open('', 'PRINT', 'height=750,width=900');

        mywindow.document.write('<html><head>');
        mywindow.document.write('</head><body style="margin-top: 5%;margin-left: 5%;font-size: 25px">');

        mywindow.document.write(document.getElementById(areaID).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

    }


    $('table').on('click','.show_app',function(e)  {
        e.preventDefault();

        var id=$(this).attr('id');
        var tab=$(this).text();

        $.ajax({
            type:"post",
            url:"{{route('fetch_data')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data:{
                'id':id,
                'tab':tab
            },
            success:function(s){




                var st=(s.start_date);
                var ed=(s.end_date);
                var ap=(s.app_date);
                var t=(s.total_day);

                if(tab=='Pending'){
                    var auth=s.send_to;
                    var img='';
                }
                else if(tab=='Accepted'){
                    var auth=s.approved_by;
                    var img='{{ asset("images/accepted.png") }}';
                }
                else if(tab=='Rejected'){
                    var auth=s.rejected_by;
                    var img='{{ asset("images/rejected.png") }}';
                }

                var type,abc;
                if(s.type=='Advance'){
                    type='Leave in advance.';
                    if(t==1){
                        abc='For why I need '+t+' day leave in '+myFunction(st)+'.' ;
                    }
                    else
                        abc='For why I need '+t+' days leave from '+myFunction(st)+' to '+myFunction(ed)+'.' ;

                }
                else{
                    type='Leave of absence.';

                    if(t==1){
                        abc= 'For why I was unable to attend in '+myFunction(st)+'.';
                    }
                    else
                        abc= 'For why I was unable to attend from '+myFunction(st)+' to '+myFunction(ed)+'.';

                }

                var app='<div class="leave" id="printElement" style="margin:0 10% 0 10%;"><p>To<br>'+auth+'<br>Advance Engineering Solution.<br>'+myFunction(ap)+'<br><br> <strong>Subject : '+type+'</strong><br><br><br>This is to inform you that I, {{Sentinel::getUser()->fullName}}  have been working as {{Sentinel::getUser()->class}} in your company.'+s.reason+'. '+abc+' <br><br>Hope you will consider my applcation. I will be very thankful to you for your favor.</p><br><br>Regards<br>{{Sentinel::getUser()->fullName}}<br>{{Sentinel::getUser()->class}}<br>Advance Engineering Solution.<br><img class="modal_img" style="padding-left:10%;" src="'+img+'"></div>';

                $('#modal-5').find('.modal-body').html(app);
                $('#modal-5').modal('show');
            }
        });


    });
</script>

@stop




