$(document).ready(function () {

    $("#signIn").validate({
        rules: {
            mail: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            mail: "Veuillez saisir un mail valide",
            password: {
                required: "Veullez saisir un mot de passe",
                minlength: "Le mot de passe doit contenir minimum 5 caractères"
            }
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
                url: "./ajax/ajax-signin.php",
                data: {
                    mail: $("#mail").val(),
                    password: $("#password").val()                   
                },
                success: function (data) {
                    
                    if(data.length == 0){                        
                        window.location.replace('./profilUser.php');
                    }else{
                        $('#messge').html(data);
                    }
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    $("#message").html(err.Message);
                }
            });
        }
    });


});