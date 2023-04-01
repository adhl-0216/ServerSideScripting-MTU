<?php include "../header.html" ?>
<title>TBD Store Homepage</title>
<header>
<div>
    <div id="home"><a href="homepage.php"></div>
    <div id="user"><a href="../Manage User/Profile.html"></a> </div>
    <div id="cart"><a href="../Manage Cart/cart.html"></a> </div>
</div>
</header>
<div>
    <ul class="navigation">
        <li><a href="">Jersey</a></li>
        <li><a href="">Footwear</a></li>
        <li><a href="">Equipment</a></li>
        <li><a href="">Accessories</a></li>
    </ul>
</div>
    <div class="carousel">
        <input type="radio" name="carousel" id="slide-btn-1" class="slide-btn" onclick="setInt();" checked />
        <input type="radio" name="carousel" id="slide-btn-2" class="slide-btn" onclick="setInt();" />
        <input type="radio" name="carousel" id="slide-btn-3" class="slide-btn" onclick="setInt();" />
        <input type="radio" name="carousel" id="slide-btn-4" class="slide-btn" onclick="setInt();" />
        <div class="slide one parallax-effect"><h1>Jerseys</h1>
            <div class="credit"></a></div></div>
        <div class="slide two parallax-effect"><h1>Foot Wears</h1>
            <div class="credit"></a></div></div>
        <div class="slide three parallax-effect"><h1>Equipments</h1>
            <div class="credit"></a></div></div>
        <div class="slide four parallax-effect"><h1>Accessories</h1>
            <div class="credit"></a></div></div>
        <div class="labels">
            <label for="slide-btn-1"></label>
            <label for="slide-btn-2"></label>
            <label for="slide-btn-3"></label>
            <label for="slide-btn-4"></label>
        </div>
    </div>

<h2>Hello <?php session_start(); echo $_SESSION['username'];?></h2>

<script src=".homepageNav.js"></script>
<?php include "../footer.html" ?>

