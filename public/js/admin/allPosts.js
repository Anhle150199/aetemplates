$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#deleteModal").on("show.bs.modal", function (event) {
        const button = $(event.relatedTarget);
        const postId = button.data("post-id");
        const title = $("#title" + postId).text();
        $(this)
            .find(".modal-body")
            .text('Are you sure delete "' + title + '" ?');
        $("#btnYesDeletePost").attr("onclick", `deletePost(${postId})`);
    });
});

function updateTypePost(element, postId) {
    let arrRule = ["Drafts", "Public"];
    if (arrRule.includes(element.value) && postId != "") {
        $.ajax({
            type: "put",
            url: "/posts/update-post-type",
            data: {
                post_id: parseInt(postId),
                post_type: element.value,
            },
            dataType: "json",
            success: function (data) {
                $("#successModal").modal("show");
            },
            error: function (data) {
                errors = data.responseJSON.errors;
                console.log(errors);
                errors = Object.keys(errors).map((key) => errors[key]);

                $("#statusError>ul").empty();
                errors.forEach((e) =>
                    $("#statusError>ul").append(`<li>${e}</li>`)
                );
                $("#errorModal").modal("show");
            },
        });
    } else {
        $("#statusError>ul").empty();
        $("#statusError>ul").append(`<li>${e}</li>`);
        $("#errorModal").modal("show");
    }
}

function deletePost(postId) {
    $.ajax({
        type: "delete",
        url: "/posts/delete-post",
        data: {
            post_id: parseInt(postId),
        },
        dataType: "json",
        success: function (data) {
            $("#successModal").modal("show");
            $("#deleteModal").modal("hide");

            let table = $('#datatable-basic').DataTable();
            table
            .row($('#' + postId))
            .remove()
            .draw();
        },
        error: function (data) {
            errors = data.responseJSON.errors;
            console.log(errors);
            errors = Object.keys(errors).map((key) => errors[key]);

            $("#statusError>ul").empty();
            errors.forEach((e) => $("#statusError>ul").append(`<li>${e}</li>`));
            $("#errorModal").modal("show");
        },
    });
}
