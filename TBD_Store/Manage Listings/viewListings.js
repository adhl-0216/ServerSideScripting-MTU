$(function (){
    const urlParams = new URLSearchParams(window.location.search);
    const productType = urlParams.get('p');
    $("#productType").text(
        function (){
            switch (productType){
                case "FW":
                    return "Footwear";
                case "JR":
                    return "Jerseys";
                case "AC":
                    return "Accessories";
                default:
                    return "TBD STORE";
            }
        }
    );

    $.ajax({
        type: "POST",
        url: "createListings.php",
        data: {productType: productType},
        success: function(response) {
            createItems(productType, response)
        }
    })

});

function createItems(productType, data){
    let allInventory = JSON.parse(data);
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
                        <button name="btnAddToCart" value="${product['PRODUCT_ID']}">ADD TO CART</button>
                    </div>
                </div>
            </li>
            `);
    }
}