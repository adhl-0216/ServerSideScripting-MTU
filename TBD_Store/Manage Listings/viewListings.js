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
    })

    $(".btnAddToCart").click(function (){
        $.ajax({
            url: ".addToCart.php",
            type: "POST",
            data: {prodID : $(this).val()}
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
            <li class="productItem" id="${product['PRODUCT_ID']}">
                <div>
                    <div class="productImage">
                        <img src="../rsc/${productType}/${imgID}.webp" alt="${imgID}" title="${imgID}">
                    </div>
                    <div class="productDetails">
                        <span>${product['PRODUCT_NAME']}</span>
                        <span>&euro;${product['PRICE']}</span>
                        <span>${product['PRODUCT_DESCRIPTION']}</span>
                        <button class="btnAddToCart" value="${product['PRODUCT_ID']}">ADD TO CART</button>
                    </div>
                </div>
            </li>
        `);
    }
}