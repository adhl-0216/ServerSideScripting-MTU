<?php include "../css/myHeader.html" ?>
<?php
    session_start();
    $username = null;
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        echo 'Hello '.$username;
    }
    else{
        header("Location: signIn.php");
    }
?>
<script>
    $(function (){
        $.ajax({
            url: ".selectUserByUsername.php",
            type: "POST",
            data: {username: '<?php echo $username?>'},
            success: function (response){
                console.log(response);
            }
        })
    });
</script>
<body>
<form method="post" action=".deleteUsers.php">
    <input type="submit" name="deleteUser" value="TERMINATE ACCOUNT">
</form>
</body>
<?php include "../css/myFooter.html" ?>
