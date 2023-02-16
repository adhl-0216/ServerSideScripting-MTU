<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Form</title>
    <?php
    if (isset($_POST["btnSubmit"])){
        $username=$_POST['username'];
        if($username == "Adrian"){
            echo 'Welcome back, '.$username;
        }else {
            echo "You're not a member of this site.";
        }
    }
    ?>
</head>
<body>

<form name="form1" action="basicForm.php" method="post">

    <label>USERNAME:
        <input type="text"
               value="<?php
               if (!isset($_POST['username'])) echo "username";
               else echo $_POST['username'];
        ?>" name="username">
    </label>
    <input type="submit" value="login" name="btnSubmit">
</form>

</body>
</html>