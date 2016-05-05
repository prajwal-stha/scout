jQuery(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();
    $('#delete-submit').prop('disabled', true);

    $('.check-all').on('change', function () {
        if ($(this).is(':checked')) {
            $('.check-row').prop('checked', true);
            $('#delete-submit').prop('disabled', $('.check-row:checked').length == 0);
            return;
        }
        else{
            $('.check-row').prop('checked', false);
            $('#delete-submit').prop('disabled', $('.check-row:checked').length == 0);
            return;

        }

    });

    $('.check-row').on('change', function(){
        if ($(this).is(':checked')) {

            $('#delete-submit').prop('disabled', $('.check-row:checked').length == 0);
            return;

        } else {
            $('#delete-submit').prop('disabled', $('.check-row:checked').length == 0);
            return;
        }

    });


    //$('#district-create-form').on('submit', function (e) {
    //    e.preventDefault();
    //
    //    $.post(
    //        $(this).prop('action'),
    //        {
    //            "_token": $(this).find('input[name=_token]').val(),
    //            "name": $('#district-name').val(),
    //            "district_code": $('#district-code').val()
    //        },
    //        function (data) {
    //
    //            if (data.status == 'success') {
    //                console.log(data);
    //
    //                var successMsg = returnSuccess(data);
    //                $('#alert-placeholder').html(successMsg);
    //                //var row = '<tr><td class="check-row"><input name="action_to[]" type="checkbox" value="' + data.district.id + '"></td><td>' + data.district.district_code + '</td><td> ' + data.district.name + '</td><td>' +
    //                //    '<a class="updateDistrict" data-id="' + data.district.id + '" href="' + update_url + '/' + data.district.id + '"><i class="fa fa-pencil"></i></a> | ' +
    //                //    '<a class="deleteDistrict" data-id="' + data.district.id + '" href="' + delete_url + '/' + data.district.id + '"><i class="fa fa-trash-o"></i></a></td></tr>';
    //                //$('#list-districts').prepend(row);
    //                $('#table-districts').load(index_url + ' #list-districts' );
    //                //$('#table-districts').load(district_url + ' #list-districts' );
    //
    //                $('#district-create-form').trigger('reset');
    //
    //            } else {
    //
    //                var errorMsg = returnAlert(data);
    //                $('#alert-placeholder').html(errorMsg);
    //            }
    //        },
    //        'json'
    //    );
    //    return false;
    //});

    $('#delete-submit').on('click', function (event) {

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


        //$.post(
        //    $(this).prop('action'),
        //    {
        //        "_token": $(this).find('input[name=_token]').val(),
        //        "id": $('#update-district-id').val(),
        //        "name": $('#update-district-name').val(),§
        //        "district_code": $('#update-district-code').val()
        //    },
        //    function (data) {
        //
        //        if (data.status == 'success') {
        //            console.log(data);
        //
        //            //var successMsg = returnSuccess(data);
        //            //$('#alert-placeholder').html(successMsg);
        //            //var row = '<tr><td class="check-row"><input name="action_to[]" type="checkbox" value="' + data.district.id + '"></td><td>' + data.district.district_code + '</td><td> ' + data.district.name + '</td><td>' +
        //            //    '<a class="updateDistrict" data-id="' + data.district.id + '" href="' + update_url + '/' + data.district.id + '"><i class="fa fa-pencil"></i></a> | ' +
        //            //    '<a class="deleteDistrict" data-id="' + data.district.id + '" href="' + delete_url + '/' + data.district.id + '"><i class="fa fa-trash-o"></i></a></td></tr>';
        //            //$('#list-districts').prepend(row);
        //            $('#table-districts').load(index_url + ' #list-districts' );
        //            //$('#table-districts').load(district_url + ' #list-districts' );
        //
        //            $('#district-create-form').trigger('reset');
        //
        //        } else {
        //
        //            var errorMsg = returnAlert(data);
        //            $('#modal-alert-placeholder').html(errorMsg);
        //        }
        //    },
        //    'json'
        //);
        //return false;





    $('.deleteMember').on("click", function (e) {

        var record_id = $(this).attr('data-id');
        var row       = $(this).closest('tr');
        var rowIndex  = $('#table-member tr').index(row);

        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function () {
            $.ajax({
                url: delete_member_url + '/' + record_id
            }).done(function (data) {

                swal("Deleted!", "Your record was successfully deleted!", "success");
                if(rowIndex == 1){
                    $('#remove_many_members').remove();
                }
                row.remove();

            }).error(function (data) {
                swal("Oops", "We couldn't delete your record!", "error");
            });
            return;
        });
    });

    $('#delete-member').on('click', function (event) {

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
                $('#remove_many_members').submit();

            } else {
                swal("Cancelled", "The record is safe.)", "error");
            }
        });
    });

    $('.deleteTeam').on("click", function (e) {

        var record_id = $(this).attr('data-id');
        var row = $(this).closest('tr');
        var rowIndex = $('#teams-list tr').index(row);

        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function () {
            $.ajax({
                url: delete_team_url + '/' + record_id
            }).done(function (data) {

                swal("Deleted!", "Your record was successfully deleted!", "success");
                if(rowIndex == 1){
                    $('#teams-list').remove();
                }
                row.remove();

            }).error(function (data) {
                swal("Oops", "We couldn't delete your record!", "error");
            });
            return;
        });

    });

    function returnSuccess(data) {
        var output = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Great!</h4>' + data.msg +
            '</div>';
        return output;
    }

    function returnAlert(data) {
        var output = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Whoops!</h4>' + data.msg + '</ul></div>';
        return output;
    }

    function confirmRemove(event) {

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
                $(this).trigger("click");
            } else {
                swal("Cancelled", "The record is safe.)", "error");
            }
        });
    }

    $('.updateMember').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = update_member_url + '/' + id;
        if (id) {
            $.get(url).done(function (data) {
                $('#f_name').val(data.member.f_name);
                $('#m_name').val(data.member.m_name);
                $('#l_name').val(data.member.l_name);
                $('#update-member-org-id').val(data.member.organization_id);
                $('#update-member-id').val(id);
            });
            $('#memberModal').modal('show');
            return;
        }
    });

    $('#modal-member-submit').on('click', function () {
        $('.update-member-form').submit();
    });

    $('.update-member-form').on('submit', function(e) {
        e.preventDefault();
        $( '.error-message' ).each(function( ) {
            $(this).removeClass('make-visible');
            $(this).html('');
        });

        $( 'input' ).each(function( ) {
            $(this).removeClass('has-error');
        });
        var current_form = $(this);
        $.ajax({
            method: "PATCH",
            url: $(this).prop('action'),
            data: {
                "_token": $(this).find('input[name=_token]').val(),
                "id": $('#update-member-id').val(),
                "f_name": $('#f_name').val(),
                "m_name": $('#m_name').val(),
                "l_name": $('#l_name').val(),
                "organization_id": $('#update-member-org-id').val()
            },
            dataType: "json"
        })
        .done(function (data) {
            if (data.status == 'success') {
                var successMsg = returnSuccess(data);

                $('#memberModal').modal('hide');
                window.location.href = index_member_url;
            } else {
                //var errorMsg = returnAlert(data);
                //$('.alert-placeholder').html(errorMsg);
                for (var key in data.msg) {
                    // skip loop if the property is from prototype
                    if (!data.msg.hasOwnProperty(key)) continue;
                    var error_message = data.msg[key];
                    var parent = current_form.find('#' + key).parent();
                    current_form.find('#' + key).addClass('has-error');

                    parent.find('.error-message').addClass('make-visible').html(error_message);
                }
            }
        });
    });

    $('.updateTeam').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = update_team_url + '/' + id;
        if (id) {
            $.get(url).done(function (data) {
                $('#name').val(data.team.name);
                $('#update-team-org-id').val(data.team.organization_id);
                $('#update-team-id').val(id);
            });
            $('#teamModal').modal('show');
            return;
        }
    });

    $('#modal-team-submit').on('click', function () {
        $('.update-team-form').submit();
    });


    $('.update-team-form').on('submit', function(e){
        e.preventDefault();
        $( '.error-message' ).each(function( ) {
            $(this).removeClass('make-visible');
            $(this).html('');
        });

        $( 'input' ).each(function( ) {
            $(this).removeClass('has-error');
        });

        var current_form = $(this);

        $.ajax({
            method: "PATCH",
            url: $(this).prop('action'),
            data: {
                "_token": $(this).find('input[name=_token]').val(),
                "id": $('#update-team-id').val(),
                "name": $('#name').val(),
                "organization_id": $('#update-team-org-id').val()
            },
            dataType: "json"
        })
        .done(function (data) {
            if (data.status == 'success') {
                var successMsg = returnSuccess(data);
                $('#teamModal').modal('hide');
                window.location.href = index_team_url;
            } else {
                //var errorMsg = returnAlert(data);
                //$('.alert-placeholder').html(errorMsg);
                for (var key in data.msg) {
                    // skip loop if the property is from prototype
                    if (!data.msg.hasOwnProperty(key)) continue;
                    var error_message = data.msg[key];
                    var parent = current_form.find('#' + key).parent();
                    current_form.find('#' + key).addClass('has-error');

                    parent.find('.error-message').addClass('make-visible').html(error_message);
                }
            }
        });
    });


    $('.updateTeamMember').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = update_teamMember_url + '/' + id;
        if (id) {
            $.get(url).done(function (data) {
                $('#teamMemberId').val(id);
                $('#f_name').val(data.teamMember.f_name);
                $('#m_name').val(data.teamMember.m_name);
                $('#l_name').val(data.teamMember.l_name);
                $('#dob').val(data.teamMember.dob);
                $('#entry_date').val(data.teamMember.entry_date);
                $('#position').val(data.teamMember.position);
                $('#passed_date').val(data.teamMember.passed_date);
                $('#note').val(data.teamMember.note);
            });
            $('#teamMemberModal').modal('show');
            return;
        }
    });

    $('#modal-teamMember-submit').on('click', function () {
        $('.update-teamMember-form').submit();
    });

    $('.update-teamMember-form').on('submit', function(e){
        e.preventDefault();

        $( '.error-message' ).each(function( ) {
            $(this).removeClass('make-visible');
            $(this).html('');
        });

        $( 'input' ).each(function( ) {
            $(this).removeClass('has-error');
        });
        var current_form = $(this);
        $.ajax({
            method: "PATCH",
            url: $(this).prop('action'),
            data: {
                "_token": $(this).find('input[name=_token]').val(),
                "id": $('#teamMemberId').val(),
                "f_name": $('#f_name').val(),
                "m_name": $('#m_name').val(),
                "l_name": $('#l_name').val(),
                "dob": $('#dob').val(),
                "entry_date": $('#entry_date').val(),
                "position": $('#position').val(),
                "passed_date": $('#passed_date').val(),
                "note": $('#note').val(),
                "team_id": $('#team_id').val()
            },
            dataType: "json"
        })
        .done(function (data) {
            console.log(data);
            if (data.status == 'success') {
                var successMsg = returnSuccess(data);

                $('#teamMemberModal').modal('hide');
                window.location.reload(true);
            } else {
                //var errorMsg = returnAlert(data);
                //$('.alert-placeholder-member').html(errorMsg);
                for (var key in data.msg) {
                    // skip loop if the property is from prototype
                    if (!data.msg.hasOwnProperty(key)) continue;
                    var error_message = data.msg[key];
                    var parent = current_form.find('#' + key).parent();
                    current_form.find('#' + key).addClass('has-error');

                    parent.find('.error-message').addClass('make-visible').html(error_message);
                }
            }
        });

    });

    $('.deleteTeamMember').on("click", function (e) {

        var record_id = $(this).attr('data-id');
        var row = $(this).closest('tr');
        var rowIndex = $('#team-member-list tr').index(row);

        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function () {
            $.ajax({
                url: delete_teamMember_url + '/' + record_id
            }).done(function (data) {

                swal("Deleted!", "Your record was successfully deleted!", "success");
                if(rowIndex == 1){
                    $('#team-member-list').remove();
                }
                row.remove();

            }).error(function (data) {
                swal("Oops", "We couldn't delete your record!", "error");
            });
            return;
        });
    });

    $('#create_team_member').on('click', function(e){

        e.preventDefault();
        if(!$('#team_id').val()){
            sweetAlert("Error...", "Please create team first!", "error");

        }else{
            $(this).unbind('click').click();
        }
    });


});