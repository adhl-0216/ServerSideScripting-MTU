$(function (){
    $.ajax({
        type: "POST",
        url: ""
    }).then(function (data) {
        $("#allProducts").append(document.createElement("tr"))
    })

})