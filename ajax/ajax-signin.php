<?php

include('../class/BddConnect.php');
include('../class/Profil.php');
include('../class/User.php');

session_start();

$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;


if(!empty($mail) && !empty($password)){

    $user = new User();
    $retour = $user->getUser($mail, $password);  
    if($retour){
        
        $_SESSION['id'] = $retour->getId();
        echo null;
    }else{
        echo "Le profil n'existe pas !";
    }
}else{
    echo "Veuillez renseigner tous les champs requis !";
}
