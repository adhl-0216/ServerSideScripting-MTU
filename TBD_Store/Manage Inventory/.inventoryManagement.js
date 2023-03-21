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
        // console.log("clicked");
        $("#addProduct").serialize()
        // $.ajax('.insertInventory.php',
        //     {
        //     data: $("table #addProduct").serialize()
        // })
    })
})