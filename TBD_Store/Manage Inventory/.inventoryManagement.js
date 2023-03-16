$(function (){
    $.ajax({
        url: ".selectInventory.php"
    }).success(function (data) {
        $("#allProducts").append(document.createElement("tr"))
    })

})