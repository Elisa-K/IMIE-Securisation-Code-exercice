<?php
include('../class/BddConnect.php');
include('../class/Profil.php');
include('../class/User.php');
include('../class/PasswordReset.php');


$password = isset($_POST['password']) ? $_POST['password']: null ; 
$userId = isset($_POST['userId']) ? $_POST['userId'] : null ;
  var_dump($userId);
if(!empty($password) && !empty($userId)){
    $user = new User();
    $user->setId($userId);
    $user->setPassword($password);
    $message = $user->updateUser();
  
  
   echo $message;

   
}else{
    echo false;
}