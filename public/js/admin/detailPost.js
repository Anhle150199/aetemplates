// Ready load ...
var heightPostDiv,
    addNewTags = [],
    addOldTags = [],
    countTags = 0;
var tagsList = $.getTags();
$(document).ready(function () {
    var ctrlDown = false,
        ctrlKey = 17,
        vKey = 86;

    $(document)
        .keydown(function (e) {
            if (e.keyCode == ctrlKey) ctrlDown = true;
        })
        .keyup(function (e) {
            if (e.keyCode == ctrlKey) ctrlDown = false;
        });
    $("#inputTitlePost").keydown(function (e) {
        if (ctrlDown && e.keyCode == vKey) checkLengthTitle(e);
    });

    // Textarea block enter
    $("#inputTitlePost").keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
        checkLengthTitle(event);
    });
    // textarea auto resize
    $(".textareaInput")
        .each(function () {
            this.setAttribute(
                "style",
                "min-height: 60px;max-height:110px; height:" +
                    this.scrollHeight +
                    "px;overflow-y:auto;"
            );
        })
        .on("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });

    // Add list tag list available
    tagsList.forEach((tag) => {
        $("#tag-list-available").append(
            `<option value="${tag.name}">${tag.slug}</option>`
        );
    });

    $("#input-tag>input").keypress(function (event) {
        const spanTag = (name, statusAddTag) => {
            let slug = convertUrl(name);
            return `<span class="bg-warning p-2 m-1 text-white rounded " id = "${slug}">${name}<i class="fa fa-times p-1 ml-1 cursor-pointer" aria-hidden="true"  onClick='removeTag("${slug}", "${statusAddTag}")'></i></span>`;
        };
        if (countTags >= 10) {
            alert("the count tags should not exceed 10");
            $("#input-tag>input").val("");
            return;
        }
        if (event.keyCode == 13) {
            let tagName = $("#input-tag>input").val();
            let duplicateCheckNew = addNewTags.find(
                (item) => item.name == tagName
            );
            let duplicateCheckOld = addOldTags.find(
                (item) => item.name == tagName
            );
            let duplicateCheck = false;
            let statusAddTag;
            if (duplicateCheckNew == null && duplicateCheckOld == null)
                duplicateCheck = true;
            if (tagName == "" || duplicateCheck == false) {
                $("#input-tag>input").val("");
                return;
            }

            let checkTag = tagsList.find((item) => item.name == tagName);
            if (checkTag == null) {
                addNewTags.push({
                    name: tagName,
                    slug: convertUrl(tagName),
                });
                statusAddTag = "new"
            } else{
                addOldTags.push({
                    name: tagName,
                    slug: checkTag.slug,
                });
                statusAddTag = "old"
            }
            $(spanTag(tagName,statusAddTag)).insertBefore("#input-tag>input");
            $("#input-tag>input").val("");
            countTags += 1;
        }
    });
    resizeImagePre();
    $(".cropme").simpleCropper();

    const checkLengthTitle = (event) => {
        if ($("#inputTitlePost").val().length >= 150) {
            event.preventDefault();
            alert(
                `max title's length is 150,  ${
                    $("#inputTitlePost").val().length
                } `
            );
            return false;
        }
    };
});

const setHeightDetailPost = () => {
    let heightScreen = $(window).height();
    let inputTitlePost = $("#inputTitlePost").parent().outerHeight();
    let heightPost = 1 - inputTitlePost / heightScreen;
    heightPostDiv = `${heightPost * 100}vh`;
    console.log(inputTitlePost);
    console.log(heightPostDiv);
    $("#divTinymce>div").css("height", `${heightPost * 100}vh`);
};

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
    $("#urlPost").text("Link post: " + urlPost);
});

// edit slug post then update url
$("#slugPost").keyup(function () {
    const slugCategory = $("#slugCategory").val();

    let slugPost = $("#slugPost").val();
    slugPost = convertUrl(slugPost);
    // $("#slugPost").val(slugPost);
    const urlPost = setUrlPost(slugCategory, slugPost);
    $("#urlPost").text("Link post: " + urlPost);
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
    $("#urlPost").text("Link post: " + urlPost);
});

$("#imageInput").click(() => {
    $(".cropme").click();
});

const getSlugCategory = () => {
    const category = $("#selectCateParent").val();
    const slugCategory = dataResponse.find((item) => item.key == category).slug;
    return slugCategory;
};
const setUrlPost = (slugCategory, slugPost) => {
    return window.location.origin + slugCategory + "/" + slugPost;
};

const resizeImagePre = () => {
    //preview image size
    let width = $("#detail").parent().width();
    let height = ((parseInt(width) - 40) * 9) / 16;
    $("#imageInput").height(height);
};

const removeTag = (tagSlug, statusAddTag) => {
    if (statusAddTag == 'new') {
        addNewTags = addNewTags.filter((item)=>item.slug != tagSlug);
    } else {
        addOldTags = addOldTags.filter((item)=>item.slug != tagSlug);
    }
    $('#'+tagSlug).remove();

}
