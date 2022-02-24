$(document).ready(function () {
    $("textarea").keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
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

$("#inputTitlePost").keyup(() => {
    const slugCategory = $("#slugCategory").val();
    const titlePost = $("#inputTitlePost").val();
    const slugPost = convertUrl(titlePost);
    const urlPost = window.location.origin + slugCategory + "/" + slugPost;
    $("#slugPost").val(slugPost);
    $("#urlPost").text("Link post: " + urlPost);
});

$("#slugPost").keyup(function () {
    const slugCategory = $("#slugCategory").val();

    const slugPost = $("#slugPost").val();
    const urlPost = window.location.origin + slugCategory + "/" + slugPost;
    $("#urlPost").text("Link post: " + urlPost);
});

$("#selectCateParent").change(() => {
    const category = $("#selectCateParent").val();
    const slugCategory = dataResponse.find((item) => item.key == category).slug;
    $("#slugCategory").val("/" + slugCategory);
});
