$(function (){
    refreshCart();

    $("#btnClear").click(function (e){
        e.preventDefault();
        $.post(".clearCart.php",function(response){
            console.log(response);
            refreshCart();
        })
    })
})

function refreshCart() {
    $.get("../Manage Listings/.addToCart.php", function (data) {
        $("#cartItems").html(data);
        console.log("success");
    })
}