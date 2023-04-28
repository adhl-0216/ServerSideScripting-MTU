<?php include "../css/myHeader.html" ?>
<?php
session_start();
$userID = null;
if(isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
}
else header("Location: ../Homepage/index.php");

?>
<script type="text/javascript" src=".userProfile.js"></script>

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
<hr>
<div class="buttons-container">
    <a href="resetPassword.php" class="button-style">Change Password</a>
    <a href="" class="button-style" id="signOut">Sign Out</a>
    <a href="" class="button-style button-style-red" id="deleteUser">Terminate Account</a>
    <br>
    <a href="purchaseHistory.php" class="button-style" id="purchaseHistory">Purchase History</a>
</div>

</body>
<?php include "../css/myFooter.html" ?>
