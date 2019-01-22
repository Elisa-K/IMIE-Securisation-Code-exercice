$(document).ready(function () {

    $("#signUp").validate({
			rules: {
				mail: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 5
                },
                passwordConfirm : {
                    minlength: 5,
                    equalTo: "#password"
                },
                profil: {
                    required: true
                }
			},
			messages: {
				mail: "Veuillez saisir un mail valide",
				password: {
                    required : "Veullez saisir un mot de passe",
                    minlength: "Le mot de passe doit contenir minimum 5 caractères"
                },
                passwordConfirm : "Le mot de passe n'est pas identique",
                profil: "Veuiller saisir un profil"
			},
			errorElement: "div",
			errorClass: "invalid-feedback",

			highlight: function(element, errorClass) {
				$(element).removeClass(errorClass);

				$(element).addClass("is-invalid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass("is-invalid");
				$(element).addClass("is-valid");
			},
			submitHandler: function(form) {
               
				$.ajax({
					type: "POST",
					url: "./ajax/ajax-signup.php",
					data: {
						mail: $("#mail").val(),
                        password: $("#password").val(),
                        profil: $("#profil").val()
					},
					success: function(data) {
                        $("#message").html(data);                        
                        
					},
					error: function(xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
                        $("#message").html(err.Message);
					}
				});
			}
		});


});