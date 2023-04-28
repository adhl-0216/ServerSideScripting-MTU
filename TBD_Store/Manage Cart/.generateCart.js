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

    $("#btnCheckOut").click(function (e) {
        e.preventDefault();
        let prodIDs = [];
        $(".btnRemove").each(function (){
            prodIDs.push($(this).attr("name"))
        })

        let checkOutItems = {}
        for (const prodID of prodIDs) {
            if (checkOutItems[prodID]){
                checkOutItems[prodID] += 1;
            }else {
                checkOutItems[prodID] = 1;
            }
        }

        console.log(checkOutItems)

        let subtotal = $("#subtotal").text();

        let url = ".checkOut.php";

        let  form = $(document.createElement('form'));
        $(form).attr("action", url);
        $(form).attr("method", "POST");
        $(form).css("display", "none");

        let input_prodID = $("<input>")
            .attr("type", "text")
            .attr("name", "checkOutItems")
            .val(JSON.stringify(checkOutItems));
        $(form).append($(input_prodID));

        let input_subtotal = $("<input>")
            .attr("type", "text")
            .attr("name", "subtotal")
            .val(subtotal);
        $(form).append($(input_subtotal));

        form.appendTo($(document.body));

        $.post(".clearCart.php",function(response){
            console.log(response);
            refreshCart();
        })

        $(form).submit();
    })
})

function refreshCart() {
    let cartItems;
    let table = $("#cartItems");
    $.get("../Manage Listings/.addToCart.php", function (data) {
        cartItems = JSON.parse(data);
        console.log(cartItems.length)
        if (cartItems.length === 0) {
            console.log("empty")
            table.remove();
            $("div.form-container").remove();
            $("footer").before($("<div>No items in the cart.</div>"));
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
                table.append(`<tr><td><img src="../rsc/${prodDetail['prodType']}/${imgID}.webp" alt="${prodDetail['prodName']}" title="${prodDetail['prodID']}"></td><td><label class="form-control">${itemText}</td><td><input type="button" class="btnRemove" name="${prodDetail['prodID']}" value="REMOVE" /></label></td></tr>`);
            }
        }).then(function (){
            let totalPrice = 0 ;
            let price = $("span.price");
            price.each(function (){
                totalPrice += Number($(this).text())
            })
            $("#subtotal").text(totalPrice.toFixed(2))
        })
    })
}