
// Update info user
$('#updateInfo').on('submit', function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let data = {
        name: $('#name').val(),
        email: $('#email').val(),
    }
    let url = $('#updateInfo').attr('action');

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#info-success').text(data.msg);
            $('#name-user-topnav').text(data.name);
            $('#name-user').text(data.name);
            $('#error-name').text("");
            $('#error-email').text("");

            setTimeout(function () {
                $('#info-success').text("");
            }, 5000);
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if (errors.name) {
                $('#error-name').text(errors.name);
            }
            if (errors.email) {
                $('#error-email').text(errors.email);
            }
            setTimeout(function () {
                $('#error-name').text("");
                $('#error-email').text("");
            }, 5000);
        }
    });

    return false;
});

// Update password
$('#updatePassword').on('submit', function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let data = {
        current_password: $('#current_password').val(),
        password: $('#password').val(),
        password_confirmation: $('#password_confirmation').val(),
        _token: $("input[name=_token]").val()
    }
    let url = $('#updatePassword').attr('action');

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#password-success').text(data.msg);
            setTimeout(function () {
                $('#password-success').text("");
            }, 5000);
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#password-success').text("");
            if (errors.current_password) {
                $('#error-current-password').text(errors.current_password);
            }
            if (errors.password) {
                $('#error-password').text(errors.password);
            }
            if (errors.password_confirmation) {
                $('#error-password-confirmation').text(errors.password_confirmation);
            }
            setTimeout(function () {
                $('#error-current-password').text("");
                $('#error-password').text("");
                $('#error-password-confirmation').text("");
            }, 5000);
        }
    });
    return false;
});

// upload avatar
$('#btn-upload-avatar').click(function () {
    $('#input-avatar').click();
});
$('#input-avatar').change(() => {
    let match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];
    let file_data = $('#input-avatar').prop('files')[0];

    if (!match.includes(file_data.type)) {
        $("#photo").val("");
        alert("Error: File isn't image!!!");
        return
    }

    let file = $("#input-avatar")[0].files;
    sentFileMedia(file);
})
// sent image with ajax
const sentFileMedia = (file) => {
    let fd = new FormData();

    if (file.length > 0) {
        fd.append('file', file[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let request = $.ajax({
            url: '/user/update-avatar',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
        });
        request.done(function (msg) {
            domain = window.location.origin;
            $('#avatar').attr("src", domain + msg.image)
            $('#avatar-topvar').attr("src", domain + msg.image)
            alert(msg.msg);
        });

        request.fail(function (request, status, error) {
            alert(request.responseText.errors.file);
        });
    } else {
        alert("Please select a file.");
    }
}

// logout other session
$('#form-logout-session').on('submit', function (e) {
    e.preventDefault();
    const passwordLogoutSession = $('#passwordLogoutSession').val();

    const data = {
        password: passwordLogoutSession
    };
    const urlSession = $('#form-logout-session').attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: urlSession,
        data: data,
        dataType: 'json',
        success: function (data) {
            $('.not-current-device').remove();
            $('#logoutSessionModal').modal('hide');
        },
        error: function (data) {
            let errors = data.responseJSON.errors.password;
            $('#error-logout-session').text(errors);
        }
    });

})

// delete account
$('#form-delete-account').on('submit', function (e) {
    e.preventDefault();
    const passwordDeleteAccount = $('#passwordDeleteAccount').val();

    const data = {
        password: passwordDeleteAccount
    };
    const url = $('#form-delete-account').attr('action');
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
            $('#logout-form').submit();
        },
        error: function (data) {
            let errors = data.responseJSON.errors.password;
            $('#error-delete-account').text(errors);
        }
    });

});