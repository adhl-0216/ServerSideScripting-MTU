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

    $("#btnCheckOut").click(function (e){
        e.preventDefault();
        let checked = $("#cartItems :input:checked");
        checked.each(function (){
            let prodID = $(this).prop("name")
            console.log(prodID)
            let parent = $(this).parent().siblings("td:has(label)")
            console.log(parent.children().children("span.price").text())
        })
    })
})

function refreshCart() {
    let cartItems;
    let table = $("#cartItems");
    $.get("../Manage Listings/.addToCart.php", function (data) {
        cartItems = JSON.parse(data);
        // console.log(cartItems);
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
                    let imgID = item.substring(0,2)+item.substring(2).padStart(2,'0');
                    let itemText = prodDetails['prodName']+"<br>"+prodDetails['prodDesc']+"<br>"+"UK Size: "+prodDetails['ukSize']+" &euro;<span class='price'>"+prodDetails['price']+"</span>";
                    table.append(`<tr><td><img src="../rsc/${prodDetails['prodType']}/${imgID}.webp" alt="${prodDetails['prodName']}" title="${item}"></td><td><label class="form-control">${itemText}</td><td><input type="checkbox" name="${item}"></label></td></tr>`);
                }
            })

        }
    })
}