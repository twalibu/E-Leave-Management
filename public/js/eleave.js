$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var start, diff, end, app_date, app_type, authority1, reason1, reason, clas, name, t_day1 = new Array(), start1 = new Array(), end1 = new Array(), app_date1 = new Array(), application_date;

function myFunction(data) {

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    var current_date = new Date(data);
    month_value = current_date.getMonth();
    day_value = current_date.getDate();
    year_value = current_date.getFullYear();

    return day_value +" "+ months[month_value] + " " + year_value;
}

$('.next_btn').click(function (e) {
    e.preventDefault();

    $(".select2").css({border: "1px solid #ddd"});
    $(".sel2").css({border: "1px solid #ddd"});
    $(".start").css({border: "1px solid #ddd"});
    $(".app").css({border: "1px solid #ddd"});
    $(".end").css({border: "1px solid #ddd"});
    $(".reason").css({border: "1px solid #ddd"});
    var authority = $("#select23 :selected").attr('value');
    authority1 = authority;
    app_type = $("#sel2 :selected").attr('value');
    start = $(".app_form").find("input[name='start_date']").val();

    end = $(".app_form").find("input[name='end_date']").val();

    app_date = $(".app_form").find("input[name='app_date']").val();

    reason = $(".app_form").find("textarea[name='reason']").val();
    reason1 = reason;
    name = $(".app_form").find("input[name='fullname']").val();
    clas = $(".app_form").find("input[name='class']").val();


    if (authority == '') {
        $(".select2").css({border: "1px solid #e07467"});
    }
    else if (app_type == '') {

        $(".sel2").css({border: "1px solid #e07467"});
    }
    else if (app_date == '') {

        $(".app").css({border: "1px solid #e07467"});
    }

    else if (start == '') {
        $(".start").css({border: "1px solid #e07467"});
    }

    else if (end == '') {

        $(".end").css({border: "1px solid #e07467"});
    }

    else if (reason == '') {
        $(".reason").css({border: "1px solid #e07467"});
    }
    else {
        var date3 = new Date(start);
        var date4 = new Date(end);
        var timeDiff = Math.abs(date4.getTime() - date3.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        diff = diffDays + 1;

        if(app_type=='Advance'){
            subject='Leave in advance.'

            if(diff==1){
                abc='For why I need '+diff+' day leave in '+myFunction(start)+'.' ;
            }
            else
                abc='For why I need '+diff+' days leave from '+myFunction(start)+' to '+myFunction(end)+'.' ;

        }
        else{
            subject='Leave of absence.'

            if(diff==1){
                abc= 'For why I was unable to attend in '+myFunction(start)+'.';
            }
            else
                abc= 'For why I was unable to attend from '+myFunction(start)+' to '+myFunction(end)+'.';

        }




        var app='<div class="leave" style="margin:0 10% 10% 10%;"><p>To<br>'+authority+'<br>Advance Engineering Solution.<br>'+myFunction(app_date)+'<br><br> <strong>Subject : '+subject+'</strong><br><br><br>This is to inform you that I, '+name+' have been working as '+clas+' in your company.'+reason+'.'+abc+'<br><br>Hope you will consider my applcation. I will be very thankful to you for your favor.</p><br><br>Regards<br>'+name+'<br>'+clas+'<br>Advance Engineering Solution.<br></div>';

        $('#modal-4').find('.modal-body').html(app);


        $('#modal-4').modal('show');


    }
});









