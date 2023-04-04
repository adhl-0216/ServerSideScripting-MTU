<?php include "../header.html"?>
<script>
    $(function (){
       $.ajax({
           type: "POST",
           url: "createListings.php",
           data: {productType: "FW"},
           success: function(response) {
               createItems(response)
           }
       })
    });

    function createItems(data){
        let allInventory = JSON.parse(data);
        for (const product of allInventory) {
            let imgID = 'FW'+product['PRODUCT_ID'].toString().padStart(2,'0');
            $('#productsList').append(`
            <li class="productItem" id="${product['PRODUCT_ID']}">
                <div>
                    <div class="productImage">
                        <img src="../rsc/footwear/${imgID}.webp" alt="${imgID}" title="${imgID}">
                    </div>
                    <div class="productDetails">
                        <span>${product['PRODUCT_NAME']}</span>
                        <span>&euro;${product['PRICE']}</span>
                        <span>${product['PRODUCT_DESCRIPTION']}</span>
                    </div>
                </div>
            </li>
            `);

        }
    }


</script>
<body>
<h1>Basketball Shoes</h1>
<ul id="productsList" class="productsList">
</ul>
</body>
<?php include "../footer.html"?>
