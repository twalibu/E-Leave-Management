@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @parent
    apply leave

@stop


{{-- page level styles --}}
@section('header_styles')
    <link href = "{{ asset('admin/css/jquery-ui.css') }}"
          rel = "stylesheet">
    <link href="{{ asset('admin/css/pages/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/sweetalert.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/pages/advmodals.css') }}" rel="stylesheet"/>
    <!-- end of page level css-->
@stop

{{-- Page content --}}


@section('content')

    <section class="content-header">
        <!--section starts-->
        <h1>Apply Leave</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="">Apply Leave </a>
            </li>
        </ol>
    </section>




    <!--section ends-->
    <section class="content">

        <div class="modal fade pullDown application_form" id="modal-4" role="dialog" aria-labelledby="modalLabelnews">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="text-align: center" class="modal-header bg-success">
                        <h4 class="modal-title" id="modalLabelnews">Application</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button style="float:left;" class="btn btn-flat button1-3d btn-raised btn-danger" data-dismiss="modal">CLOSE</button>
                        <button class="btn btn-flat button-3d pull-right btn-raised btn-success send_data" type="button"
                                data-toggle="modal" >SEND
                        </button>
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
                            Application Info
                        </h3>
                    </div>

                    <div style="padding-right: 20%" class="panel-body">



                        <form>


                            <div class="row app_form">
                                <input type="hidden" name="fullname" value="{{Sentinel::getUser()->fullName}}">
                                <input type="hidden" name="class" value="{{Sentinel::getUser()->class}}">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div style="padding-bottom:0" class="form-group form-inline row">
                                        <div style="float: left;line-height: 60px" class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="size">To : </label>
                                        </div>
                                        {{csrf_field()}}
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select style="width: 100%;border-radius: 0px;border-radius: 0;" id="select23"
                                                    class="form-control select2" required>
                                                <option style="text-align: center" selected disabled hidden value="">Select</option>
                                                @foreach($name as $authority)
                                                    <option name="authority"  value="{{$authority->fullName}}">{{$authority->fullName}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div style="float: left;line-height: 60px;text-align: left" class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="size">App Type : </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select style="border-radius: 0" class="form-control sel2" id="sel2">
                                                <option selected disabled hidden value="">Select</option>
                                                <option class="adv" value="Advance">Advance</option>
                                                <option class="abs" value="Absence">Absence</option>
                                            </select>
                                        </div>


                                        <div style="float: left;line-height: 60px" class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="size">App Date : </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input type="text" readonly='true' class="app form-control" style="background: white;width: 100%;border-radius: 0" id="app_day" name="app_date" placeholder="mm/dd/yyyy"
                                                   required>
                                        </div>





                                    </div>

                                    <div class="row hidden apply_form">


                                        <div style="float: left;line-height: 60px" class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="size">Start Date : </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input type="text" readonly='true' class="start form-control" style="background: white;width: 100%;border-radius: 0" id="start_day" name="start_date" required placeholder="mm/dd/yyyy" >

                                        </div>


                                        <div style="float: left;line-height: 60px;text-align: left" class="col-md-3 col-sm-3 col-xs-12 ">
                                            <label for="size">End Date : </label>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 ">
                                            <input type="text" readonly='true' class="end form-control" style="background: white;width: 100%;border-radius: 0" id="end_day" name="end_date" placeholder="mm/dd/yyyy"
                                                   required>
                                        </div>


                                    </div>


                                    <div class="form-group form-inline ">
                                        <div class="row">
                                            <div style="float: left;line-height: 60px"
                                                 class="col-md-3 col-sm-3 col-xs-12">
                                                <label for="size">Reason : </label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                            <textarea class="reason form-control" name="reason" style="resize: none;padding-left: 2%;width: 100%;border-radius: 0" rows="4"
                                                      placeholder="reason" required></textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-flat button-3d pull-right btn-raised btn-success next_btn" type="button"
                                                data-toggle="modal" >NEXT
                                        </button>


                                    </div>

                                </div>

                            </div>
                        </form>

                    </div>

                    <div class="col-md-12">
                       @if( $info->emergency_leave==0 )
                        <marquee><h5 style="color: red;">YOU HAVE '{{$info->remaining_leave}}' REMAINING DAY.</h5></marquee>
                           @else
                            <marquee><h5 style="color: red;">YOU HAVE ALREADY TAKEN'{{$info->emergency_leave}}' DAYS EMERGENCY LEAVE.</h5></marquee>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>


    </section>

    <script type="text/javascript" src="{{ asset('jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/eleave.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/vendors/sweetalert-dev.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/pages/classie.js')}}"></script>
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script>
        var day ="<?php echo ($info->remaining_leave) ; ?>";
    </script>
    <script type="text/javascript" src="{{ asset('js/apply_leave.js')}}"></script>




@stop




