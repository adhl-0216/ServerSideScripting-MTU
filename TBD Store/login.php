<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBD STORE</title>
</head>
<body>
<h1>Welcome!</h1>
<form action="login.php" method="post">
    <label>Username:
        <input type="text" name="username">
    </label>
    <label>Password:
        <input type="password" name="password">
    </label>
    <input type="submit" value="LOG IN" name="submit">
</form>
<?php include "user_auth.php" ?>
</body>
</html>
