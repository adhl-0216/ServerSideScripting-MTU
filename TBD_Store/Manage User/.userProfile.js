$(function (){
    function convertFormToJSON(form) {
        return $(form)
            .serializeArray()
            .reduce(function (json, { name, value }) {
                json[name] = value;
                return json;
            }, {});
    }
    let userID;

    $.get("../Manage User/.userSession.php", function (response){
        if (response==="N/A") location.href = "../Homepage/index.php"
        userID = response;
    }).then(function (){
        //fetch user profile
        $.ajax({
            url: ".SQL_selectUsers.php",
            type: "POST",
            data: {userID: userID},
            success: function (response){
                let userDetails = JSON.parse(response);
                // console.log(userDetails);
                $("#firstName").val(userDetails['fName']);
                $("#lastName").val(userDetails['lName']);
                $("#userEmail").val(userDetails['userEmail']);
                $("#regDate").append(userDetails['regDate'].substring(0,11));
            }
        });
    })

    //enable inputs
    $("#editDetails").click(function (e){
        e.preventDefault();
        $("#userDetails form :input").prop("disabled",false);
        $(this).prop("disabled",true);
    })
    //update details
    $("#userDetails form").submit(function (e){
        e.preventDefault();
        console.log(convertFormToJSON($(this)));
        $.ajax({
            type: "POST",
            url: ".SQL_updateUser.php",
            data: convertFormToJSON($(this)),
            success: function (){
                console.log("success");
                location.reload();
            }
        })
    })

    //sign out
    $("#signOut").click(function (e){
        e.preventDefault();
        $.post(".userSession.php", {signOut: 100}, function (){
            location.href = "../Homepage/index.php"
        })
    })
    //delete user
    $("#deleteUser").click(function (e){
        e.preventDefault();
        if (confirm("WARNING: Terminate account permanently? Account details can not be recovered after termination")){
            $.post(".SQL_deleteUsers.php", {deleteUser: 100}, function (response) {
                if (response === "100") {
                    $.post(".userSession.php", {signOut: 100}, function (){
                        location.href = "../Homepage/index.php"
                    })
                }
            })
        }
    })
});