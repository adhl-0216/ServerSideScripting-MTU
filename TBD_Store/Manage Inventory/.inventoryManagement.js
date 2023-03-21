$(function (){
    let $refresh = $.ajax(".selectInventory.php",
        {
            success: function (data) {
                let $allInventory = JSON.parse(data);
                for (let i = 0; i < $allInventory.length; i++) {
                    let $tr = document.createElement("tr");
                    for (let j = 0; j < 5; j++) {
                        let $td = document.createElement("td");
                        $td.innerText = $allInventory[i][j];
                        $tr.append($td);
                    }
                    $("#allProducts").append($tr);
                }
            }
        })

    $("[name='INSERT']").click(function (e){
        e.preventDefault();
        let $jsonData = {
            "PRODUCT_ID":$("[name='PRODUCT_ID']").val(),
            "PRODUCT_NAME":$("[name='PRODUCT_NAME']").val(),
            "PRODUCT_DESCRIPTION":$("[name='PRODUCT_DESCRIPTION']").val(),
            "PRICE":$("[name='PRICE']").val(),
            "QUANTITY":$("[name='QUANTITY']").val()
        }
        $.ajax('.insertInventory.php',
            {
                type: "POST",
                data: $jsonData,
                success: function (response) {
                    if (response != null) {
                        alert("great success! inserted " + $("[name='PRODUCT_ID']").val());
                }
            }
        })
    })
})