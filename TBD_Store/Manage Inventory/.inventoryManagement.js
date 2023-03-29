$(function (){

    let deleteInv = function (e){
        if (!confirm("Confirm Delete " + e.target.value + "?")) return;
        let prodID = e.target.value;
        $.ajax({
            url: ".inventorySQL.php",
            type: "POST",
            data: {sqlFunc: "delete" , data:prodID},
            success: (affectedRows) => {
                if (affectedRows > 0) alert(affectedRows + ' row deleted.');
                refreshTable();
            },
            error: (err) => {
                alert(err)
            }

        });
    }
    let updateInv = function (e){
        let btn = e.target;
        let status = btn.innerText;
        let rowIdx = btn.parentNode.parentNode.id;
        let inputs = $(`#allProducts tr[id="${rowIdx}"] :input:not(button)`);

        if (status === "UPDATE"){
            btn.innerText = "DONE";
            inputs.prop("disabled", false);

        }else if (status === "DONE") {
            btn.innerText = "UPDATE";
            let prodDetails = {
                prodID:btn.value,
                prodName: inputs.eq(0).val(),
                prodDesc: inputs.eq(1).val(),
                price: inputs.eq(2).val(),
                quantity: inputs.eq(3).val()
            }
            console.log(prodDetails);
            $.ajax({
                url: ".inventorySQL.php",
                type: "POST",
                data: {sqlFunc: "update"},
                success: (affectedRows) => {
                    if (affectedRows > 0) alert(affectedRows + ' row updated.');
                    refreshTable();
                },
                catch: (err) => {
                    alert(err)
                }
            });
            inputs.prop("disabled", true);
        }

    }
    let refreshTable = function() {
        $("#allProducts").find("tr:gt(0)").remove();
        $.ajax({
                url: ".inventorySQL.php",
                type: "POST",
                data: {sqlFunc: "select"},
                success: function (data) {
                    if(data === "N/A") return;
                    let allInventory = JSON.parse(data);
                    for (let i = 0; i < allInventory.length; i++) {
                        let prodID = allInventory[i][1];
                        let tr = document.createElement("tr");
                        tr.id = prodID;
                        for (let j = 0; j < 7; j++) { //hardcode
                            let td = document.createElement("td");
                            if(j < 2 || j === 4 ) td.innerText = allInventory[i][j];
                            else {
                                let inpTxt = document.createElement("input");
                                inpTxt.type = "text";
                                inpTxt.disabled = true;
                                inpTxt.value = allInventory[i][j];
                                td.append(inpTxt);
                            }
                            tr.append(td);
                        }
                        let colOptions = document.createElement("td");
                        let btnDelete = document.createElement("button");
                        btnDelete.className = "btnDelete";
                        btnDelete.innerText = "DELETE";
                        btnDelete.value = prodID;
                        btnDelete.addEventListener('click', deleteInv);
                        colOptions.append(btnDelete);

                        let btnUpdate = document.createElement("button");
                        btnUpdate.className = "btnUpdate";
                        btnUpdate.innerText = "UPDATE";
                        btnUpdate.value = prodID;
                        btnUpdate.addEventListener('click', updateInv);
                        colOptions.append(btnUpdate);

                        tr.append(colOptions);

                        $("#allProducts").append(tr);
                    }
                }
            })
    };

    refreshTable();



    $("[name='INSERT']").click(function (e){
        e.preventDefault();
        let jsonData = {
            "PRODUCT_TYPE":$("[name='PRODUCT_TYPE']").val(),
            "PRODUCT_NAME":$("[name='PRODUCT_NAME']").val(),
            "PRODUCT_DESCRIPTION":$("[name='PRODUCT_DESCRIPTION']").val(),
            "UK_SIZE":$("[name='UK_SIZE']").val(),
            "PRICE":$("[name='PRICE']").val(),
            "QUANTITY":$("[name='QUANTITY']").val()
        }
        $.ajax({
                url: '.inventorySQL.php',
                type: "POST",
                data: {sqlFunc: "insert", data:jsonData},
                success: function (response) {
                    if (response > 0) {
                        alert("Great success! inserted " + $("[name='PRODUCT_NAME']").val());
                        refreshTable();
                    }else {
                        alert(response)
                    }
                }
        })
    });
});
