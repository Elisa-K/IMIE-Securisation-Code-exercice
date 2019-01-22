$(document).ready(function(){

    $('#disconnect').click(function(){
        $.ajax({
            url: "./ajax/ajax-disconnect.php",
            success:function(data){
                console.log(data);
                if(data){
                    window.location.replace("./index.php");
                }else{
                    $('#message').html("Une erreur s'est produite lors de la déconnexion");
                }
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                $("#message").html(err.Message);
            }
        })
    })
})