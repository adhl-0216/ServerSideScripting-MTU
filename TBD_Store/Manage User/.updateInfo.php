<?php include "../css/myHeader.html"; ?>
<?php
session_start();
include "../.dbConnect.php";
$userID = $_SESSION['userID'];
    try {
        dbConnect($pdo);
        $sqlCount = "SELECT COUNT(*) FROM tbd_store.user_info WHERE USER_ID=:userID";
        $stmt = $pdo->prepare($sqlCount);
        $stmt->bindValue(":userID", $userID);
        $stmt->execute();
        $count = $stmt->fetch()[0];
        if ($count > 0) {
            $sqlSelect = "SELECT * FROM tbd_store.user_info WHERE USER_ID=:userID";
            $stmt = $pdo->prepare($sqlSelect);
            $stmt->bindValue(":userID", $userID);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $first_name = $row['FIRST_NAME'];
                $last_name = $row['LAST_NAME'];
                $address = $row['ADDRESS'];
                $zipcode = $row['ZIPCODE'];
                $city = $row['CITY'];
                $state = $row['STATE'];
                $country = $row['COUNTRY'];
                $cardName = $row['NAME_ON_CARD'];
                $cardNum = $row['CARD_NUMBER'];
                $cardExp = $row['CARD_EXPIRATION_DATE'];
            }
        }
    }catch (PDOException $ex){
        echo "<hidden>$ex</hidden>";
    }
?>
<script>

    $(function (){
        $(":input").attr("required",true)

        $("#updateInfo").submit(function (e) {
            e.preventDefault();
            let valid  = this.reportValidity()
            let data = $(this).serializeArray();
            console.log(valid);
            if(valid){
                $.post(".SQL_updateInfo.php", data, function (res){
                    if (res > 0){
                        alert("Update Successful")
                        location.reload();
                    }else {
                        console.log(res)
                    }
                })
            }
        })
    })
</script>
<body>
<form id="updateInfo">
<h1>Update Info</h1>
<div id="shippingInfo" class="container">
    <h2>Shipping Info</h2>
    <p>Please enter your shipping details.</p>
    <hr>
    <div class="form">

        <div class="fields fields--2">
            <label class="field">
                <span class="field__label">First name</span>
                <input class="field__input" type="text" name="firstname"
                       value="<?php echo $first_name ?? "" ?>" />
            </label>
            <label class="field">
                <span class="field__label">Last name</span>
                <input class="field__input" type="text" name="lastname"
                       value="<?php echo $last_name ?? "" ?>"/>
            </label>
        </div>
        <label class="field">
            <span class="field__label">Address</span>
            <input class="field__input" type="text" name="address"
                   value="<?php echo $address ?? "" ?>"/>
        </label>

        <div class="fields fields--3">
            <label class="field">
                <span class="field__label" for="zipcode">Zip code</span>
                <input class="field__input" type="text" name="zipcode"
                       value="<?php echo $zipcode ?? "" ?>"/>
            </label>
            <label class="field">
                <span class="field__label" for="city">City</span>
                <input class="field__input" type="text" name="city"
                       value="<?php echo $city ?? "" ?>"/>
            </label>
            <label class="field">
                <span class="field__label" for="state">State</span>
                <input class="field__input" type="text" name="state"
                       value="<?php echo $state ?? "" ?>"/>
            </label>
        </div>
        <label class="field">
            <span class="field__label">Country</span>
            <input class="field__input" type="text" name="country"
                   value="<?php echo $country ?? "" ?>"/>
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
            <input class="field__input" name="cardName" maxlength="20" type="text"
                   value="<?php echo $cardName ?? "" ?>">
        </label>
        <label class="field">
            <span class="field__label">Card Number</span>
            <input class="field__input" name="cardNumber" type="text" pattern="^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$" inputmode="numeric" placeholder="0000 0000 0000 0000" maxlength="19"
                   value="<?php echo $cardNum ?? "" ?>"/>
        </label>

        <div class="fields fields--2">
            <label class="field">
                <span class="field__label">Expiration (mm/yy)</span>
                <input class="field__input" name="expirationDate" type="text" pattern="^([0-9]{2})/([0-9]{2})$" inputmode="numeric" placeholder="DD/YY" maxlength="5"
                       value="<?php echo $cardExp ?? "" ?>"/>
            </label>
        </div>
    </div>
</div>
<hr>
<button type="submit" class="button" id="btnUpdate" name="btnUpdate">Update</button>
</form>
</body>

<?php include "../css/myFooter.html"?>