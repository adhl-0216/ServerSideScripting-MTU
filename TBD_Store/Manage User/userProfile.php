<?php include "../css/myHeader.html" ?>
<?php
session_start();
$userID = null;
if(isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
}
else header("Location: signIn.php");
?>
<script type="text/javascript" src=".userProfile.js"></script>

<body>
<h1>Profile Information</h1>
<div id="userDetails">
    <form name="updateForm">
        <table id="profileDetails">
            <tr>
                <td><label for="userEmail">Email:&nbsp&nbsp</label></td>
                <td><input type="email" id="userEmail" name="userEmail" disabled></td>
            </tr>
        </table>
        <button id="editDetails">Edit</button>
        <input type="submit" name="updateDetails" value="Save Changes" disabled>
    </form>
    <p id="regDate">Registration Date: </p>
</div>
<hr>
<div class="buttons-container">
    <a href="purchaseHistory.php" class="button-style" id="purchaseHistory">Purchase History</a>
    <div class="fields--2">
    <a href="resetPassword.php" class="button-style">Change Password</a>
    <a href=".updateInfo.php" class="button-style">Update Shipping & Payment Info</a>
    </div>
    <div class="fields--2">
    <a href="" class="button-style" id="signOut">Sign Out</a>
    <a href="" class="button-style button-style-red" id="deleteUser">Terminate Account</a>
    </div>
</div>

</body>
<?php include "../css/myFooter.html" ?>
