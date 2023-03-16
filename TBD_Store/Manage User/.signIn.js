$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "user_auth.php",
            dataType: "json",
            data: $(this).serialize(),
        }).success(function (response) {
            let jsonData = JSON.parse(response);
            if (jsonData['isValid'] === true) {
                alert('Access Granted!');
                window.location.href = 'http://localhost/ADHL/TBD_Store/homepage.php';
            } else {
                alert('Invalid Credentials!');
            }
        });
    });
});