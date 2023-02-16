<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Form</title>
    <?php
    $male_status = '';
    $female_status = '';
    if (isset($_POST["btnSubmit"])){
        $selected_gender=$_POST['gender'];
        if ($selected_gender == 'male') $male_status = 'checked';
        if ($selected_gender == 'female') $female_status = 'checked';
        echo $selected_gender;
    }
    ?>
</head>
<body>

<form name="form1" action="basicForm2.php" method="post">

    <label>MALE:
        <input type="radio" value="male" name="gender" <?php echo $male_status?>>
    </label>
    <label>FEMALE:
        <input type="radio" value="female" name="gender"<?php echo $female_status?>>
    </label>
    <input type="submit" value="submit" name="btnSubmit">
</form>

</body>
</html>