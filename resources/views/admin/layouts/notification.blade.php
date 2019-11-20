<?php
if(Sentinel::inRole('admin') || Sentinel::inRole('authority'))
{
    $noti=\App\Notification::where('status','=','pending')->orWhere('user_id','=',Sentinel::getUser()->id)->orderBy('updated_at','desc')->get();
}
else{
    $noti=\App\Notification::where('user_id','=',Sentinel::getUser()->id)->where(function($query){
        $query->where('status','=','accepted')
            ->orWhere('status','=','rejected');
    })->orderBy('updated_at','desc')->get();
}
$count=sizeof($noti);
?>

<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="message-flag" data-loop="true" data-color="#e9573f"
           data-hovercolor="#e9573f" data-size="28"></i>
        @if($count>0)<span class="label label-warning">{{$count}}</span>@endif
    </a>
    <ul class=" notifications dropdown-menu drop_notify">
        @if($count>0)
        <li class="dropdown-title">You have {{$count}} notifications</li>
        @else
            <li class="dropdown-title">No new notification</li>
        @endif
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">

@foreach($noti as $not)
                <li>
                    @if($not->status=='accepted')
                        <a  class="notify" id="{{$not->id}}" name="accepted" href="#"><img style="margin: 4%" src="{{asset('images/'.$not->image)}}" width="30"
                                         class="img-circle img-responsive pull-left" height="30" alt="img">Your Application is Accepted</a>
                        <small class="pull-right">
                            <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                            {{$not->updated_at->diffforhumans()}}
                        </small>
                        @elseif($not->status=='rejected')
                        <a class="notify" id="{{$not->id}}" name="rejected" href="#"><img style="margin: 4%" src="{{asset('images/'.$not->image)}}" width="30"
                                         class="img-circle img-responsive pull-left" height="30" alt="img">Your Application is Rejected</a>
                        <small class="pull-right">
                            <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                            {{$not->updated_at->diffforhumans()}}
                        </small>
                        @else
                        <a class="notify" id="{{$not->id}}" name="pending" href="#"><img style="margin: 4%" src="{{asset('images/'.$not->image)}}" width="30"
                                         class="img-circle img-responsive pull-left" height="30" alt="img">@if(strlen($not->name)>12) Appication From {{substr($not->name,0,12)}}..@else Appication From {{($not->name)}}@endif</a>
                        <small class="pull-right">
                            <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                            {{$not->updated_at->diffforhumans()}}
                        </small>

                        @endif
                </li>
@endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="#"> <i class="fa fa-angle-double-up"></i></a>
        </li>
    </ul>
</li>

<script type="text/javascript" src="{{ asset('jquery.js')}}"></script>

<script>

$('.notify').click(function (e) {
    e.preventDefault();

    var id=$(this).attr('id');

    var txt=$(this).attr('name');

    $.ajax({
        type:"post",
        url:"{{route('clear-notification')}}",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{
           'id':id,
            'txt':txt
        },
        success:function(s){
            if(txt=='pending'){
                window.location.replace('{{url('user-application')}}');
            }
            else if(txt=='accepted'){
                window.location.replace('{{url('my-application/accepted-application')}}');
            }
            else{
                window.location.replace('{{url('my-application/rejected-application')}}');

            }
        }
    });

});
</script>