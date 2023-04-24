<?php include "../css/myHeader.html" ?>
<?php
session_start();
$userID = null;
if(isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
}
else header("Location: ../Homepage/index.php");

?>
<script>
    $(function (){
        function convertFormToJSON(form) {
            return $(form)
                .serializeArray()
                .reduce(function (json, { name, value }) {
                    json[name] = value;
                    return json;
                }, {});
        }
        //fetch user profile
        $.ajax({
            url: ".SQL_selectUsers.php",
            type: "POST",
            data: {userID: "<?php echo $userID?>"},
            success: function (response){
                let userDetails = JSON.parse(response);
                console.log(userDetails);
                $("#firstName").val(userDetails['fName']);
                $("#lastName").val(userDetails['lName']);
                $("#userEmail").val(userDetails['userEmail']);
                $("#regDate").append(userDetails['regDate'].substring(0,11));
            }
        });
        //enable inputs
        $("#editDetails").click(function (e){
            e.preventDefault();
            $("#userDetails form :input").prop("disabled",false);
            $(this).prop("disabled",true);
        })
        //update details
        $("#userDetails form").submit(function (e){
            e.preventDefault();
            console.log(convertFormToJSON($(this)));
            $.ajax({
                type: "POST",
                url: ".SQL_updateUser.php",
                data: convertFormToJSON($(this)),
                success: function (){
                    console.log("success");
                    location.reload();
                }
            })
        })
    });
</script>

<body>
<h1>Profile Information</h1>
<div id="userDetails">
    <form name="updateForm">
        <label for="firstName">FIRST NAME </label><input type="text" id="firstName" name="firstName" disabled>
        <br>
        <label for="lastName">LAST NAME </label><input type="text" id="lastName" name="lastName" disabled>
        <br>
        <label for="userEmail">EMAIL </label><input type="email" id="userEmail" name="userEmail" disabled>
        <br>
        <button id="editDetails">Edit</button>
        <input type="submit" name="updateDetails" value="Save Changes" disabled>
    </form>
    <p id="regDate">Registration Date: </p>
</div>
<a href="resetPassword.php" class="button-style">Change Password</a>
<?php
if ($userID === 0){
    echo "<a href='../Manage%20Inventory/inventoryManagement.php' class='button-style'>Inventory Management</a>";
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
