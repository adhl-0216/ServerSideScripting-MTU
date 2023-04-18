$(function (){
    $("#signUpForm").submit(function (e){
        e.preventDefault();
        alert('prevented default');
        $.ajax({
            url: ".insertUsersSQL.php",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response === "success"){
                    $("#success").show();
                    $("#init").hide();
                }
            }
        })
    })
})