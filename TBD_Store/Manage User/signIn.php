<?php include "../css/myHeader.html" ?>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: userProfile.php");
    }
?>
<script src=".signIn.js"></script>
<body>
<h1>Welcome!</h1>
<form method="post" name="signIn" id="signInForm">
    <label>Username:
        <input type="text" name="username">
    </label>
    <label>Password:
        <input type="password" name="password">
    </label>
    <input type="submit" name="login" value="SIGN IN">
</form>
Don't have an account? <a href="signUp.php">Sign Up here.</a>
</body>
<?php include "../css/myFooter.html" ?>
