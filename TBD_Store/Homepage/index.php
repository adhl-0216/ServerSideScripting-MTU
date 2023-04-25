<?php include "../css/myHeader.html" ?>
<?php
    session_start();
    if (isset($_POST['signOut'])) {
        session_destroy();
    }
?>
<script async src=".homepageNav.js"></script>
<nav>
    <div>
        <ul >
            <li><a href="../Manage%20Listings/viewListings.php?p=FW">Footwear</a></li>
            <li><a href="../Manage%20Listings/viewListings.php?p=JR">Jersey</a></li>
            <li><a href="../Manage%20Listings/viewListings.php?p=AC">Accessories</a></li>
        </ul>
    </div>
</nav>
<body>
<div class="carousel" >
    <input type="radio" name="carousel" id="slide-btn-1" class="slide-btn" onclick="setInt();" checked >
    <input type="radio" name="carousel" id="slide-btn-2" class="slide-btn" onclick="setInt();" >
    <input type="radio" name="carousel" id="slide-btn-3" class="slide-btn" onclick="setInt();" >
    <div class="slide one parallax-effect"><h1>Footwear</h1></div>
    <div class="slide two parallax-effect"><h1>Jerseys</h1></div>
    <div class="slide three parallax-effect"><h1>Accessories</h1></div>
    <div class="labels">
        <label for="slide-btn-1"></label>
        <label for="slide-btn-2"></label>
        <label for="slide-btn-3"></label>
    </div>
</div>
</body>
<?php include "../css/myFooter.html" ?>

