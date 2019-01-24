$(document).ready(function () {

    $("#mdpReset").validate({
        rules: {
          
            password: {
                required: true,
                minlength: 5
            },
            passwordConfirm: {
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {           
            password: {
                required: "Veullez saisir un mot de passe",
                minlength: "Le mot de passe doit contenir minimum 5 caractères"
            },
            passwordConfirm: "Le mot de passe n'est pas identique"            
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
                url: "./ajax/ajax-mdpReset.php",
                data: {                  
                    password: $("#password").val(),
                    userId: $("#uid").val()
                },
                success: function (data) {
                    if(!data){
                        $("#message").html(data);
                    }else{
                        window.location.replace("connexion.php");
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