$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "user_auth.php",
            data: $(this).serialize(),
            success: function (response) {
                let jsonData = JSON.parse(response);
                // alert (response);
                if (jsonData.validCred === true) {
                    alert('Access Granted!');
                    window.location.href = '.homepage.php';
                } else {
                    alert('Invalid Credentials!');
                }
            }
        });
    });
});