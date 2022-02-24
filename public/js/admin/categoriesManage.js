// HTML col action for row table
function colAction(index) {
    return `<a href="#!" class="table-action" data-toggle="modal" data-target="#editModal" data-whatever="${index}">
            <i class="fas fa-edit"></i>
        </a>
        <a href="#" class="table-action table-action-delete" data-toggle="modal" data-target="#deleteModal" data-whatever="${index}">
            <i class="fas fa-trash"></i>
        </a>`;
}

// HTML new row of table
const row = (name, slug, posts, action, id, parentId) => {
    return `<div class="row " id="${id}">
            <div class="no"></div>
            <div class="col-4" id="name-${id}">${name}</div>
            <div class="col-4" id="slug-${id}">${slug} </div>
            <div class="col-2">${posts}</div>
            <div class="col">${action}</div></div>
            <div id="child-${id}"><hr></div>
        </div>`;
};

// New option of select category
const newOption = (id, name) => {
    return `<option value="${id}" >${name}</option>`;
};

// Show data for table and Select Tag
const showData = (data, parentId = 0, space) => {
    for (e of data) {
        if (e.parentId == parentId) {
            let name = e.name;
            name = space + " " + e.name;
            $("#child-" + e.parentId).append(
                row(name, e.slug, e.posts, e.action, e.key, e.parentId)
            );
            $("#selectCateParent").append(newOption(e.key, name));
            if (e.hasChild == true)
                showData(data, parseInt(e.key), space + "—");
        }
    }
};

// Empty Table and Select Tag
const resetData = () => {
    $("#selectCateParent").empty();
    $("#child-0").empty();
    $("#selectCateParent").append(newOption(0, "None"));
};

// Remove redundant characters for URL
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

// Convert name to URL
function convertUrl(p) {
    a = removeVietnameseTones(p);
    return a.replace(/\s+/g, "-").toLowerCase();
}

// Initialization data categories by ajax
jQuery.extend({
    getValues: function () {
        var result = null;
        $.ajax({
            url: "/posts/get-categories",
            type: "get",
            dataType: "json",
            async: false,
            success: function (json) {
                let categories = [];
                let hasChild = false;
                for (category of json.categories) {
                    if (category.children_count > 0) {
                        hasChild = true;
                    }

                    categories.push({
                        key: parseInt(category.id),
                        parentId: category.parent_id,

                        name: category.cate_name,
                        slug: category.cate_slug,
                        posts: category.posts_count,
                        status: category.cate_type,
                        action: colAction(category.id),
                        // level: category.cate_level,
                        hasChild: hasChild,
                    });
                }
                result = categories;
                if (result.length == 0)
                    $("#status-table").text("No data available in table");
                else {
                    $("#child-0").empty();
                    showData(result, 0, "");
                }
            },
        });
        return result;
    },
});

var dataResponse = $.getValues();

// Add New Category
$("#formAddCategory").on("submit", (e) => {
    e.preventDefault();

    const nameNewCate = $("#new-category").val();
    let slugNewCate = convertUrl(nameNewCate);
    const selectCateParent = $("#selectCateParent").val();
    if (selectCateParent != 0) {
        slugNewCate = $("#slug-" + selectCateParent).text() + "/" + slugNewCate;
    }
    const data = {
        cate_name: nameNewCate,
        cate_slug: slugNewCate,
        parent_id: selectCateParent,
    };
    const url = $("#formAddCategory").attr("action");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "post",
        url: url,
        data: data,
        dataType: "json",

        success: function (data) {
            let category = data.newCategory;
            $("#successModal").modal("show");
            category = {
                key: parseInt(category.id),
                parentId: category.parent_id,
                name: category.cate_name,
                slug: category.cate_slug,
                posts: category.posts_count,
                status: category.cate_type,
                action: colAction(category.id),
                hasChild: true,
            };
            dataResponse.push(category);

            if (category.parentId != 0) {
                dataResponse.find(
                    (x) => x.key == category.parentId
                ).hasChild = true;
            }

            resetData();
            let cateList = dataResponse;
            showData(cateList, 0, "");
            $("#new-category").val("");
        },

        error: function (data) {
            let errors = data.responseJSON.errors;
            if (errors.cate_name) {
                $("#error-new-category").text(errors.cate_name);
            } else if (errors.cate_slug) {
                $("#error-new-category").text(errors.cate_slug);
            } else {
                $("#error-new-category").text(errors);
            }
            $("#error-parent-select").text(errors.parent_id);
            setTimeout(() => {
                $("#error-new-category").text("");
                $("#error-parent-select").text("");
            }, 5000);
        },
    });
});

//  ######### Modal Categories #########
// Event Delete Categories Modal
$("#deleteModal").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const id = button.data("whatever");
    const recipient = dataResponse.find((x) => x.key == id);
    $("#delete-id").val(id);
    $("#deleteModalLabel").text(
        'Are you sure delete "' + recipient.name + '" ?'
    );
    $("#slug-delete-modal").text(recipient.slug);
});

// Show select parent for Edit Modal
const showEditSelect = (data, parentId = 0, space, idEdit) => {
    for (e of data) {
        if (e.parentId == parentId && e.key != idEdit) {
            let name = e.name;
            name = space + " " + e.name;
            $("#selectCateParentEdit").append(newOption(e.key, name));
            if (e.hasChild == true)
                showEditSelect(data, e.key, space + "—", idEdit);
        }
    }
};

// Event Edit Categories Modal
$("#editModal").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const id = button.data("whatever");
    const recipient = dataResponse.find((x) => x.key == id);
    $("#edit-id").val(id);
    $("#edit-category").val(recipient.name);
    $("#slugEdit").text(recipient.slug);
    $("#selectCateParentEdit").empty();
    $("#selectCateParentEdit").append(newOption(0, "None"));
    showEditSelect(dataResponse, 0, "", id);
    $("#selectCateParentEdit").val(recipient.parentId);
});
// #############  End Modal Categories #########

// #############  Start Ajax Action ##########
// Delete categories
$("#form-delete-category").on("submit", (e) => {
    e.preventDefault();
    const cateSlug = $("#slug-delete-modal").text();
    const data = {
        cate_slug: cateSlug,
    };
    const url = $("#form-delete-category").attr("action");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "delete",
        url: url,
        data: data,
        dataType: "json",
        success: function (data) {
            const idDelete = data.idDelete;

            // recursive child
            const deleteChild = (data, parentId) => {
                for (e of data) {
                    if (e.parentId == parentId) {
                        dataResponse = dataResponse.filter(
                            (item) => item.key != e.key
                        );
                        if (e.hasChild == true)
                            deleteChild(data, parseInt(e.key));
                    }
                }
            };

            $("#deleteModal").modal("hide");
            $("#successModal").modal("show");
            const dataDelete = dataResponse.find((x) => x.key == idDelete);
            deleteChild(dataResponse, dataDelete.key);
            dataResponse = dataResponse.filter(
                (item) => item.key != dataDelete.key
            );
            resetData();
            showData(dataResponse, 0, "");
        },
        error: function (data) {
            let errors = data.responseJSON;
            $("#errorModal").modal("show");
        },
    });
});

// Edit Categories
$("#form-edit-category").on("submit", (e) => {
    e.preventDefault();

    const editParentId = $("#selectCateParentEdit").val();
    const editNameCate = $("#edit-category").val();
    const cateSlug = $("#slugEdit").text();
    let cateEdit = dataResponse.find((item) => item.slug == cateSlug);
    let slugEditCate = convertUrl(editNameCate);

    if (editParentId != 0) {
        slugEditCate = $("#slug-" + editParentId).text() + "/" + slugEditCate;
    }
    let child = [];
    const getChild = (parent) => {
        dataResponse
            .filter((item) => item.parentId == parent.id)
            .forEach((element) => {
                slug = parent.slug + "/" + convertUrl(element.name);
                let x = { id: element.key, slug: slug };
                child.push(x);
                getChild(x);
            });
    };
    getChild({ id: cateEdit.key, slug: slugEditCate });

    const data = {
        cate_old_slug: cateSlug,
        cate_slug: slugEditCate,
        parent_id: editParentId,
        cate_name: editNameCate,
        child: child,
    };
    const url = $("#form-edit-category").attr("action");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "put",
        url: url,
        data: data,
        dataType: "json",
        success: function (data) {
            cateEdit.name = editNameCate;
            cateEdit.slug = slugEditCate;
            cateEdit.parentId = editParentId;
            if (editParentId != 0) {
                dataResponse.find((x) => x.key == editParentId).hasChild = true;
            }
            child.forEach((element) => {
                dataResponse.find((x) => x.key == element.id).slug =
                    element.slug;
            });
            resetData();
            showData(dataResponse, 0, "");
            $("#editModal").modal("hide");
            $("#successModal").modal("show");
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            if (errors.cate_name) {
                $("#error-edit-category").text(errors.cate_name);
            } else if (errors.cate_old_slug) {
                $("#error-edit-category").text(errors.cate_old_slug);
            } else if (errors.cate_slug) {
                $("#error-edit-category").text(errors.cate_slug);
            } else {
                $("#error-edit-category").text(errors);
            }
            $("#error-parent-edit").text(errors.parent_id);
            setTimeout(() => {
                $("#error-edit-category").text("");
                $("#error-parent-edit").text("");
            }, 5000);
        },
    });
});

// ############# End Ajax Action ############
