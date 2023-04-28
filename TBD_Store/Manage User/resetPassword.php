<?php include "../css/myHeader.html"?>
<?php
session_start();
$userID = $_SESSION['userID'];

?>
<script>

    function convertFormToJSON(form) {
        return $(form)
            .serializeArray()
            .reduce(function (json, { name, value }) {
                json[name] = value;
                return json;
            }, {});
    }

    $(function(){
        let userID;
        //get userID
        $.get(".userSession.php", function (data){
            userID = data;
        })

        $("form").submit(function (e){
            e.preventDefault();
            let isValid = false;
            $.ajax({
                url: ".SQL_selectUsers.php",
                type: "POST",
                data: {userID: userID, oldPassword: $("[name='oldPassword']").val()},
                success: function (response){
                    if (response === "valid"){
                        isValid = true;
                    }else{
                        console.log("err");
                    }
                }
            }).then(function () {
                if (($("[name='cfmPassword").val() === $("[name='password']").val()) && isValid) {
                    $.ajax({
                        url: ".SQL_updateUser.php",
                        type: "POST",
                        data: convertFormToJSON($("form")),
                        success: function (response) {
                            if (response === "success") {
                                $("#resetPassword").hide();
                                $("#resetSuccess").text("Password successfully reset. Redirecting...");
                                setTimeout(function () {
                                    history.back()
                                }, 2048);
                            }
                        }
                    })
                }
            })
        })
        $("[name='cfmPassword']").keyup(function (){
            if ($("[name='cfmPassword").val() !== $("[name='password']").val()){
                $(".errMsg").show();
            }
            else {
                $(".errMsg").hide();
            }
        });
    })

</script>
<body>
<br>
<br>
<br>

<div id="resetPassword" class="container">
    <a href="userProfile.php" class="button-style">Back to Profile</a>
    <h1>Password Reset</h1>
    <div class="form">
        <form>
            <label class="field">
                <span class="field__label">Current Password</span>
                <input type="password" name="oldPassword" class="field__input">
            </label>
            <label class="field">
                <span class="field__label">Password</span>
                <input type="password" name="password" class="field__input">
            </label>
            <label class="field">
                <span class="field__label">Confirm Password</span>
                <input type="password" name="cfmPassword" class="field__input">
            </label>
            <hr>
            <input type="submit" value="Change Password" class="button">
            <p class="errMsg" hidden="hidden">Passwords do not match.</p>
        </form>
    </div>
</div>

<div id="resetSuccess"></div>
</body>
<?php include "../css/myFooter.html"?>
