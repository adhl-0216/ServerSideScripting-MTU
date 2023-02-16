<title>Welcome</title>
<?php
//    echo 'Welcome to our website, '.$_GET['forename'];
//    echo "Welcome to our website, {$_GET['firstname']} {$_GET['lastname']}";
    echo "Welcome to our website, {$_POST['firstname']} {$_POST['lastname']}<br>";
    echo "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]<br>";
    foreach ($_POST as $value ) {
        echo "$value <br>";
    }
?>
