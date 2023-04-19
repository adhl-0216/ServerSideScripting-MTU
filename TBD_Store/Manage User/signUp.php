<?php include "../css/myHeader.html"?>
<script async src=".signUp.js"></script>
<body>
<div id="init">
<h1>New User Sign Up</h1>
<form id="signUpForm">
  <table>
    <tr><td>USERNAME</td>
      <td>
        <label><input type="text" name="USER_NAME" class="userDetails" required></label>
      </td>
    </tr>

    <tr><td>EMAIL</td>
      <td>
        <label><input type="text" name="USER_EMAIL" class="userDetails" required></label>
      </td>
    </tr>

    <tr><td>PASSWORD</td>
      <td>
        <label><input type="password" name="USER_PASSWORD" class="userDetails" required></label>
      </td>
    </tr>
    <tr><td>CONFIRM PASSWORD</td>
      <td>
        <label><input type="password" id="passwordCheck" class="userDetails" required></label>
      </td>
    </tr>
  </table>

  <input type="submit" name="signUp" value="Sign Up">
</form>
</div>
<div id="success" hidden>Great success. <a href="signIn.php">Sign In Here!</a></div>
</body>

<?php include "../css/myFooter.html"?>
