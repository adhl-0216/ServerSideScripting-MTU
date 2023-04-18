<?php include "../css/myHeader.html" ?>
<?php
session_start();
$username = null;
if(isset($_SESSION['username'])) $username = $_SESSION['username'];
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
                $("#userDetails").html(
                    '<p>'+userDetails['username']+'</p>'+
                    '<p>'+userDetails['userEmail']+'</p>'+
                    '<p>'+userDetails['regDate']+'</p>'
                )
            }
        });
    });
</script>
<body>
<div id="userDetails"></div>
<form method="post" action=".SQL_deleteUsers.php">
    <input type="submit" name="deleteUser" value="TERMINATE ACCOUNT">
</form>
</body>
<?php include "../css/myFooter.html" ?>
