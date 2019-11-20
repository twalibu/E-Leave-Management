
$('#example').DataTable({
    "scrollX": true
});

function myFunction(data) {

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    var current_date = new Date(data);
    month_value = current_date.getMonth();
    day_value = current_date.getDate();
    year_value = current_date.getFullYear();

    return day_value + " " + months[month_value] + " " + year_value;
}

var token= $('meta[name="_token"]').attr('content')

$('table').on('click', '.show_btn', function () {
    var id = $(this).val();

    $.ajax({
        type: "post",
        url: "data_fetch",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            'id': id,
            '_token':token
        },
        success: function (s) {

            var remain = parseInt(s.remaining_leave);
            var emergency=parseInt(s.emergency_leave);

            var s_date = (s.start_date);
            var e_date = (s.end_date);
            var a_date = (s.app_date);
            var t = parseInt((s.total_day));



            var type, abc;
            if (s.type == 'Advance') {
                type = 'Leave in advance.'

                if (t == 1) {
                    abc = 'For why I need ' + t + ' day leave in ' + myFunction(s_date) + '.';
                }
                else
                    abc = 'For why I need ' + t + ' days leave from ' + myFunction(s_date) + ' to ' + myFunction(e_date) + '.';


            }
            else {

                type = 'Leave of absence.'

                if (t == 1) {
                    abc = 'For why I was unable to attend in ' + myFunction(s_date) + '.';
                }
                else
                    abc = 'For why I was unable to attend from ' + myFunction(s_date) + ' to ' + myFunction(e_date) + '.';

            }

            if (t > remain)
                var app = '<div class="modal-body"><div class="leave" style="margin:0 10% 10% 10%;"><p>To<br>' + s.send_to + '<br>Advance Engineering.<br>' + myFunction(a_date) + '<br><br> <strong>Subject : ' + type + '</strong><br><br><br>This is to inform you that I, ' + s.fullName + ' have been working as ' + s.class + ' in your company. ' + s.reason + '. ' + abc + ' <br><br>Hope you will consider my applcation. I will be very thankful to you for your favor. </p><br><br>Regards<br>' + s.fullName + '<br>' + s.class + '<br>Advance Engineering Solution.</div></div><div class="modal-footer"> <button style="float:left;" value="' + s.id + '" class="btn btn-flat button1-3d btn-raised btn-danger reject_btn">REJECT</button><button class="btn btn-flat button-3d pull-right btn-raised btn-success accept_btn" value="' + s.id + '" type="button"data-toggle="modal" >ACCEPT </button><div style="text-align: center;"><marquee><h5 style="text-align:center;color: red;">EMERGENCY APPLICATION.<br>ALREADY TAKEN '+emergency+' DAYS EMERGENCY LEAVE.</h5></marquee></div> </div>';

            else
                var app = '<div class="modal-body"><div class="leave" style="margin:0 10% 10% 10%;"><p>To<br>' + s.send_to + '<br>Advance Engineering.<br>' + myFunction(a_date) + '<br><br> <strong>Subject : ' + type + '</strong><br><br><br>This is to inform you that I, ' + s.fullName + ' have been working as ' + s.class + ' in your company. ' + s.reason + '. ' + abc + ' <br><br>Hope you will consider my applcation. I will be very thankful to you for your favor. </p><br><br>Regards<br>' + s.fullName + '<br>' + s.class + '<br>Advance Engineering Solution.</div></div><div class="modal-footer"> <button style="float:left;" value="' + s.id + '" class="btn btn-flat button1-3d btn-raised btn-danger reject_btn">REJECT</button><button class="btn btn-flat button-3d pull-right btn-raised btn-success accept_btn" value="' + s.id + '" type="button"data-toggle="modal" >ACCEPT </button><div style="text-align: center;"></div> </div>';

            $('#modal-4').find('.app_modal').html(app);

            $('#modal-4').modal('show');

        }
    });

});

$(".app_modal").on("click", ".accept_btn", function (e) {
    e.preventDefault();
    var id = $(this).val();
    $.ajax({
        type: "post",
        url: "accept_application",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            'id': id,
            '_token':token
        },
        success: function (s) {
            $('#modal-4').modal('hide');
            swal({
                title: "Application is Accepted",
                type: "success",
                confirmButtonColor: "#DD6B55  ",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }, function (isConfirm) {
                location.reload();
            });

        }
    });
});

$(".app_modal").on("click", ".reject_btn", function (e) {
    e.preventDefault();
    var id = $(this).val();
    $.ajax({
        type: "post",
        url: "reject_application",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            'id': id,
            '_token':token
        },
        success: function (s) {
            $('#modal-4').modal('hide');
            swal({
                title: "Application is Rejected",
                type: "error",
                confirmButtonColor: "#DD6B55  ",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            }, function (isConfirm) {
                location.reload();
            });

        }
    });

});

