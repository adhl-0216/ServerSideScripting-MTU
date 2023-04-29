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
    function inputValidation(rowIdx) {
        let price = $(`#allProducts tr[id="${rowIdx}"] :input[name="PRICE"]`).val();
        let quantity = $(`#allProducts tr[id="${rowIdx}"] :input[name="QUANTITY"]`).val();
        return !(isNaN(parseFloat(price)) || isNaN(parseInt(quantity)));
    }
    let updateInv = function (e){
        let btn = e.target;
        let status = btn.innerText;
        let rowIdx = btn.parentNode.parentNode.id;
        let inputs = $(`#allProducts tr[id="${rowIdx}"] :input:not(button)`);
        $('#allProducts :button').prop("disabled", true);
        btn.disabled = false;

        if (status === "UPDATE"){
            btn.innerText = "DONE";
            inputs.prop("disabled", false);

        }else if (status === "DONE") {
            btn.innerText = "UPDATE";
            if(!inputValidation(rowIdx)) {
                alert("Invalid Input!");
                refreshTable();
                return;
            }
            let prodDetails = {
                prodID:btn.value,
                prodName: inputs.eq(0).val(),
                prodDesc: inputs.eq(1).val(),
                price: inputs.eq(2).val(),
                quantity: inputs.eq(3).val()
            }
            $.ajax({
                url: ".inventorySQL.php",
                type: "POST",
                data: {sqlFunc: "update", data: prodDetails},
                success: () => {
                    refreshTable();
                },
                catch: (err) => {
                    console.log(err);
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
                                inpTxt.name = property;
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
                        btnDelete.id = product['PRODUCT_ID'];
                        btnDelete.innerText = "DELETE";
                        btnDelete.value = product['PRODUCT_ID'];
                        btnDelete.addEventListener('click', deleteInv);
                        colOptions.append(btnDelete);

                        let btnUpdate = document.createElement("button");
                        btnUpdate.className = "btnUpdate";
                        btnUpdate.id = product['PRODUCT_ID'];
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

    $("#btnUploadImg").click(function (e){
        e.preventDefault();
        let formData = new FormData();
        formData.append('PRODUCT_IMG',$("#imgFile")[0].files[0]);
        formData.append('PRODUCT_TYPE',$("#prodType").val());
        $.ajax({
            url: ".uploadProductIMG.php",
            type:"POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                $("#btnAddStock").prop("disabled", false)
            }
        })
    })

    let form = $("form#addProduct").submit(function (e){
        e.preventDefault();
        let valid = this.reportValidity();

        if(valid) {

            let data = $(this).serializeArray()
            $.ajax({
                url: '.SQL_insertInventory.php',
                type: "POST",
                data: data,
                success: function (response) {
                    if (response > 0) {
                        alert("Great success! inserted " + $("[name='PRODUCT_NAME']").val());
                        refreshTable();
                    } else {
                        alert(response)
                    }
                }
            }).then(function () {
                let prodImg = $("#imgFile").val().toString().substring(12);

                let prodName = $("#prodName").val();
                let jsonData = {prodImg: prodImg, prodName: prodName}
                console.log(jsonData);
                $.post(".SQL_insertInventory.php", jsonData, function (response) {
                    console.log(response);
                })

            })
        }
    });


});
