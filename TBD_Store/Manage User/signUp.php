<?php include "../css/myHeader.html"?>
<script async src=".signUp.js"></script>
<body>
<div id="init">
<h1>New User Sign Up</h1>
<form id="signUpForm" class="userDetails">
  <table>
    <tr><td>FIRST NAME</td>
      <td>
        <label><input type="text" name="FIRST_NAME" required></label>
      </td>
    </tr>

    <tr><td>LAST NAME</td>
      <td>
        <label><input type="text" name="LAST_NAME" required></label>
      </td>
    </tr>

    <tr><td>EMAIL</td>
      <td>
        <label><input type="email" name="USER_EMAIL" required></label>
      </td>
    </tr>

    <tr><td>PASSWORD</td>
      <td>
        <label><input type="password" name="USER_PASSWORD" required></label>
      </td>
    </tr>
    <tr><td>CONFIRM PASSWORD</td>
      <td>
        <label><input type="password" id="passwordCheck" required></label>
      </td>
    </tr>
  </table>

  <input type="submit" name="signUp" value="Sign Up">
</form>
</div>
<div id="success" hidden>Great success. <a href="signIn.php">Sign In Here!</a></div>
</body>

<?php include "../css/myFooter.html"?>
