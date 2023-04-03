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
            $('#productsList').append(`
            <li class="productItem" id="${product['PRODUCT_ID']}">
                <div>
                    <div class="productImage">
                        <img src="../rsc/footwear/FW${product['PRODUCT_ID']}.webp" alt="">
                    </div>
                    <div class="productDetails">
                        <p>${product['PRODUCT_NAME']}</p>
                        <p>${product['PRODUCT_DESCRIPTION']}</p>
                    </div>
                </div>
            </li>
            `);

        }
    }


</script>
<body>
<ul id="productsList" class="productsList">
    <li class="productItem" id="FW01">
        <div>
            <div class="productImage">
                <img src="../rsc/footwear/FW01.webp" alt="">
            </div>
            <div class="productDetails">
                <p>FW01</p>
                <p>Basketball Shoe</p>
            </div>
        </div>
    </li>
</ul>
</body>
<?php include "../footer.html"?>
