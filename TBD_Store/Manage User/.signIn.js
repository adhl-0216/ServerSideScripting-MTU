$(document).ready(function() {
    $('#signInForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: ".user_auth.php",
            dataType: "json",
            data: $(this).serialize(),
            success: function (response) {
                if (response['isValid'] === true) {
                    window.location.href = '../Homepage/index.php';
                } else {
                    alert('Invalid Credentials!');
                }
            }
        });
    });

});