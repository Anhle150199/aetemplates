const slidebar = $('#slidebar-1').val();

// Accept Request
$('#form-accept-request').on('submit', function (e) {
    e.preventDefault();
    const acceptEmail = $('#accept-email').val();
    const id = $('#accept-id').val();
    const acceptRole = $('#set-role-user').val();
    let table = $('#datatable-basic').DataTable();

    const data = {
        email: acceptEmail,
        role: acceptRole
    }
    const url = $(this).attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'put',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            if (slidebar == 'all-user')
                doneSetRoleUser(id, acceptRole);
            else
                doneAcceptRequest(id, table);
            $('#acceptModal').modal('hide');
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#error-accept-request').text(errors);
        }
    });

})
const doneSetRoleUser = (id, newRole) => {
    $('#role' + id).text(newRole);
}
const doneAcceptRequest = (id, table) => {
    table
        .row($('#' + id))
        .remove()
        .draw();
}
// Show modal accept
$('#acceptModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    const id = button.data('whatever')
    const recipient = $('#email' + id).text();
    const modal = $(this)
    modal.find('.modal-title').text('Set Role for \"' + recipient + '\"');
    $('#accept-email').val(recipient);
    $('#accept-id').val(id);
})

// Delete user
$('#form-delete-user').on('submit', function (e) {
    deleteAction(e, $('#form-delete-user'));
})
$('#form-delete-request').on('submit', function (e) {
    deleteAction(e, $('#form-delete-request'));
});
const deleteAction = (e, element) => {
    e.preventDefault();
    const deleteEmail = $('#delete-email').val();
    const id = $('#delete-id').val();
    let table = $('#datatable-basic').DataTable();

    const data = {
        email: deleteEmail,
    }
    const url = element.attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'delete',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            // doneSetRoleUser(id, 'deleted');
            if (slidebar == 'all-user')
                doneSetRoleUser(id, 'deleted');
            else
                doneAcceptRequest(id, table);

            $('#deleteModal').modal('hide');
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#error-delete-request').text(errors);
        }
    });
}
$('#deleteModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    const id = button.data('whatever')
    const recipient = $('#email' + id).text();
    const modal = $(this)
    modal.find('.modal-title').text('Are you sure delete \"' + recipient + '\" ?');
    $('#delete-email').val(recipient);
    $('#delete-id').val(id);
})

// add new user
var alertBlock =
    '<div class="alert alert-dismissible fade show" role="alert" id="alert-notification"><span id="alert-content"></span><button type="button" class="close" id="close-alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

$('#form-add-user').on('submit', function (e) {
    e.preventDefault();
    const name = $('#user-name').val();
    const email = $('#user-email').val();
    const role = $('#user-role').val();
    const password = $('#user-password').val();
    const passwordConfirm = $('#user-password-confirmation').val();
    const url = $(this).attr('action');
    const data = {
        name: name,
        email: email,
        role: role,
        password: password,
        password_confirmation: passwordConfirm
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'put',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data.status);
            $('#alert-block').html(alertBlock);
            $('#alert-notification').addClass('alert-success');
            $('#alert-content').text('Success ! Created account \"' + email + '\"');
            $('#form-add-user')[0].reset();
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#error-name').text(errors.name);
            $('#error-email').text(errors.email);
            $('#error-password').text(errors.password);
            $('#error-role').text(errors.role);
            setTimeout(() => {
                $('#error-name').text('');
                $('#error-email').text('');
                $('#error-password').text('');
                $('#error-role').text('');
            }, 10000);
        }
    });

})
