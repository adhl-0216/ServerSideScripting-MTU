$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ".user_auth.php",
            dataType: "json",
            data: $(this).serialize(),
            success: function (response) {
                if (response['isValid'] === true) {
                    alert('Access Granted!');
                    window.location.href = 'http://localhost/ADHL/ServerSideScripting-MTU/TBD_Store/homepage.php';
                } else {
                    alert('Invalid Credentials!');
                }
            }
        });
    });
});