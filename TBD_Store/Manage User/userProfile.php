<?php include "../css/myHeader.html" ?>
<?php
session_start();
$username = null;
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

}
else header("Location: ../Homepage/index.php");
?>
<script>
    $(function (){
        $.ajax({
            url: ".SQL_selectUsers.php",
            type: "POST",
            data: {username: "<?php echo $username?>"},
            success: function (response){
                let userDetails = JSON.parse(response);
                console.log(userDetails);
                console.log(userDetails['username']);
                $("#username").val(userDetails['username'])
                $("#userEmail").val(userDetails['userEmail'])
                $("#regDate").text(userDetails['regDate'])
            }
        });
    });
</script>
<body>
<div id="userDetails">
    <form>
        <label for="username">USERNAME </label><input type="text" id="username" disabled>
        <br>
        <label for="userEmail">EMAIL </label><input type="text" id="userEmail" disabled>
        <p id="regDate"></p>
    </form>

</div>
<a href="resetPassword.php">Change Password</a>
<?php
if ($username === "admin"){
    echo "<a href='../Manage%20Inventory/inventoryManagement.php'>Inventory Management</a>";
}
?>

<form method="post" action="../Homepage/index.php">
    <input type="submit" name="signOut" value="SIGN OUT">
</form>
<form method="post" action=".SQL_deleteUsers.php">
    <input type="submit" name="deleteUser" value="TERMINATE ACCOUNT">
</form>
</body>
<?php include "../css/myFooter.html" ?>
