function convertFormToJSON(form) {
    return $(form)
        .serializeArray()
        .reduce(function (json, { name, value }) {
            json[name] = value;
            return json;
        }, {});
}

$(function (){
    $("#signUpForm").submit(function (e){
        e.preventDefault();
        let pswCheck = $("#passwordCheck").val();
        let psw = $("[name='USER_PASSWORD']").val();
        if (psw===pswCheck){
            $.ajax({
                url: ".SQL_insertUsers.php",
                type: "POST",
                data: $(this).serializeArray(),
                success: function (response) {
                    if (response === "success"){
                        $("#success").show();
                        $("#init").hide();
                    }
                }
            })
        }else{
            alert("Passwords Do Not Match")
        }
    })
})