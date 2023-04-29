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
        let userID;
        $("#productsList :input").click(function (){
            let prodID = $(this).parent().parent().parent().attr('id');
            $.get("../Manage User/.userSession.php", function (data){
                if (data === "N/A") {
                    location.href = "../Manage User/signIn.php";
                }else {
                    userID = data;
                    $.ajax({
                        url: ".addToCart.php",
                        type: "POST",
                        data: {prodID : prodID},
                        success: function (){
                            console.log(prodID);
                            alert("Added to Cart!")
                        }
                    })
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
        let imgID = product['PRODUCT_IMG'];
        console.log(imgID);
        $('#productsList').append(`
            <li class="productItem" id="${productType+product['PRODUCT_ID']}">
                <div class="product-container">
                    <div class="productImage">
                        <img src="../rsc/${productType}/${imgID}" alt="${imgID}" title="${imgID}">
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