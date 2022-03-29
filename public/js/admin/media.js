$(function(){
    let widthCardBody = $('#body-images').innerWidth();
    let heightImage = (widthCardBody/100*15)/16*9;
    // load image
    $('.card-img-name').each((e)=>{
        let imgName = $(this).find('span').text();
        let imgId = $(this).data('id');

        $(`<div class="card-img-top w-100" style="height: ${heightImage}; background:url(${location.origin + "/storage/images/"+imgName})"></div>`).insertBefore($(this))

    });
});
