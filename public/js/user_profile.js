
$('#example').DataTable({
    "scrollX": true
});



$('table').on('click','.delete',function (e){
    e.preventDefault();
    var id = $(this).attr('id');
    var token= $('meta[name="_token"]').attr('content');

    swal({
        title: "Are you sure?",
        text: "you want to delete the user !",
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
                url: "delete-user",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id': id,
                    '_token':token
                },
                success: function (s) {

                    swal({
                        title: "The User Is Successfully Deleted",
                        type: "success",
                        confirmButtonColor: "#DD6B55  ",
                        confirmButtonText: "OK",
                        closeOnConfirm: false,
                    }, function (isConfirm) {
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
