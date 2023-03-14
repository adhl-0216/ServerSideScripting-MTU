<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
</head>
<body>
<form method="post" action=".terminateUser.php">
    <input type="hidden" name="username" value="<?php echo $_GET['uid']?>">
    <input type="submit" name="terminateUser" value="TERMINATE ACCOUNT">
</form>
</body>

</html>

