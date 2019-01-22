<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice sécurité code - Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <?php 
    
    require('class/BddConnect.php');
    require('class/Profil.php'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1>Inscription</h1>

                <div class="card p-4">
                    <form method="POST" id="signUp">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="text" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                         <div class="form-group">
                            <label for="passwordConfirm">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" required>
                        </div>
                        <div class="form-group">
                            <label for="profil">Profil</label>
                            <select name="profil" id="profil" class="form-control">
                            
                            <?php 
                            $profil = new Profil();
                            $tabProfil = $profil->getAllProfil();
                            foreach($tabProfil as $profil){
                                echo "<option value='".$profil->getId()."'>".$profil->getLibelle()."</option>";
                            }
                            
                            ?>                               
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="S'inscrire">
                    </form>
                </div>
               <div id="message"></div>
            </div>
        </div>
    </div>
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script src="js/inscription.js"></script>
</body>
</html>