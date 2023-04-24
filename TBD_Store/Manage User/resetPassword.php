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
        $("form").submit(function (e){
            e.preventDefault();
            if ($("[name='cfmPassword").val() === $("[name='password']").val()){
                $.ajax({
                    url: ".SQL_updateUser.php",
                    type: "POST",
                    data: convertFormToJSON($(this)),
                    success: function (){
                        console.log("success");
                        $("#resetPassword").hide();
                        $("#resetSuccess").text("Password successfully reset. Redirecting...");
                        setTimeout(function(){history.back()}, 2048);
                    }
                })
            }

        })
        $("[name='cfmPassword']").keyup(function (){
            if ($("[name='cfmPassword").val() !== $("[name='password']").val()){
                console.log("errMsg");
                $(".errMsg").show();
            }
            else {
                $(".errMsg").hide();
            }
        });
    })
</script>
<body>
<h1>Password Reset</h1>
<div id="resetPassword">
    <form>
        <label>Password
            <input type="password" name="password">
        </label>
        <label>Confirm Password
            <input type="password" name="cfmPassword">
        </label>
        <input type="submit" value="Change Password">
        <p class="errMsg" hidden="hidden">Passwords do not match.</p>
    </form>
</div>
<div id="resetSuccess"></div>
</body>
<?php include "../css/myFooter.html"?>
