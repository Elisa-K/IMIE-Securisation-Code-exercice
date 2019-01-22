<?php

include('../class/BddConnect.php');
include('../class/Profil.php');
include('../class/User.php');

$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$idProfil = isset($_POST['profil']) ? $_POST['profil'] : null;

if(!empty($mail) && !empty($password) && !empty($idProfil)){

    $user = new User();
    $user->setMail($mail);
    $user->setPassword($password);
    $user->setProfil($idProfil);

    $message = $user->addUser();

    echo $message;
}else{
    echo "Veuillez renseigner tous les champs requis !";
}
