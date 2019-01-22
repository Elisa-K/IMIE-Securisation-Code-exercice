<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice sécurité code - Mon profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <?php 
    
    require('class/BddConnect.php');
    require('class/Profil.php');
    require('class/User.php');
    
    session_start();

    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ 
        
    $user = new User();
    $user = $user->getUserById($_SESSION['id']);
    ?>

    
  
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1>Profil de <?php echo $user->getMail() . " (".$user->getProfil()->getLibelle().")"; ?></h1>
                <a id="disconnect" class='btn btn-danger'>Déconnexion</a>
                <div id="#message"></div>
            </div>
        </div>
    </div>
    

    <?php } else header("Location : index.php");

    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script src="js/deconnexion.js"></script>
</body>
</html>