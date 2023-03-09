<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<title>TBD Store Homepage</title>
<h1>Welcome to TBD Store!</h1>
<form>
<input type="button" name="cart" value="CART">
<input type="button" name="profile" value="PROFILE">
</form>
<script>
$(document).ready(function(){
   $("[name='profile']").click(function (){
       $(window).attr('location','user_profile.html');
   })
})
</script>
<?php
