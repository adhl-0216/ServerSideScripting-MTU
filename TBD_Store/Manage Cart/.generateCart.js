$(function (){
    let userID;
    $.get("../Manage User/.userSession.php", function (data){
        if (data === "N/A"){
            location.href = "../Homepage/index.php";
        }
        userID = data;
    })
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
    let cartItems;
    let table = $("#cartItems");
    $.get("../Manage Listings/.addToCart.php", function (data) {
        cartItems = JSON.parse(data);
        console.log(cartItems);
        if (cartItems.length === 0) {
            table.remove();
            $("form").prepend("No items in the cart.");
        }
        for (const item of cartItems) {
            $.ajax({
                url: ".SQL_selectInventory.php",
                type: "POST",
                data: {prodID: item.substring(2)},
                success: function (response){
                    let prodDetails = JSON.parse(response);
                    let itemText = prodDetails['prodName']+"<br>"+prodDetails['prodDesc']+"<br>"+"UK Size: "+prodDetails['ukSize']+" &euro;"+prodDetails['price']
                    table.append(`<tr><td><label>${itemText}</td><td><input type="checkbox"></label></td></tr>`)
                }
            })

        }
    })
}