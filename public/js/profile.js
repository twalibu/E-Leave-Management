

$("#dob").datepicker({
    changeMonth: true,
    changeYear: true,
    maxDate:0
});

$('.info_update').click(function (e) {
    e.preventDefault();
    var token= $(".edit_info").find("input[name='_token']").val();
    var id= $(".edit_info").find("input[name='id']").val();
    var fullName= $(".edit_info").find("input[name='fullName']").val();
    var designation= $(".edit_info").find("select[name='designation']").val();
    var dob= $(".edit_info").find("input[name='dob']").val();
    var gender= $(".edit_info").find("select[name='gender']").val();
    var address= $(".edit_info").find("input[name='address']").val();
    var role= $(".edit_info").find("select[name='role']").val();
    var username= $(".edit_info").find("input[name='username']").val();
    var email= $(".edit_info").find("input[name='email']").val();
    var phone= $(".edit_info").find("input[name='phone']").val();
    var letters = /^[a-zA-Z\s]+$/;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(fullName!='' || designation!='' || dob!='' || gender!='' || address!='' || role!='' || username!='' || email!='' || phone!=''){

        if(username.match(letters)){
            if(fullName.match(letters)){
                if(email.match(mailformat)){
                    swal({
                        title: "ARE YOU SURE!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55  ",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type:"post",
                                url:"update",
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data:{
                                    'id':id,
                                    'fullName':fullName,
                                    'designation':designation,
                                    'dob':dob,
                                    'gender':gender,
                                    'address':address,
                                    'role':role,
                                    'username':username,
                                    'email':email,
                                    'phone':phone,
                                    '_token':token
                                },
                                success:function(s){

                                    if(s=='done'){
                                        swal({
                                            title: "Successfully Updated Info",
                                            type: "success",
                                            confirmButtonColor: "#DD6B55  ",
                                            confirmButtonText: "OK",
                                            closeOnConfirm: true,
                                        });
                                        $('.input_val').html('');
                                        $(".edit_info").find("input[name='id']").val(id);
                                        $(".edit_info").find("input[name='fullName']").val(fullName);
                                        $(".edit_info").find("select[name='designation']").val(designation);
                                        $(".edit_info").find("input[name='dob']").val(dob);
                                        $(".edit_info").find("select[name='gender']").val(gender);
                                        $(".edit_info").find("input[name='address']").val(address);
                                        $(".edit_info").find("select[name='role']").val(role);
                                        $(".edit_info").find("input[name='username']").val(username);
                                        $(".edit_info").find("input[name='email']").val(email);
                                        $(".edit_info").find("input[name='phone']").val(phone);


                                    }
                                    else{
                                        s=JSON.parse(s);
                                        swal({
                                            title: "Email already exists",
                                            type: "error",
                                            confirmButtonColor: "#DD6B55  ",
                                            confirmButtonText: "OK",
                                            closeOnConfirm: true,
                                        });
                                        $('.input_val').html('');
                                        $(".edit_info").find("input[name='id']").val(s[0].id);
                                        $(".edit_info").find("input[name='fullName']").val(s[0].fullName);
                                        $(".edit_info").find("select[name='designation']").val(s[0].class);
                                        $(".edit_info").find("input[name='dob']").val(s[0].date_of_birth);
                                        $(".edit_info").find("select[name='gender']").val(s[0].gender);
                                        $(".edit_info").find("input[name='address']").val(s[0].address);
                                        $(".edit_info").find("select[name='role']").val(s[1]);
                                        $(".edit_info").find("input[name='username']").val(s[0].userName);
                                        $(".edit_info").find("input[name='email']").val(s[0].email);
                                        $(".edit_info").find("input[name='phone']").val(s[0].phoneNo);
                                    }

                                }
                            });

                        }
                    });
                }else{
                    $('.input_val').html('<p style="color: brown">invalid Email</p>');
                }
            }else{
                $('.input_val').html('<p style="color: brown">Please input alphabet characters only</p>');
            }
        }else{
            $('.input_val').html('<p style="color: brown">Please input alphabet characters only</p>');
        }
    }


});

$('.submit_pass').click(function (e) {
    e.preventDefault();

    var token= $(".edit_password").find("input[name='_token']").val();
    var cpassword= $(".edit_password").find("input[name='cpassword']").val();
    var npassword= $(".edit_password").find("input[name='npassword']").val();
    var confirmpassword= $(".edit_password").find("input[name='confirmpassword']").val();
    if(cpassword==''){
        $('.wrong').html('<p style="color: palevioletred;">Enter Your Current Password!</p>');
    }
    else if(npassword==''){
        $('.wrong').html('<p style="color: palevioletred;">Enter Your New Password!</p>');
    }
    else if(npassword!=confirmpassword){
        $('.wrong').html('<p style="color: palevioletred;">Confirm Password Not Match!</p>');
        var confirmpassword= $(".edit_password").find("input[name='confirmpassword']").val('');
    }
    else{

        swal({
            title: "ARE YOU SURE!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type:"post",
                    url:"change_password",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{
                        'current_password':cpassword,
                        'new_password':npassword,
                        '_token':token
                    },
                    success:function(s){
                        if(s=='success'){
                            swal({
                                title: "Successfull",
                                type: "success",
                                confirmButtonColor: "#DD6B55  ",
                                confirmButtonText: "OK",
                                closeOnConfirm: true,
                            });
                            $(".edit_password").find("input[name='cpassword']").val('');
                            $(".edit_password").find("input[name='npassword']").val('');
                            $(".edit_password").find("input[name='confirmpassword']").val('');
                        }
                        else{
                            swal({
                                title: "Wrong Current Password",
                                type: "error",
                                confirmButtonColor: "#DD6B55  ",
                                confirmButtonText: "OK",
                                closeOnConfirm: true,
                            });
                        }

                    }
                });

            } else {
                $(".edit_password").find("input[name='cpassword']").val('');
                $(".edit_password").find("input[name='npassword']").val('');
                $(".edit_password").find("input[name='confirmpassword']").val('');
            }
        });
    }


});
