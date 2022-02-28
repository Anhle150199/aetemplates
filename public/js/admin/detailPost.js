// Ready load ...
$(document).ready(function () {

    // Textarea block enter
    $("textarea").keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
    // textarea auto resize 
    $("textarea")
        .each(function () {
            this.setAttribute(
                "style",
                " height:" + this.scrollHeight + "px;overflow-y:hidden;"
            );
        })
        .on("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });
});

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

const getSlugCategory = () =>{
    const category = $("#selectCateParent").val();
    const slugCategory = dataResponse.find((item) => item.key == category).slug;
    return slugCategory;
}
const setUrlPost = (slugCategory, slugPost) =>{
    return window.location.origin + slugCategory + "/" + slugPost;
}
