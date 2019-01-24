<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice sécurité code - Mot de passe oublié</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
          

<?php 
require('class/BddConnect.php');
require('class/User.php');
require('class/PasswordReset.php');

if(isset($_GET['uid']) && isset($_GET['id']) && isset($_GET['t'])){
    $uid = $_GET['uid'];
    $id = $_GET['id'];
    $token = $_GET['t'];
    $curDate = date('Y-m-d H:i:s');

    $passwordReset = new PasswordReset();

    $passwordReset = $passwordReset->getReset($id, $token, $uid);
   
    if($passwordReset){
        $dateExp = $passwordReset->getDateExp();
        if($dateExp >= $curDate){ ?>
             <div class="card p-4">
                    <form id="mdpReset" method="POST">
                        <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="passwordConfirm">Confirmez le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" required>
                        </div>              
                        <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
                        <input type="submit" class="btn btn-primary" value="Valider">
                    </form>
                    <div id="message"></div>
                </div>
      <?php  
        }else{ ?>
            <div class="alert alert-danger">
                Le lien a expiré !
            </div>
       <?php }
    }else{ ?>
        <div class="alert alert-danger">
                Le lien est invalide !
        </div>
    <?php }
    
    
}

?>
    
                
               
               
            </div>
        </div>
    </div>
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script src="js/mdpReset.js"></script>
</body>
</html>