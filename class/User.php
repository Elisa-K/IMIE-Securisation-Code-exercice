<?php

class User {

    protected $id;
    protected $mail;
    protected $password;
    protected $profil;
    private $connect;



    public function __construct()
    {
        $db = BddConnect::getInstance();
        $this->connect = $db->getDbh();
    }

    public function addUser(){

        try{
            //verification si le mail n'a pas déjà été utilisé
            if($this->verifUniqueMail($this->mail)){
                $req = $this->connect->prepare("INSERT INTO user (mail, password, id_profil, created_at) VALUES (:mail, :password, :profil, NOW())");
            
                $options = [
                    'cost' => 11         
                ];
                $password = password_hash($this->password, PASSWORD_BCRYPT, $options);        
                
                $req->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                $req->bindParam(":password", $password, PDO::PARAM_STR);
                $req->bindParam(":profil", $this->profil, PDO::PARAM_INT);
                $req->execute();
                $message = "Vous êtes bien inscrit !";
                return $message;
            }else{
                $message = "Le mail indiqué est déjà utilisé !";
                return $message;
            }
            
        }catch(PDOException $e){
            return "Votre inscription a échoué, en voici la raison : ".$e->getMessage();
        }

    }

    public function updateUser(){

        try{           
            
            $req = $this->connect->prepare("UPDATE user SET password = :password WHERE id = :id");
        
            $options = [
                'cost' => 11         
            ];
            $password = password_hash($this->password, PASSWORD_BCRYPT, $options);        
            
            $req->bindParam(":id", $this->id, PDO::PARAM_INT);
            $req->bindParam(":password", $password, PDO::PARAM_STR);
           
            if($req->execute()){
                 $passwordReset = new PasswordReset();
                $passwordReset->setUser($this->id);
                $message = $passwordReset->deleteToken();
            }else{
                $message = "une erreur s'est produite";
            }
            return $message;
            
            
        }catch(PDOException $e){
            return "L'enregistrement de votre nouveau mot de passe a échoué, en voici la raison : ".$e->getMessage();
        }

    }

    public function getUser($mail, $password){
          try {
            $req = $this->connect->prepare("SELECT id, password, mail, id_profil FROM user WHERE mail = :mail");
        
            $req->bindParam(":mail", $mail, PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return null;
            }else{
                if (password_verify($password, $obj->password)) {
                    $user = new User();
                    $user->setId($obj->id);                    
                    $user->setPassword($obj->password);
                    $user->setMail($obj->mail);
                    $profil = new Profil();                   
                    $user->setProfil($profil->getProfilById($obj->id_profil));
                    return $user;
                } else {
                    return false;
                }
            }
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }
    public function getUserById($id){
        try {
            $req = $this->connect->prepare("SELECT id, password, mail, id_profil FROM user WHERE id = :id");
        
            $req->bindParam(":id", $id, PDO::PARAM_INT);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return null;
            }else{                
                $user = new User();
                $user->setId($obj->id);                    
                $user->setPassword($obj->password);
                $user->setMail($obj->mail);
                $profil = new Profil();                   
                $user->setProfil($profil->getProfilById($obj->id_profil));
                return $user;
                
            }
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }
    public function verifUniqueMail($mail){
         try {
            $req = $this->connect->prepare("SELECT id, password, mail, id_profil FROM user WHERE mail = :mail");
        
            $req->bindParam(":mail", $mail, PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return true;
            }else{
               return false;
            }
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }

    public function getUserByMail($mail){
         try {
            $req = $this->connect->prepare("SELECT id, password, mail, id_profil FROM user WHERE mail = :mail");
        
            $req->bindParam(":mail", $mail, PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return false;
            }else{
                $user = new User();
                $user->setId($obj->id);                    
                $user->setPassword($obj->password);
                $user->setMail($obj->mail);
                $profil = new Profil();                   
                $user->setProfil($profil->getProfilById($obj->id_profil));
                return $user;
            }
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }

    public function getUserByProfil(){
        try {
            $req = $this->connect->prepare("SELECT id, mail, id_profil FROM user WHERE id_profil = :profil");
            $idProfil = $this->profil->getId();
            $req->bindParam(":profil", $idProfil, PDO::PARAM_STR);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $lstUser = array();
            while($obj = $req->fetch()){
                $user = new User();
                $user->setId($obj->id);         
                $user->setMail($obj->mail);
                $profil = new Profil();  
                $user->setProfil($profil->getProfilById($obj->id_profil));
                $lstUser[] = $user;
            }
            
            return $lstUser;
            
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of profil
     */ 
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */ 
    public function setProfil($profil)
    {
        $this->profil = $profil;

        return $this;
    }


}