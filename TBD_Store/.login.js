$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "user_auth.php",
            data: $(this).serialize(),
            success: function (response) {
                // alert (response);
                let jsonData = JSON.parse(response);
                if (jsonData['isValid'] === true) {
                    alert('Access Granted!');
                    window.location.href = 'homepage.php?uid=' + jsonData['user'];
                } else {
                    alert('Invalid Credentials!');
                }
            }
        });
    });
});