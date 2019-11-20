

$('#sel2').on('change', function() {

    $('.apply_form').removeClass('hidden');
    var form_type = $("#sel2 :selected").attr('value');

    if(form_type=='Advance'){
        $('.abs').addClass('hidden');
        $( "#app_day" ).datepicker({
            minDate: 0,
            onSelect: function(date) {
                adStart();
                $("#start_day").datepicker('option', 'minDate', date);
            }
        });

        function adStart() {
            $("#start_day").datepicker({
                onSelect: function(date) {
                    adDate();
                    $("#end_day").datepicker('option', 'minDate', date);
                }
            });
        }


        function adDate() {
            $("#end_day").datepicker({});
        }
    }

    else{
        $('.adv').addClass('hidden');
        $( "#app_day" ).datepicker({
            minDate: 0,
            onSelect: function(date) {
                abStart()
                $("#start_day").datepicker('option', 'maxDate', date);
            }
        });

        function abStart() {
            $("#start_day").datepicker({
                onSelect: function(date) {
                    abDate();
                    $("#end_day").datepicker('option', 'minDate', date);
                }
            });
        }


        function abDate() {
            startAb = $(".app_form").find("input[name='app_date']").val();

            $("#end_day").datepicker({
                maxDate:startAb,
            });
        }
    }

});



$('.send_data').click(function (e) {
    e.preventDefault();
    var token = $('input[name=_token]').val();



    if(diff>day){
        swal({
            title: "EMERGENCY LEAVE",
            text: "you have "+day+" remaining day for leave !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                var type='emergency';
                $.ajax({
                    type:"post",
                    url:"data_send",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{
                        'type':type,
                        'app_type':app_type,
                        'authority':authority1,
                        'start':start,
                        'end':end,
                        'app_date':app_date,
                        'diff':diff,
                        'reason':reason,
                        '_token':token

                    },
                    success:function(s){

                        $('#modal-4').modal('hide');
                        swal({
                            title: "Successfully Sent For Approval",
                            type: "success",
                            confirmButtonColor: "#DD6B55  ",
                            confirmButtonText: "OK",
                            closeOnConfirm: true,
                        });

                        $(".sweet-alert").on("click",".confirm",function(e) {

                            location.reload();

                        });
                    }
                });

            } else {
                $('#modal-4').modal('hide');
            }
        });
    }
    else{
        var type='normal';

        $.ajax({
            type:"post",
            url:"data_send",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data:{
                'type':type,
                'app_type':app_type,
                'authority':authority1,
                'start':start,
                'end':end,
                'app_date':app_date,
                'diff':diff,
                'reason':reason,
                '_token':token
            },
            success:function(s){
                $('#modal-4').modal('hide');
                swal({
                    title: "Successfully Sent For Approval",
                    type: "success",
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                });

                $(".sweet-alert").on("click",".confirm",function(e) {

                    location.reload();
                });
            }
        });

    }



});

