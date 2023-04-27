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

    //checkOut
    let checkOutItems;
    $("#btnCheckOut").click(function (e){
        e.preventDefault();
        checkOutItems = [];
        let checked = $("#cartItems :input:checked");
        checked.each(function (){
            let prodID = $(this).prop("name")
            checkOutItems.push(prodID)
        })

        let totalPrice = $("#subtotal").text().toString().substring(2);

        $.post(".checkOut.php", {prodID: JSON.stringify(checkOutItems), subtotal: totalPrice})
        console.log(checkOutItems);
        console.log(totalPrice);
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
    }).then(function (){
        let prodDetails;
        $.ajax({
            url: ".SQL_selectInventory.php",
            type: "POST",
            data: {prodID: JSON.stringify(cartItems)},
            success: function (response) {
                prodDetails = JSON.parse(response);
            }
        }).then(function (){
            for (const prodDetail of prodDetails) {
                let imgID = prodDetail['prodType'] + prodDetail['prodID'].padStart(2, '0');
                let itemText = prodDetail['prodName'] + "<br>" + prodDetail['prodDesc'] + "<br>" + "UK Size: " + prodDetail['ukSize'] + " &euro;<span class='price'>" + prodDetail['price'] + "</span>";
                table.append(`<tr><td><img src="../rsc/${prodDetail['prodType']}/${imgID}.webp" alt="${prodDetail['prodName']}" title="${prodDetail['prodID']}"></td><td><label class="form-control">${itemText}</td><td><input type="checkbox" name="${prodDetail['prodID']}" title="${prodDetail['prodName']}"></label></td></tr>`);
            }
        }).then(function (){
            let totalPrice = 0;
            let checkBoxes = $("#cartItems :input[type='checkbox']");
            checkBoxes.change(function (){
                let price = $(this).parent().siblings("td:has(label)").children().children("span.price").text();

                if(this.checked){
                    totalPrice+=Number(price);
                }
                else if(!this.checked){
                    totalPrice-=Number(price);
                }
                $("#subtotal").html("&euro; "+totalPrice.toFixed(2))
            })
        })
    })
}