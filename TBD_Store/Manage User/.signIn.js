function convertFormToJSON(form) {
    return $(form)
        .serializeArray()
        .reduce(function (json, { name, value }) {
            json[name] = value;
            return json;
        }, {});
}

$(document).ready(function() {

    $('#signInForm').submit(function(e) {
        e.preventDefault();
        let url = ".user_auth.php";
        $.ajax({
            type: "POST",
            url: url,
            data: convertFormToJSON($(this)),
            success: function (response) {
                console.log(response);
                let jsonRes = JSON.parse(response);
                if (jsonRes['isValid'] === true) {
                    window.location.href = '../Homepage/index.php';
                } else {
                    $("#signInForm").append("Invalid Credentials")
                }
            }
        });
    });

});