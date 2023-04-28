$(function (){
    const urlParams = new URLSearchParams(window.location.search);
    const productType = urlParams.get('p');

    $.ajax({
        type: "POST",
        url: ".createListings.php",
        data: {productType: productType},
        success: function(response) {
            createCategoryHeader(productType);
            createItems(productType, response);
        }
    }).then(function (){
        $("#productsList :input").click(function (){
            alert("Added to Cart!")
            $.get("../Manage User/.userSession.php", function (data){
                if (data === "N/A") {
                    location.href = "../Manage User/signIn.php";
                }
            })
            let prodID = $(this).parent().parent().parent().attr('id');
            $.ajax({
                url: ".addToCart.php",
                type: "POST",
                data: {prodID : prodID},
                success: function (){
                    console.log(prodID);
                }
            })
        })
    })
});
function createCategoryHeader(productType) {
    $("#productType").text(function () {
        switch (productType) {
            case "FW":
                return "Footwear";
            case "JR":
                return "Jerseys";
            case "AC":
                return "Accessories";
            default:
                return "TBD STORE";
        }
    });
}
function createItems(productType, response){
    let allInventory = JSON.parse(response);

    for (const product of allInventory) {
        let imgID = productType + product['PRODUCT_ID'].toString().padStart(2,'0');
        $('#productsList').append(`
            <li class="productItem" id="${productType+product['PRODUCT_ID']}">
                <div>
                    <div class="productImage">
                        <img src="../rsc/${productType}/${imgID}.webp" alt="${imgID}" title="${imgID}">
                    </div>
                    <div class="productDetails">
                        <p><strong>${product['PRODUCT_NAME']}</strong></p>
                        <p>${product['PRODUCT_DESCRIPTION']}</p>
                        <p>&euro; ${product['PRICE']}</p>
                        <input type="button" value="ADD TO CART" class="button btnAddToCart">
                    </div>
                </div>
            </li>
        `);
    }
}