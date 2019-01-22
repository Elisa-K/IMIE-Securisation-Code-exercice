<?php

class Profil {

    protected $id;
    protected $libelle;
    private $connect;



    public function __construct()
    {
        $db = BddConnect::getInstance();
        $this->connect = $db->getDbh();
    }

    public function getProfilById($id){
        try{
            $req = $this->connect->prepare("SELECT id, libelle FROM profil WHERE id = :id");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->bindParam(":id", $id, PDO::PARAM_INT);
            $req->execute();
            $profil = new Profil();
            while ($obj = $req->fetch()){
                $profil->setId($obj->id);
                $profil->setRole($obj->libelle);
            }
            return $profil;
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
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
}