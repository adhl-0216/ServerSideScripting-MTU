<?php include "../header.html" ?>
<title>TBD Store Homepage</title>
<script src=".homepageNav.js"></script>
<body>
<div id="header">
    <p>TBD Store</p>
    <div id="home"><a href="homepage.php">HOME</a></div>
    <div id="user"><a href="../Manage User/Profile.html">PROFILE</a></div>
    <div id="cart"><a href="../Manage Cart/cart.html">CART</a></div>
</div>
<div>
    <ul >
        <li><a href="../View Listings/footwear.php">Footwear</a></li>
        <li><a href="../View Listings/jersey.php">Jersey</a></li>
        <li><a href="../View Listings/equipment.php">Equipment</a></li>
        <li><a href="../View Listings/accessories.php">Accessories</a></li>
    </ul>
</div>
<div>
    <img src="../rsc/footwear.webp" alt="">
    <img src="../rsc/jerseys.webp" alt="">
    <img src="../rsc/equipments.webp" alt="">
    <img src="../rsc/accessories.jpg" alt="">
</div>


<h2>Hello <?php session_start(); echo $_SESSION['username'];?></h2>

</body>
<?php include "../footer.html" ?>

