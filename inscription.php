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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1>Inscription</h1>

                <div class="card p-4">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="Mail">Mail</label>
                            <input type="text" class="form-control" id="Mail" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="Mdp">Mot de passe</label>
                            <input type="password" class="form-control" id="Mdp" name="mdp" required>
                        </div>
                        <div class="form-group">
                            <label for="Profil">Profil</label>
                            <select name="profil" id="Profil" class="form-control">
                                <option value="employe">Employé</option>
                                <option value="employeur">Employeur</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="S'inscrire">
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>