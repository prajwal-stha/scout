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
                    console.log(data);

                    var successMsg = returnSuccess(data);
                    $('#alert-placeholder').html(successMsg);
                    var row = '<tr><td class="check-row"><input name="action_to[]" type="checkbox" value="' + data.district.id + '"></td><td>' + data.district.district_code + '</td><td> ' + data.district.name + '</td><td>' +
                        '<a data-toggle="modal" data-target="#districtModal"><i class="fa fa-pencil"></i></a> | ' +
                        '<a class="deleteDistrict" data-id="'+ data.district.id + '" href="' + delete_url +'/' +  data.district.id + '"><i class="fa fa-trash-o"></i></a></td></tr>';
                    $('#list-districts').prepend(row);

                    $('#district-create-form').trigger('reset');

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


    $('#modal-submit').on('click', function(){
        $('#districtModal').modal('hide');
    });


    function returnSuccess(data){
        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Great!</h4>' + data.msg +
        '</div>';
        return output;
    }

    function returnAlert(data){
        var output = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Whoops!</h4>' + data.msg + '</ul></div>';
        return output;
    }


});



