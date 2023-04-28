<?php include "../css/myHeader.html";
session_start();
$_SESSION['subtotal'] = $_POST['subtotal'];
$_SESSION['checkOutItems'] = $_POST['checkOutItems'];
unset($_SESSION['prodID']);
?>
<body>
<form id="checkOutForm">
<h1>Check Out</h1>
<p class="checkOut_subtotal"><strong>SUBTOTAL: &euro; </strong><span id="subtotal"><?php if(isset($_SESSION['subtotal'])) echo $_SESSION['subtotal'] ?></span></p>
<div id="shippingInfo" class="container">
    <h2>Shipping Info</h2>
    <p>Please enter your shipping details.</p>
    <hr>
    <div class="form">

        <div class="fields fields--2">
            <label class="field">
                <span class="field__label">First name</span>
                <input class="field__input" type="text" id="firstname" />
            </label>
            <label class="field">
                <span class="field__label">Last name</span>
                <input class="field__input" type="text" id="lastname" />
            </label>
        </div>
        <label class="field">
            <span class="field__label">Address</span>
            <input class="field__input" type="text" id="address" />
        </label>

        <div class="fields fields--3">
            <label class="field">
                <span class="field__label" for="zipcode">Zip code</span>
                <input class="field__input" type="text" id="zipcode" />
            </label>
            <label class="field">
                <span class="field__label" for="city">City</span>
                <input class="field__input" type="text" id="city" />
            </label>
            <label class="field">
                <span class="field__label" for="state">State</span>
                <input class="field__input" type="text" id="state" />
            </label>
        </div>
        <label class="field">
            <span class="field__label">Country</span>
            <input class="field__input" type="text" id="country" />
        </label>
    </div>
    <hr>
</div>

<div id="paymentInfo" class="container">
    <h2>Payment</h2>
    <p>Please enter your payment details.</p>
    <hr>
    <div class="form">
        <label class="field">
            <span class="field__label">Name on Card</span>
            <input class="field__input" id="name" maxlength="20" type="text">
        </label>
        <label class="field">
            <span class="field__label">Card Number</span>
            <input class="field__input" id="cardNumber" type="number" pattern="^([0-9]{4} ){3}[0-9]{4}$" inputmode="numeric" placeholder="0000 0000 0000 0000">
        </label>

        <div class="fields fields--2">
            <label class="field">
                <span class="field__label">Expiration (mm/yy)</span>
                <input class="field__input" id="expirationDate" type="number" pattern="^[0-9]{2}\/[0-9]{2}$" inputmode="numeric" placeholder="DD/YY"/>
            </label>
            <label class="field">
                <span class="field__label">Security Code</span>
                <input class="field__input" id="expirationDate" type="number" pattern="^[0-9]{3}$" inputmode="numeric" placeholder="000" maxlength="3"/>
            </label>
        </div>
    </div>
</div>
<hr>
<button type="submit" class="button" id="continue" name="continue">Continue</button>
</form>
</body>
<script>
    $(function (){
        $(":input").each(function (){
            $(this).attr("required","");
            $(this).attr("name", $(this).attr("id"));
        })

        $("#continue").click(function (e){
            e.preventDefault();
            let form = $("#checkOutForm");
            if (form.get(0).reportValidity()){
                let data = form.serializeArray();
                let url = "../Manage User/.SQL_insertUserInfo.php"
                $.post(url, data, function (response) {
                    location.href = "../Manage Inventory/.newSale.php"
                    console.log(response);
                })

            }
        })
    })
</script>
<?php include "../css/myFooter.html"?>