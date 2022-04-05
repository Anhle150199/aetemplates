// Ready load ...
var heightPostDiv,
    ssImage,
    oldTags = [],
    addTags = [],
    addDeleteTags = [],
    typePage,
    tagsList,
    countTags = 0;
var postDetail = {
    postTitle: "",
    postExcerpt: "",
    postContent: "",
    postType: "",
    postSlug: "",
    createdAt: "",
    cateId: 0,
};
var postDetailOld = {
    postTitle: "",
    postExcerpt: "",
    postContent: "",
    postType: "",
    postSlug: "",
    createdAt: "",
    cateId: 0,
};

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    tagsList = $.getTags();
    typePage = $("#panel").data("type");
    ssImage = $("#panel").data("id");
    var ctrlDown = false, ctrlKey = 17, vKey = 86;

    $(document)
        .keydown(function (e) { if (e.keyCode == ctrlKey) ctrlDown = true;})
        .keyup(function (e) { if (e.keyCode == ctrlKey) ctrlDown = false;});
    $("#inputTitlePost").keydown(function (e) {
        if (ctrlDown && e.keyCode == vKey) checkLengthTitle(e);
    });

    // Textarea block enter
    $("#inputTitlePost").keypress(function (event) {
        if (event.keyCode == 13)
            event.preventDefault();
        checkLengthTitle(event);
    });

    // textarea auto resize
    $(".textareaInput")
        .each(function () {
            this.setAttribute("style", "min-height: 60px;max-height:110px; height:" + this.scrollHeight + "px;overflow-y:auto;");
        })
        .on("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });

    // Add list tag list available
    addOptionDatalist(tagsList);

    $("#input-tag>input").keypress(function (event) {
        const spanTag = (name, statusAddTag) => {
            let slug = convertUrl(name);
            return `<small class="bg-warning p-1 m-1 text-white rounded ${statusAddTag}" id = "${slug}">${name}<i class="fa fa-times p-1 ml-1 cursor-pointer" aria-hidden="true"  onClick='removeTag("${slug}")'></i></small>`;
        };
        if (countTags >= 10) {
            alert("the count tags should not exceed 10");
            $("#input-tag>input").val("");
            return;
        }
        if (event.keyCode == 13) {
            let tagName = $("#input-tag>input").val();
            let duplicateCheck = addTags.find((item) => item.name == tagName);
            if (tagName.length > 20) {
                $("#input-tag>input").val("");
                alert("Tag length must not exceed 20 characters");
                return;
            }
            if (tagName == "" || duplicateCheck != null) {
                $("#input-tag>input").val("");
                return;
            }
            let slug = convertUrl(tagName);
            let checkOld = oldTags.find((item) => item.name == tagName);
            if (checkOld != null) {
                let checkDelete = addDeleteTags.find(
                    (item) => item.slug == slug
                );
                if (checkDelete != null) {
                    addDeleteTags = addDeleteTags.filter((item) => item.slug != slug);
                } else {
                    $("#input-tag>input").val("");
                    return;
                }
            } else {
                addTags.push({name: tagName,slug: slug});
            }

            $(spanTag(tagName, "new-tag")).insertBefore("#input-tag>input");
            $("#input-tag>input").val("");
            countTags += 1;
        }
    });
    resizeImagePre();
    $(".cropme").simpleCropper();

    $(window).resize(function () {
        setHeightDetailPost();
        resizeImagePre();
    });
    $("#inputTitlePost").keyup(() => {
        setHeightDetailPost();
    });
    // title update URL
    $("#inputTitlePost").keyup(() => {
        const slugCategory = $("#slugCategory").val();
        const titlePost = $("#inputTitlePost").val();
        const slugPost = convertUrl(titlePost);
        const urlPost = setUrlPost(slugCategory, slugPost);
        $("#slugPost").val(slugPost);
        $("#urlPost").html("<strong>Link post: </strong><a href=\"" + urlPost+'">'+urlPost+'</a>');
    });

    // edit slug post then update url
    $("#slugPost").keyup(function () {
        const slugCategory = $("#slugCategory").val();
        let slugPost = $("#slugPost").val();
        slugPost = convertUrl(slugPost);
        const urlPost = setUrlPost(slugCategory, slugPost);
        $("#urlPost").html("<strong>Link post: </strong><a href=\"" + urlPost+'">'+urlPost+'</a>');
    });

    // config url's post affter update url's post
    $("#slugPost").change(function () {
        let slugPost = $("#slugPost").val();
        slugPost = convertUrl(slugPost);
        $("#slugPost").val(slugPost);
    });

    // Update url's post affter update category
    $("#selectCateParent").change(() => {
        const slugCategory = getSlugCategory();
        let slugPost = $("#slugPost").val();
        const urlPost = setUrlPost(slugCategory, slugPost);
        $("#slugCategory").val(slugCategory);
        $("#urlPost").html("<strong>Link post: </strong><a href=\"" + urlPost+'">'+urlPost+'</a>');
    });

    $("#imageInput").click(() => {
        $(".cropme").click();
    });
    // Set name for image tag
    $("#imageInput").attr("name", "thumbnail" + Math.random().toString(36).substring(2, 10) + Date.now() + ".jpg");

    // Submit post
    $("#submit-post").click(() => {
        postDetail.postTitle = $("#inputTitlePost").val();
        postDetail.postExcerpt = $("#post-excerpt").val();
        postDetail.postContent = tinymce.get("postContent").getContent();
        postDetail.postType = $("#post-type").val();
        const srcPostThumbnail = $("#imageInput>img").attr("src");
        const namePostThumbnail = $("#imageInput").attr("name");
        postDetail.createdAt = $("#post-created-at").text();
        const check = validator(
            postDetail.postTitle,
            postDetail.postExcerpt,
            postDetail.postContent,
            postDetail.postType,
            postDetail.postSlug,
            srcPostThumbnail
        );
        if (check == false) return;

        let file = DataURIToBlob(srcPostThumbnail);
        let formData = new FormData();
        formData.append("post_title", postDetail.postTitle);
        formData.append("post_excerpt", postDetail.postExcerpt);
        formData.append("post_content", postDetail.postContent);
        formData.append("post_type", postDetail.postType);
        formData.append("post_slug", postDetail.postSlug);
        if (file != null) {
            formData.append("file", file, namePostThumbnail);
        }
        formData.append("created_at", postDetail.createdAt);
        formData.append("ssImage", ssImage);
        if (addTags.length > 0) {
            formData.append("tag_list", JSON.stringify(addTags));
        }

        if (typePage == "New") {
            if (postDetail.cateId >= 0) {
                formData.append("cate_id", parseInt(postDetail.cateId));
            }
            // console.log(formData.values());
            $.ajax({
                type: "post",
                url: "/posts/add-new-post",
                data: formData,
                contentType: false,
                processData: false,

                success: function (data) {
                    $("#successModal").modal("show");
                    typePage = "Edit";
                    $("#panel").data("type", "Edit");
                    $("#remove-post").show().data("id", data.newPost.id);
                    $("#imageInput img").attr(
                        "src",
                        location.origin +
                            "/storage/images/" +
                            data.newPost.post_thumbnail
                    );
                    postDetailOld = { ...postDetail };
                    oldTags = [...addTags];
                    addDeleteTags = [];
                    addTags.forEach((e) => {
                        $("#" + e.slug + " i").attr(
                            "onclick",
                            `removeTag("${e.slug}", "oldTagEdit")`
                        );
                    });
                    addTags = [];
                    tagsList = tagsList.concat(data.newTag);
                    addOptionDatalist(data.newTag);
                    $("#submit-post").text('Update');
                    history.pushState(null, null, "/posts/edit-post/"+data.newPost.id);
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
        } else if (typePage == "Edit") {
            if (addDeleteTags.length > 0) {
                formData.append("tag_delete", JSON.stringify(addDeleteTags));
            }
            if (
                postDetail.cateId != "" &&
                postDetail.cateId != postDetailOld.cateId
            ) {
                formData.append("cate_id", postDetail.cateId);
            }
            let postId = $("#remove-post").data("id");
            formData.append("post_id", postId);

            $.ajax({
                type: "post",
                url: "/posts/update-post",
                data: formData,
                contentType: false,
                processData: false,

                success: function (data) {
                    $("#successModal").modal("show");
                    postDetailOld = { ...postDetail };
                    $("#imageInput img").attr(
                        "src",
                        location.origin +
                            "/storage/images/" +
                            data.editPost.post_thumbnail
                    );

                    if (addDeleteTags.length > 0) {
                        addDeleteTags.forEach((e) => {
                            oldTags = oldTags.filter(
                                (item) => item.slug != e.slug
                            );
                        });
                    }

                    addTags.forEach((e) => {
                        $("#" + e.slug + " i").attr(
                            "onclick",
                            `removeTag("${e.slug}", "oldTagEdit")`
                        );
                    });

                    oldTags = oldTags.concat(addTags);
                    addDeleteTags = [];
                    addTags = [];
                    tagsList = tagsList.concat(data.newTag);
                    addOptionDatalist(data.newTag);
                },
                error: function (data) {
                    errors = data.responseJSON.errors;
                    errors = Object.keys(errors).map((key) => errors[key]);

                    $("#statusError>ul").empty();
                    errors.forEach((e) =>
                        $("#statusError>ul").append(`<li>${e}</li>`)
                    );
                    $("#errorModal").modal("show");
                },
            });
        }
    });

    $("#remove-post").click(()=>{
        let postId = $("#remove-post").data('id');
        $.ajax({
            type: "delete",
            url: "/posts/delete-post",
            data: {
                post_id: parseInt(postId),
            },
            dataType: "json",
            success: function (data) {
                window.location.href = location.origin+'/posts/all';
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
    })
    if (typePage == "Edit") {
        editSelectCategory();
        postDetail.postSlug =
            $("#slugCategory").val() + "/" + $("#slugPost").val();
        $(".old-tag").each(function (index) {
            oldTags.push({ name: $(this).text(), slug: $(this).attr("id") });
        });
        countTags = oldTags.length;
    }
});

const setHeightDetailPost = () => {
    let heightScreen = $(window).height();
    let inputTitlePost = $("#inputTitlePost").parent().outerHeight();
    let heightPost = 1 - inputTitlePost / heightScreen;
    heightPostDiv = `${heightPost * 100}vh`;
    $("#divTinymce>div").css("height", `${heightPost * 100}vh`);
};

const checkLengthTitle = (event) => {
    if ($("#inputTitlePost").val().length >= 150) {
        event.preventDefault();
        alert(
            `max title's length is 150,  ${$("#inputTitlePost").val().length} `
        );
        return false;
    }
};

const getSlugCategory = () => {
    const category = $("#selectCateParent").val();
    postDetail.cateId = category;
    if (category == 0) {
        return "";
    } else {
        return dataResponse.find((item) => item.key == category).slug;
    }
};

const setUrlPost = (slugCategory, slugPost) => {
    postDetail.postSlug = slugCategory + "/" + slugPost;
    return window.location.origin + '/post'+postDetail.postSlug;
};

const resizeImagePre = () => {
    //preview image size
    let width = $("#heading5").parent().width();
    let height = ((parseInt(width) - 40) * 9) / 16;
    $("#imageInput").height(height);
};

function removeTag(tagSlug, statusAddTag) {
    addTags = addTags.filter((item) => item.slug != tagSlug);
    $("#" + tagSlug).remove();
    if (statusAddTag == "oldTagEdit") {
        let tagDel = tagsList.find((item) => item.slug == tagSlug);
        // oldTags = oldTags.filter((item)=>item.slug != tagDel.slug);
        addDeleteTags.push({ id: tagDel.id, slug: tagDel.slug });
    }
    countTags--;
}

function DataURIToBlob(dataURI) {
    const splitDataURI = dataURI.split(",");
    if (splitDataURI[1] == null) return null;
    const byteString = splitDataURI[0].indexOf("base64") >= 0 ? atob(splitDataURI[1]) : decodeURI(splitDataURI[1]);
    const mimeString = splitDataURI[0].split(":")[1].split(";")[0];

    const ia = new Uint8Array(byteString.length);
    for (let i = 0; i < byteString.length; i++)
        ia[i] = byteString.charCodeAt(i);

    return new Blob([ia], { type: mimeString });
}

function validator(postTitle, postExcerpt, postContent, postType, postSlug, srcPostThumbnail) {
    let statusCheck = [],
        numError = 0;
    if (postTitle == "") {
        statusCheck.push("The post title field is required !");
        numError++;
    }
    if (postExcerpt == "") {
        statusCheck.push("The post excerpt field is required ! ");
        numError++;
    }
    if (postContent == "") {
        statusCheck.push("The post content field is required !");
        numError++;
    }
    if (postType == "") {
        statusCheck.push("The post type field is required !");
        numError++;
    }
    if (postSlug == "" || postSlug == null) {
        statusCheck.push("The post slug field is required ! ");
        numError++;
    }
    if (srcPostThumbnail == "" || srcPostThumbnail == null) {
        statusCheck.push("The post image thumnail is required ! ");
        numError++;
    }
    if (numError > 0) {
        $("#statusError>ul").empty();
        statusCheck.forEach((e) =>
            $("#statusError>ul").append(`<li>${e}</li>`)
        );
        $("#errorModal").modal("show");
        return false;
    }
    return true;
}

// Functions for edit
function editSelectCategory() {
    let slug = $("#slugCategory").val();
    if (slug == "") return;
    let cateId = dataResponse.find((item) => item.slug == slug).key;
    $("#selectCateParent option[value = " + cateId + "]").prop("selected", "selected");
}

function addOptionDatalist(list) {
    list.forEach((tag) => {$("#tag-list-available").append(`<option value="${tag.name}">${tag.slug}</option>`);});
}

$("#tag-list-available").click((event) => {
    console.log($("#input-tag>input").val());
});
