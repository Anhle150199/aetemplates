// Ready load ...
$(document).ready(function () {
    var ctrlDown = false,
        ctrlKey = 17,
        vKey = 86;

    $(document).keydown(function (e) {
        if (e.keyCode == ctrlKey) ctrlDown = true;
    }).keyup(function (e) {
        if (e.keyCode == ctrlKey) ctrlDown = false;
    });
    $("#inputTitlePost").keydown(function (e) {
        if (ctrlDown && (e.keyCode == vKey)) checkLengthTitle(e);;
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
                "min-height: 60px;max-height:110px; height:" + this.scrollHeight + "px;overflow-y:auto;"
            );
        })
        .on("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });

    // Add list tag list available
    $('#input-tag').append(
        `<datalist id="tag-list-available">
            <option value="Internet Explorer">
            <option value="Firefox">
            <option value="Chrome">
            <option value="Opera">
            <option value="Safari">
        </datalist>  `);
    $('#input-tag>input').attr('list', 'tag-list-available');
    
    $('#input-tag>input').keypress(function (event) {
        if (event.keyCode == 13) {

        }
    });
    resizeImagePre();
    $('.cropme').simpleCropper();

    const checkLengthTitle = (event) => {
        if ($("#inputTitlePost").val().length >= 150) {
            event.preventDefault();
            alert(`max title's length is 150,  ${$("#inputTitlePost").val().length} `)
            return false;
        }
    }
});

const setHeightDetailPost = () => {
    let heightScreen = $(window).height();
    let inputTitlePost = $('#inputTitlePost').parent().outerHeight();
    let heightPost = 1 - inputTitlePost / heightScreen;
    $('#divTinymce>div').css("height", `${heightPost * 100}vh`)
}

$(window).resize(function () {
    setHeightDetailPost();
    resizeImagePre();
});
$('#inputTitlePost').keyup(() => {
    setHeightDetailPost();
})
// title update URL
$("#inputTitlePost").keyup(() => {
    const slugCategory = $("#slugCategory").val();
    const titlePost = $("#inputTitlePost").val();
    const slugPost = convertUrl(titlePost);
    const urlPost = setUrlPost(slugCategory, slugPost);;
    $("#slugPost").val(slugPost);
    $("#urlPost").text("Link post: " + urlPost);
});

// edit slug post then update url
$("#slugPost").keyup(function () {
    const slugCategory = $("#slugCategory").val();

    let slugPost = $("#slugPost").val();
    slugPost = convertUrl(slugPost);
    // $("#slugPost").val(slugPost);
    const urlPost = setUrlPost(slugCategory, slugPost);;
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
    const urlPost = setUrlPost(slugCategory, slugPost);;
    $("#slugCategory").val(slugCategory);
    $("#urlPost").text("Link post: " + urlPost);

});

$('#imageInput').click(() => {
    $('.cropme').click();
})

const getSlugCategory = () => {
    const category = $("#selectCateParent").val();
    const slugCategory = dataResponse.find((item) => item.key == category).slug;
    return slugCategory;
}
const setUrlPost = (slugCategory, slugPost) => {
    return window.location.origin + slugCategory + "/" + slugPost;
}

const resizeImagePre = () => {
    //preview image size
    let width = $('#detail').parent().width();
    let height = (parseInt(width) - 40) * 9 / 16;
    $('#imageInput').height(height);
}

