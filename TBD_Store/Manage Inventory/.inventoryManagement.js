$(function (){

    let deleteInventory = function (){
        $("#btnDelete").click(function (){
            $.ajax(".inventorySQL.php")
        });
    }
    let refreshTable = function() {
        $("#allProducts").find("tr:gt(0)").remove();
        $.ajax({
                url: ".inventorySQL.php",
                type: "POST",
                data: {sqlFunc: "select"},
                success: function (data) {
                    alert(data);
                    // let allInventory = JSON.parse(data);
                    let allInventory = data;
                    for (let i = 0; i < allInventory.length; i++) {
                        let tr = document.createElement("tr");
                        for (let j = 0; j < 5; j++) {
                            let td = document.createElement("td");
                            td.innerText = allInventory[i][j];
                            tr.append(td);
                        }
                        let td = document.createElement("td");
                        let btnDelete = document.createElement("td");
                        btnDelete.id = "btnDelete";
                        btnDelete.innerText = "DEL";
                        td.append(btnDelete);
                        tr.append(td);


                        $("#allProducts").append(tr);
                    }
                }
            })
    };

    refreshTable();

    $("[name='INSERT']").click(function (e){
        e.preventDefault();
        let jsonData = {
            "PRODUCT_ID":$("[name='PRODUCT_ID']").val(),
            "PRODUCT_NAME":$("[name='PRODUCT_NAME']").val(),
            "PRODUCT_DESCRIPTION":$("[name='PRODUCT_DESCRIPTION']").val(),
            "PRICE":$("[name='PRICE']").val(),
            "QUANTITY":$("[name='QUANTITY']").val()
        }
        $.ajax({
                url: '.inventorySQL.php',
                type: "POST",
                data: {sqlFunc: "insert", data:jsonData},
                success: function (response) {
                    if (response) {
                        alert("great success! inserted " + $("[name='PRODUCT_ID']").val());
                        refreshTable();
                    }
                }
        })
    });
});
