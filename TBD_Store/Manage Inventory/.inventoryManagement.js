$(function (){

    let deleteInv = function (e){
        if (!confirm("Confirm Delete " + e.target.value + "?")) return;
        let prodID = e.target.value;
        $.ajax({
            url: ".inventorySQL.php",
            type: "POST",
            data: {sqlFunc: "delete" , data:prodID},
            success: (affectedRows) => {
                if (affectedRows > 0) console.log(affectedRows + ' row deleted.');
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
                data: {sqlFunc: "update", data: prodDetails},
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
        let table = $("#allProducts");
        table.find("tr:gt(0)").remove();
        $.ajax({
                url: ".inventorySQL.php",
                type: "POST",
                data: {sqlFunc: "select"},
                success: function (data) {
                    if(data === "N/A") return;
                    let allInventory = JSON.parse(data);
                    for (const product of allInventory) {
                        let tr = document.createElement("tr");
                        tr.id = product['PRODUCT_ID'];
                        for (let property in product) {
                            let td = document.createElement("td");

                            if (property === "PRODUCT_TYPE" || property === "PRODUCT_ID" || property === "UK_SIZE"){
                                td.innerText = product[property];
                            }else if (property === "PRICE" || property === "QUANTITY"){
                                let inpTxt = document.createElement("input");
                                inpTxt.type = "number";
                                inpTxt.disabled = true;
                                inpTxt.value = product[property];
                                td.append(inpTxt);
                            }else {
                                let inpTxt = document.createElement("input");
                                inpTxt.type = "text";
                                inpTxt.disabled = true;
                                inpTxt.value = product[property];
                                td.append(inpTxt);
                            }
                            tr.append(td);
                        }

                        let colOptions = document.createElement("td");
                        let btnDelete = document.createElement("button");
                        btnDelete.className = "btnDelete";
                        btnDelete.innerText = "DELETE";
                        btnDelete.value = product['PRODUCT_ID'];
                        btnDelete.addEventListener('click', deleteInv);
                        colOptions.append(btnDelete);

                        let btnUpdate = document.createElement("button");
                        btnUpdate.className = "btnUpdate";
                        btnUpdate.innerText = "UPDATE";
                        btnUpdate.value = product['PRODUCT_ID'];
                        btnUpdate.addEventListener('click', updateInv);
                        colOptions.append(btnUpdate);

                        tr.append(colOptions);

                        table.append(tr);
                    }
                }
            })
    };

    refreshTable();

    $("[name='INSERT']").click(function (e){
        e.preventDefault();
        let inputsNotEmpty = true;
        let prodDetails = $("#addProduct :input:not(select)");
        prodDetails.each(function (){
                if($(this).val() === "") {
                    inputsNotEmpty = false;
                    alert("All Fields Must Be Entered.");
                    return false;
                }
        })

        if(inputsNotEmpty) {
            let jsonData = {
                "PRODUCT_TYPE": $("[name='PRODUCT_TYPE']").val(),
                "PRODUCT_NAME": prodDetails[0].value,
                "PRODUCT_DESCRIPTION": prodDetails[1].value,
                "UK_SIZE": prodDetails[2].value,
                "PRICE": prodDetails[3].value,
                "QUANTITY": prodDetails[4].value
            }
            $.ajax({
                url: '.inventorySQL.php',
                type: "POST",
                data: {sqlFunc: "insert", data: jsonData},
                success: function (response) {
                    if (response > 0) {
                        alert("Great success! inserted " + $("[name='PRODUCT_NAME']").val());
                        refreshTable();
                    } else {
                        alert(response)
                    }
                }
            })
        }
    });
});
