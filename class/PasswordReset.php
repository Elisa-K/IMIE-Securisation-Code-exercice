<?php

class PasswordReset{

    private $connect;
    protected $id;
    protected $token;
    protected $user;
    protected $dateRequest;
    protected $dateExp;

    public function __construct()
    {
        $db = BddConnect::getInstance();
        $this->connect = $db->getDbh();
    }

    public function addToken($userId){

        try{
            $req = $this->connect->prepare("INSERT INTO password_reset_request
                    (user_id, date_requested, token, date_exp)
                    VALUES
                    (:userId, :dateRequested, :token, :dateExp)");
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);

            $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
            );

            $expDate = date("Y-m-d H:i:s",$expFormat);
            $curDate = date("Y-m-d H:i:s");
            
            $req->bindParam(":userId", $userId, PDO::PARAM_INT);
            $req->bindParam(":dateRequested", $curDate, PDO::PARAM_STR);
            $req->bindParam(":token", $token, PDO::PARAM_STR);
            $req->bindParam(":dateExp", $expDate, PDO::PARAM_STR);
        
            $req->execute();

            return $this->connect->lastInsertId();

        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }

    }
    public function getTokenById($id){
        try {
            $req = $this->connect->prepare("SELECT id, token, user_id, date_requested, date_exp FROM password_reset_request WHERE id = :id");
        
            $req->bindParam(":id", $id, PDO::PARAM_INT);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return null;
            }else{
               
                $passwordReset = new PasswordReset();
                $passwordReset->setId($obj->id);                    
                $passwordReset->setUser($obj->user_id);
                $passwordReset->setDateRequest($obj->date_requested);
                $passwordReset->setDateExp($obj->date_exp);
                $passwordReset->setToken($obj->token);
                
                return $passwordReset;
                
            }
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }
    public function deleteToken(){
        try{
            $req = $this->connect->prepare("DELETE FROM password_reset_request WHERE user_id = :id");
            $req->bindParam(":id", $this->user, PDO::PARAM_INT);
           
            $req->execute();

            return $message = "Votre nouveau mot de passe est bien enregistré !";
        }catch(PDOException $e){
            return "Votre requête a échoué, en voici la raison : ".$e->getMessage();
        }
    }
    public function getReset($id, $token, $userId){
        try {
            $req = $this->connect->prepare("SELECT id, token, user_id, date_requested, date_exp FROM password_reset_request WHERE id = :id AND token = :token AND user_id = :userId");
        
            $req->bindParam(":id", $id, PDO::PARAM_INT);
            $req->bindParam(":token", $token, PDO::PARAM_STR);
            $req->bindParam(":userId", $userId, PDO::PARAM_INT);
            $req->execute();
            $req->setFetchMode(PDO::FETCH_OBJ);
            $obj = $req->fetch();
            if(empty($obj)){
                return false;
            }else{
                $passwordReset = new PasswordReset();
                $passwordReset->setDateRequest($obj->date_requested);
                $passwordReset->setDateExp($obj->date_exp);
                return $passwordReset;
            }
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
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of dateRequest
     */ 
    public function getDateRequest()
    {
        return $this->dateRequest;
    }

    /**
     * Set the value of dateRequest
     *
     * @return  self
     */ 
    public function setDateRequest($dateRequest)
    {
        $this->dateRequest = $dateRequest;

        return $this;
    }

    /**
     * Get the value of dateExp
     */ 
    public function getDateExp()
    {
        return $this->dateExp;
    }

    /**
     * Set the value of dateExp
     *
     * @return  self
     */ 
    public function setDateExp($dateExp)
    {
        $this->dateExp = $dateExp;

        return $this;
    }
}