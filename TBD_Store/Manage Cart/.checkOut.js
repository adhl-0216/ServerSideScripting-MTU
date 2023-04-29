$(function (){
    $(":input").each(function (){
        $(this).attr("required","");
        $(this).attr("name", $(this).attr("id"));
    })

    $("#continue").click(function (e){
        e.preventDefault();
        let valid = document.getElementById("checkOutForm").reportValidity();
        if (valid){
            console.log("valid")
            let data = $("#checkOutForm").serializeArray();
            let url = "../Manage User/.SQL_insertUserInfo.php"
            $.post(url, data, function (response) {
                console.log(response);

                location.href = "../Manage Inventory/.newSale.php"
            })
        }
    })
})