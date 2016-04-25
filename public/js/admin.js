$(document).ready(function(){
    $('.adminDeleteCommittee').on("click", function (e) {

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
                url: delete_member_admin_url + '/' + record_id
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

    $('.adminUpdateMember').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = update_member_admin_url + '/' + id;
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

                $('#memberModal').modal('hide');
                location.reload();
            } else {

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
        var url = update_team_admin_url + '/' + id;
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
                $('#teamModal').modal('hide');
                location.reload();
            } else {
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
                url: delete_team_admin_url + '/' + record_id
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


    $('.updateTeamMember').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var url = update_teamMember_admin_url + '/' + id;
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
            if (data.status == 'success') {
                //var successMsg = returnSuccess(data);

                $('#teamMemberModal').modal('hide');
                location.reload();
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
                url: delete_teamMember_admin_url + '/' + record_id
            }).done(function (data) {

                swal("Deleted!", "Your record was successfully deleted!", "success");
                location.reload();
                //if(rowIndex == 1){
                //    $('#team-member-list').remove();
                //}
                //row.remove();

            }).error(function (data) {
                swal("Oops", "We couldn't delete your record!", "error");
            });
            return;
        });
    });


    $('.register-modal').on('click', function(){
        $('#registerModal').modal('show');
        return;
    });


    $('#modal-register-submit').on('click', function(){
        $('.register-form').submit();

    });

    $('.register-form').on('submit', function(e){
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
                "organization_id": $('#organization_id').val(),
                "registration_no": $('#registration_no').val(),
            },
            dataType: "json"
        })
        .done(function (data) {

            if (data.status == 'success') {

                $('#registerModal').modal('hide');
                location.reload();
            } else if (data.status == 'danger' ){
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


    $('.decline-button').on('click', function(e){
        e.preventDefault();

        swal({
            title: "Are you sure?",
            text: "You want to decline this organization!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, decline it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function () {
            $.ajax({
                //method: "PATCH",
                url:  $(this).prop('action'),
                //data: {
                //    "_token": $(this).find('input[name=_token]').val(),
                //    "organization_id": $('#organization_id').val(),
                //},
                //dataType: "json"
            }).done(function (data) {
                $(this).submit();

                swal("Deleted!", "Your record was successfully declined!", "success");
                location.reload();

            }).error(function (data) {
                swal("Oops", "We couldn't process your request!", "error");
            });
            return;
        });

    });
});