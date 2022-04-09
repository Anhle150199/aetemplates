$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    setTimeout(() => {
        $.ajax({
            type: 'put',
            url: '/update-view',
            data: {param: location.pathname.slice(5, location.pathname.length)},
            dataType: 'json',
            success: function(data){
                console.log(data);
            }
        })
    }, 3000);
});
