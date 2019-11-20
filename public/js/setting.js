
$('.start').click(function (e) {
    e.preventDefault();
    $("#day").css({border: "1px solid #ddd"});
    var day = $(".new_year").find("input[name='day']").val();
    var checkbox =$(".new_year").find("input[name='checkbox']").is(":checked");;
    var token = $('input[name=_token]').val();

    if(day=='' || day<1){
        $("#day").css({border: "1px solid #e07467"});
    }

    else{
        swal({
            title: "Are you sure?",
            text: "you want to start a calendar year !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "post",
                    url: "setting",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'day': day,
                        'checkbox':checkbox,
                        _token:token
                    },
                    success: function (s) {
                        $(".new_year").find("input[name='day']").val('');
                        $("#day").css({border: "1px solid #ddd"});

                        swal({
                            title: "successfully done",
                            type: "success",
                            confirmButtonColor: "#DD6B55  ",
                            confirmButtonText: "OK",
                            closeOnConfirm: true,
                        });

                        $('.confirm').click(function () {
                            location.reload();
                        });
                    }
                });
            } else {
                swal({
                    title: "Canceled",
                    type: "error",
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                });
                $(".new_year").find("input[name='day']").val('');
                $("#day").css({border: "1px solid #ddd"});

            }
        });
    }
});

$('form').on('click','.add',function (e) {
    e.preventDefault();

    $("#designation").css({border: "1px solid #ddd"});

    var des = $(".add_des").find("input[name='designation']").val();
    var token = $('input[name=_token]').val();

    var letters =/^[a-zA-Z\s]+$/;

        if(des=='' || (!des.match(letters))){
        $("#designation").css({border: "1px solid #e07467"});
    }

    else{
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "post",
                    url: "add_des",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'des':des,
                        _token: token
                    },
                    success: function (s) {
                        $(".add_des").find("input[name='designation']").val('');
                        $("#designation").css({border: "1px solid #ddd"});

                        swal({
                            title: "successfully done",
                            type: "success",
                            confirmButtonColor: "#DD6B55  ",
                            confirmButtonText: "OK",
                            closeOnConfirm: true,
                        });
                        $('.confirm').click(function () {
                            location.reload();
                        });
                    }
                });
            } else {
                swal({
                    title: "Canceled",
                    type: "error",
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                });
                $(".add_des").find("input[name='designation']").val('');
                $("#designation").css({border: "1px solid #ddd"});

            }
        });
    }
});

$('.show').click(function (e) {
    e.preventDefault();
    var token = $('input[name=_token]').val();
    $.ajax({
        type: "post",
        url: "show_smtp",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            _token: token
        },
        success: function (s) {

            $('input[name=driver]').val(s[0]);
            $('input[name=host]').val(s[1]);
            $('input[name=port]').val(s[2]);
            $('input[name=username]').val(s[3]);
            $('input[name=password]').val(s[4]);
            $('input[name=enc]').val(s[5]);

            $('.show').addClass('hidden');
            $('.reset').addClass('hidden');
            $('.update').removeClass('hidden');
            $('.cancel').removeClass('hidden');
        }
    });
});

$('.update').click(function (e) {
    e.preventDefault();
    var token = $('input[name=_token]').val();
    var driver=$('input[name=driver]').val();
    var host=$('input[name=host]').val();
    var port=$('input[name=port]').val();
    var username=$('input[name=username]').val();
    var password=$('input[name=password]').val();
    var enc=$('input[name=enc]').val();

    $.ajax({
        type: "post",
        url: "update_smtp",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            driver:driver,
            host:host,
            port:port,
            username:username,
            password:password,
            enc:enc,
            _token: token
        },
        success: function (s) {
            swal({
                title: "Successfully Updated",
                type: "success",
                confirmButtonColor: "#DD6B55  ",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            });

            $('input[name=driver]').val('');
            $('input[name=host]').val('');
            $('input[name=port]').val('');
            $('input[name=username]').val('');
            $('input[name=password]').val('');
            $('input[name=enc]').val('');

            $('.show').removeClass('hidden');
            $('.reset').removeClass('hidden');
            $('.update').addClass('hidden');
            $('.cancel').addClass('hidden');
        }
    });
});

$('.cancel').click(function (e){
    e.preventDefault();
    location.reload();
});

$('.reset').click(function (e) {
    e.preventDefault();
    var token = $('input[name=_token]').val();

    swal({
        title: "Are you sure?",
        text: "you want to reset smtp setting !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55  ",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "post",
                url: "reset_smtp",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    _token: token
                },
                success: function (s) {
                    swal({
                        title: "Successfully Reset",
                        type: "success",
                        confirmButtonColor: "#DD6B55  ",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    });

                }
            });
        } else {
            swal({
                title: "Canceled",
                type: "error",
                confirmButtonColor: "#DD6B55  ",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            });
        }
    });


});


$('table').on('click','.delete',function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var token = $('table').find("input[name='_token']").val();


    swal({
        title: "Are you sure?",
        text: "you want to delete this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55  ",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type:"post",
                url:"delete_des",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id:id,
                    _token:token
                },
                success: function (s) {
                    swal({
                        title: "Successfully Deleted",
                        type: "success",
                        confirmButtonColor: "#DD6B55  ",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    });

                    $('.confirm').click(function () {
                        location.reload();
                    });


                }
            });
        } else {
            swal({
                title: "Canceled",
                type: "error",
                confirmButtonColor: "#DD6B55  ",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            });
        }
    });
});

$('table').on('click','.edit',function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var name = $(this).attr('name');
    $(".modal").find("input[name='des']").val(name);
    $(".modal").find("input[name='des_id']").val(id);

    $("#des").css({border: "1px solid #ddd"});
});

$('.modal').on('click','.edit_des',function (e) {
    e.preventDefault();
    var des=$(".modal").find("input[name='des']").val();
    var id=$(".modal").find("input[name='des_id']").val();
    var token=$(".modal").find("input[name='_token']").val();

    var letters =/^[a-zA-Z\s]+$/;

    if(des=='' || (!des.match(letters))){
        $("#des").css({border: "1px solid #e07467"});
    }


    else{
        swal({
            title: "Are you sure?",
            text: "you want to update this !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type:"post",
                    url:"edit_des",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        id:id,
                        des:des,
                        _token:token
                    },
                    success: function (s) {

                        $('#modal-4').hide();
                        swal({
                            title: "Successfully Updated",
                            type: "success",
                            confirmButtonColor: "#DD6B55  ",
                            confirmButtonText: "OK",
                            closeOnConfirm: true,
                        });

                        $('.confirm').click(function () {
                            location.reload();
                        });


                    }
                });
            } else {
                swal({
                    title: "Canceled",
                    type: "error",
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                });
            }
        });
    }


});
