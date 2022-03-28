// #############  Start Manage Tag #########
// Add Tag
$('#formAddTag').on('submit', function (e) {
    e.preventDefault();

    const table = $('#datatable-basic').DataTable();
    const newTag = $('#new-tag').val();
    const slugTag = convertUrl(newTag);
    const data = {
        tag_name: newTag,
        tag_slug: slugTag,
    };
    const url = $('#formAddTag').attr('action');
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
            let newTag = data.newTag;
            let nextRowIndex = table.rows().count() + 1;
            let newRow = table.row.add([
                0,
                newTag.tag_name,
                newTag.tag_slug,
                0,
                colAction(nextRowIndex)
            ]).draw()
                .node();
            $('#new-tag').val('');
            $(newRow).find('td').eq(1).attr('id', 'tag-name-' + nextRowIndex);
            $(newRow).find('td').eq(2).attr('id', 'slug-' + nextRowIndex);
            $(newRow).attr('id', nextRowIndex);
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#error-new-tag').text(errors.tag_slug);
        }
    });

})

function colAction(index) {
    return '<a href="#!" class="table-action" data-toggle="modal" data-target="#editModal" data-whatever="' +
        index + '"><i class="fas fa-edit"></i></a>' +
        '<a href="#" class="table-action table-action-delete" data-toggle="modal" data-target="#deleteModal" data-whatever=\"' +
        index + '\"><i class="fas fa-trash"></i></a>';
}

// Delete tag
$('#form-delete-tag').on('submit', (e) => {
    e.preventDefault();
    const table = $('#datatable-basic').DataTable();
    let rowTable = table.rows().count();
    const id = $('#delete-id').val();
    const tagSlug = $('#slug-' + id).text();
    const data = {
        tag_slug: tagSlug,
    };
    const url = $('#form-delete-tag').attr('action');
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
            table
                .row($('#' + id))
                .remove()
                .draw();

            $('#deleteModal').modal('hide');

            for (i of range(parseInt(id) + 1, parseInt(rowTable), 1)) {
                $('#' + i).find('a').attr('data-whatever', i - 1);
                $('#tag-name-' + i).attr('id', 'tag-name-' + (i - 1));
                $('#slug-' + i).attr('id', 'slug-' + (i - 1));
                $('#' + i).attr('id', i - 1);
            }

        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            setTimeout(() => {
                $('#deleteModal').modal('hide');
            }, 500);
            alert(errors);
        }
    });
})
// Edit Tag
$('#form-edit-tag').on('submit', (e) => {
    e.preventDefault();
    const table = $('#datatable-basic').DataTable();
    const id = $('#edit-id').val();
    const slugOldTag = $('#slug-' + id).text();
    const nameEditTag = $('#edit-tag').val();
    const slugEditTag = convertUrl(nameEditTag);
    const data = {
        slug_old_tag: slugOldTag,
        tag_name: nameEditTag,
        tag_slug: slugEditTag
    };
    const url = $('#form-edit-tag').attr('action');
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
            $('#editModal').modal('hide');
            $('#slug-' + id).text(data.tagEdit.tag_slug);
            $('#tag-name-' + id).text(data.tagEdit.tag_name);
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if (errors.tag_name) {
                $('#error-edit-tag').text(errors.tag_name);
            } else if (errors.tag_slug) {
                $('#error-edit-tag').text(errors.tag_slug);
            } else if (errors.slug_old_tag) {
                $('#error-edit-tag').text(errors.slug_old_tag);
            } else {
                $('#error-edit-tag').text(errors.other);
            }
            setTimeout(() => {
                $('#error-edit-tag').text("");
            }, 8000);
        }
    });
})


//  ######### Modal Tag #########
// Delete Tag Modal
$('#deleteModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    const id = button.data('whatever')
    const recipient = $('#tag-name-' + id).text();
    const modal = $(this)
    $('#delete-id').val(id);
    $('#deleteModalLabel').text("Are you sure delete \"" + recipient + "\" ?")
})
// Edit Tag Modal
$('#editModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget) // Button that triggered the modal
    const id = button.data('whatever')
    $('#edit-id').val(id);
    $('#edit-tag').val($('#tag-name-' + id).text());
})
// #############  End Manage Tag #########

// remove space, .....
function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, "");
    str = str.replace(/\u02C6|\u0306|\u031B/g, "");
    str = str.replace(/ + /g, " ");
    str = str.trim();
    str = str.replace(
        /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g,
        " "
    );
    return str;
}

// convert to URL
function convertUrl(p) {
    a = removeVietnameseTones(p);
    return a.replace(/\s+/g, "-").toLowerCase();
}

