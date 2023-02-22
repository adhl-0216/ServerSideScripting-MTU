<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBD STORE</title>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>
<h1>Welcome!</h1>
<form method="post" id="loginForm">
    <label>Username:
        <input type="text" name="username">
    </label>
    <label>Password:
        <input type="password" name="password">
    </label>
    <input type="submit" value="LOG IN" name="submit">
</form>

</body>
<script>
$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "user_auth.php",
            data: $(this).serialize(),
            success: function (response) {
                let jsonData = JSON.parse(response);
                if (jsonData.validCred === true) {
                    alert('Access Granted!');
                    window.location.href = 'homepage.php';
                } else {
                    alert('Invalid Credentials!');
                }
            }
        });
    });
});
</script>
</html>
