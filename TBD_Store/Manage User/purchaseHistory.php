<?php include "../css/myHeader.html" ?>
<body>
<h1>My Purchase History</h1>
<div class="purchaseHistory">

</div>
</body>
<script>
    $(function () {
        $.ajax({
            url: ".SQL_purchaseHistory.php",
            type: "POST",
            data: {sale: 1},
            success: function (data) {
                let purchaseHistory = JSON.parse(data)
                let div = $("div.purchaseHistory")
                if (purchaseHistory.length > 0) {
                    div.append($("<table class='purchaseHistory' " +
                        "tr><th>Purchase Date</th><th>Total(&euro;)</th><th>Details</th></tr>" +
                        "</table>"))
                    for (const purchase of purchaseHistory) {
                        let tr = $("<tr></tr>")
                        tr.attr("id", purchase['saleID'])

                        let saleDate = $("<td></td>")
                        saleDate.text(purchase['saleDate'])
                        tr.append(saleDate)

                        let totalSale = $("<td></td>")
                        totalSale.text(purchase['totalSale'])
                        tr.append(totalSale)

                        div.children("table").append(tr)
                    }
                }else {
                    div.append("No purchase history.")
                }

            }
        }).then(function () {
            let allRows = $("tr")
            allRows.click(function (){
                if ($(this).children("td.colDetails").length){
                    $(this).children("td.colDetails").remove()
                    return false;
                }
                let saleId = $(this).attr("id")
                let purchaseDetails;
                $.ajax({
                    url:".SQL_purchaseHistory.php",
                    type: "POST",
                    data: {saleId : saleId},
                    success: function (data) {
                        purchaseDetails = JSON.parse(data)
                    }
                }).then(function () {
                    let details = $("<td class='colDetails'></td>")
                    $('#'+saleId).append(details)
                    console.log(purchaseDetails)
                    for (const purchaseDetail of purchaseDetails) {
                        let product = $("<tr></tr>")
                        product.addClass("purchaseDetail")
                        let text=purchaseDetail['prodName']+ " *"+purchaseDetail['quantity']
                        product.html(text)

                        details.append(product)
                    }
                })

            })
        })
    })
</script>
<?php include "../css/myFooter.html" ?>