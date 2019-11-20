/**
 * Created by Awlad on 6/13/2017.
 */

$("#date").datepicker({
    changeMonth: true,
    changeYear: true,
    maxDate:0
});

$(".create").click(function (e) {

    e.preventDefault();

    $("#username").css({border: "1px solid #ddd"});
    $("#user").css({border: "1px solid #ddd"});
    $("#english").css({border: "1px solid #ddd"});
    $("#date").css({border: "1px solid #ddd"});
    $("#phone").css({border: "1px solid #ddd"});
    $("#clas").css({border: "1px solid #ddd"});
    $("#address").css({border: "1px solid #ddd"});
    $("#email").css({border: "1px solid #ddd"});
    $("#password").css({border: "1px solid #ddd"});
    $("#password1").css({border: "1px solid #ddd"});
    $("#leave").css({border: "1px solid #ddd"});

    var token = $(".create_user").find("input[name='_token']").val();
    var username = $(".create_user").find("input[name='username']").val();
    var gender= $(".create_user").find("input[name='gender']").val();
    var date= $(".create_user").find("input[name='date']").val();
    var user = $(".create_user").find("select[name='user']").val();
    var name_e = $(".create_user").find("input[name='english']").val();
    var phone = $(".create_user").find("input[name='phone']").val();
    var clas = $(".create_user").find("select[name='clas']").val();
    var address = $(".create_user").find("input[name='address']").val();
    var email = $(".create_user").find("input[name='email']").val();
    var password = $(".create_user").find("input[name='password']").val();
    var password1 = $(".create_user").find("input[name='password1']").val();
    var leave = $(".create_user").find("input[name='leave']").val();


    var $container = $("html,body");
    var atposition = email.indexOf("@");
    var dotposition = email.lastIndexOf(".");

    if (username == '' || username == null) {
        var $scrollTo = $('.div1');
        $("#username").css({border: "1px solid #e07467"});
        $container.animate({
                scrollTop: $(".div1")
            },
            'slow');
    }

    else if (user == '') {
        $("#user").css({border: "1px solid #e07467"});
        $('html,body').animate({
                scrollTop: $(".div1")
            },
            'slow');

    }
    else if (date == '') {
        $("#date").css({border: "1px solid #e07467"});
        $('html,body').animate({
                scrollTop: $(".div8")
            },
            'slow');

    }



    else if (name_e == '') {
        $("#english").css({border: "1px solid #e07467"});
        $('html,body').animate({
                scrollTop: $(".div2")
            },
            'slow');
    }

    else if (phone == '' || isNaN(phone) || (phone.length < 7)) {

        if (phone == '') {
            $("#phone").css({border: "1px solid #e07467"});
            $('html,body').animate({
                    scrollTop: $(".div3")
                },
                'slow');
        }
        else {
            $("#phone").css({border: "1px solid #e07467"});
            $('html,body').animate({
                    scrollTop: $(".div3")
                },
                'slow');
            $('.wrong').html(' <div  class="alert alert-danger wrong_pass"><p>Please Enter a valid phone number</p></div>');
        }

    }
    else if (clas == '') {
        $("#clas").css({border: "1px solid #e07467"});
        $('html,body').animate({
                scrollTop: $(".div3")
            },
            'slow');
        $('.wrong').html('');
    }
    else if (address == '') {
        var $scrollTo = $('.div4');

        $("#address").css({border: "1px solid #e07467"});
        $('html,body').animate({
                scrollTop: $(".div4")
            },
            'slow');
        $('.wrong').html('');
    }


    else if (email == '' || (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length)) {
        $('.wrong').html('');

        if (email == '')
            $("#email").css({border: "1px solid #e07467"});
        else {
            $("#email").css({border: "1px solid #e07467"});
            $('.wrong').html(' <div  class="alert alert-danger wrong_pass"><p>Please Enter a valid E-mail Id </p></div>');
        }

    }
    else if (leave == '' ) {

        $("#leave").css({border: "1px solid #e07467"});
    }

    else if (password == '' || (password < 4)) {
        $('.wrong').html('');
        var $scrollTo = $('.div6');

        if (password == '')
            $("#password").css({border: "1px solid #e07467"});
        else {
            $("#password").css({border: "1px solid #e07467"});
            $('.wrong').html(' <div  class="alert alert-danger wrong_pass"><p>Minimum 4 Charecter Required ! </p></div>');
        }


    }
    else if (password != password1) {

        var password1 = $(".create_user").find("input[name='password1']").val('');
        $('.wrong').html(' <div  class="alert alert-danger wrong_pass"><p>Password Must Be Same!</p></div>');

    }

    else {

        swal({
            title: "Are you sure?",
            text: "you want to add a new user !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function (isConfirm) {
            $(".loader").addClass("is-active");

            if (isConfirm) {
                $.ajax({
                    type: "post",
                    url: "createnew",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'user':user,
                        'userName': username,
                        'fullName': name_e,
                        'phoneNo': phone,
                        'class': clas,
                        'leave':leave,
                        'date_of_birth':date,
                        'gender':gender,
                        'image': "avatar.jpg",
                        'address': address,
                        'email': email,
                        'password': password,
                        '_token':token
                    },
                    success: function (s) {
                        console.log(s);
                        $(".loader").removeClass("is-active");
                        if(s=='fail'){
                            $('.wrong').html('');
                            swal({
                                title: "Email already exists",
                                type: "error",
                                confirmButtonColor: "#DD6B55  ",
                                confirmButtonText: "OK",
                                closeOnConfirm: true
                            });
                            $(".create_user").find("input[name='email']").val('');
                            $("#email").css({border: "1px solid #e07467"});

                        }
                        else if(s=='not send'){
                            console.log(s)
                            $('.wrong').html('');
                            swal({
                                title: "E-leave mail is disable.Resend code after enable mail.",
                                type: "error",
                                confirmButtonColor: "#DD6B55  ",
                                confirmButtonText: "OK",
                                closeOnConfirm: true
                            });

                        }
                        else{
                            $('.wrong').html('');
                            swal({
                                title: "New User Added Successfully",
                                type: "success",
                                confirmButtonColor: "#DD6B55  ",
                                confirmButtonText: "OK",
                                closeOnConfirm: false,
                            }, function (isConfirm) {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                $('.wrong').html('');
                swal({
                    title: "Canceled",
                    type: "error",
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "OK",
                    closeOnConfirm: true
                });
            }
        });


    }

});