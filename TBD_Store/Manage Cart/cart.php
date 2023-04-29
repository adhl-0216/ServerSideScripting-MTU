<?php include "../css/myHeader.html";
session_start();
?>

<script type="text/javascript" src=".generateCart.js"></script>
<body>
<h1>Your Cart</h1>
<div class="form-container">
<table id="cartItems" class="cart">
    <tr><th>Item(s)</th><th>Details</th><th>Remove</th></tr>
</table>
    <p><strong>SUBTOTAL: &euro; </strong><span id="subtotal"></span></p>

    <a href="" class="button-style" id="btnCheckOut">CHECK OUT</a>
    <a href="" class="button-style" id="btnClear">CLEAR CART</a>
</div>
</body>
<?php include "../css/myFooter.html"?>
