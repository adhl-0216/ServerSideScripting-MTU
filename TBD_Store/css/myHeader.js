$(window).scroll(function (e){
    if ($(this).scrollTop() > 1)
    {
        $('#modules').addClass("sticky");
    }
    else
    {
        $('#modules').removeClass("sticky");
    }
})