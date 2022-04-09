$(function(){
    // let widthCardBody = $('#body-images').innerWidth();
    // let width = widthCardBody*9/10;
    // let heightImage = (widthCardBody/5)/16*9;
    // // load image
    $('.card-img-name').each(function(e){
        let imgName = $(this).find('small').text();
        if (imgName.length >25)
        $(this).find('small').text(imgName.substring(0,10)+'...'+imgName.substring(imgName.length - 15,imgName.length));
    });
});
