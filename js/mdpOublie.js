$(document).ready(function () {

    $("#mdpOublie").validate({
        rules: {
            mail: {
                required: true,
                email: true
            }
        },
        messages: {
            mail: "Veuillez saisir un mail valide",           
        },
        errorElement: "div",
        errorClass: "invalid-feedback",

        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);

            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
        submitHandler: function (form) {

            $.ajax({
                type: "POST",
                url: "./ajax/ajax-mdpOublie.php",
                data: {
                    mail: $("#mail").val()                 
                },
                success: function (data) {
                    $('#message').html(data);
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    $("#message").html(err.Message);
                }
            });
        }
    });


});