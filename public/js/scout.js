$(document).ready(function(){

    $('.check-all').on('click', function () {

        if ($(this).is(':checked')) {
            $('.check-row input[type=checkbox]').prop('checked', true);
            $(this).each(function () {
                if ($(this).is(':checked')) {
                    $('#delete-submit').css('display', 'inline-block');
                }
            });

        } else {

            $('.check-row input[type=checkbox]').prop('checked', false);
            $(this).each(function(){
                if($(this).not(':checked')) {
                    $('#delete-submit').css('display', 'none');
                }
            });
        }
    });

    $('.check-row input[type=checkbox]').on('click', function () {

        $(this).each(function() {

            if($(this).is(':checked')) {

                $('#delete-submit').css('display', 'inline-block');

            } else {

                $('#delete-submit').css('display', 'none');
            }
        });
    });

    $('#district-create-form').on('submit', function(e) {
        e.preventDefault();

        $.post(
            $(this).prop('action'),
            {
                "_token": $(this).find('input[name=_token]').val(),
                "name": $('#district-name').val(),
                "district_code": $('#district-code').val()
            },
            function (data) {

                if(data.status == 'success') {

                    var successMsg = returnAlert(data);
                    $('#alert-placeholder').html(successMsg);

                }else{

                    var errorMsg = returnAlert(data);
                    $('#alert-placeholder').html(errorMsg);
                }
            },
            'json'
        );
        return false;
    });
    $('#delete-submit').on('click', function(event){

        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "The record has been deleted.", "success");
                $('#remove_many_districts').submit();

            } else {
                swal("Cancelled", "The record is safe.)", "error");
            }
        });
    });

    function confirmRemove(event){

        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: true
            },
        function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "The record has been deleted.", "success");
            } else {
                swal("Cancelled", "The record is safe.)", "error");
            }
        });
    }

    function returnAlert(data){
        var output = '<div class="alert alert-'+ data.status + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Great!</h4>' + data.msg +
        '</div>';
        return output;
    }


});



