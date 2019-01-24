<?php

include('../class/BddConnect.php');
include('../class/Profil.php');
include('../class/User.php');
include('../class/PasswordReset.php');



$mail = isset($_POST['mail']) ? $_POST['mail'] : null;

if(!empty($mail)){
    $user = new User();

    $user = $user->getUserByMail($mail);

    if($user){
        
        $userEmail = $user->getMail();
        $userId = $user->getId(); 
      
        $passwordReset = new PasswordReset();
        $passwordResetId = $passwordReset->addToken($userId);
        
        if($passwordResetId){     
            $reset = $passwordReset->getTokenById($passwordResetId);
            if(!empty($reset)){
                $token = $reset->getToken();
            $verifyScript = 'reset-mdp.php';
            $lienURL = "<a href='".$verifyScript . '?uid=' . $userId . '&id=' . $passwordResetId . '&t=' . $token."'> Cliquez ici pour recréer votre mot de passe </a>";
                echo $lienURL;
            }else{
                echo "Une erreur s'est produite.";
            }
           
        }else{
            echo "Une erreur s'est produite.";
        }
        
        
        
        


         /*TO DO */
        //fonction envoie de l'email à l'utilisateur avec le lien pour recreer un mot de passe
    }else{
        echo "Le mail n'existe pas !";
    }
}else{
    echo "Veuillez renseigner votre mail ! ";
}
