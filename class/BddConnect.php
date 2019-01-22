<?php


class BddConnect 
{

    private static $instance;
    private $type = "mysql";
    private $host = "localhost";
    private $dbname = "secu-code";
    private $username = "root";
    private $password = '';
    private $dbh;

    private function __construct()
    {
        try{
            $this->dbh = new PDO(
                $this->type.':host='.$this->host.';dbname='.$this->dbname, 
                $this->username, 
                $this->password,
                array(PDO::ATTR_PERSISTENT => true)
            );
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $this->dbh->exec("set names 'utf8';");
          
        }
        catch(PDOException $e){
            echo "<div class='error'>Erreur !: ".$e->getMessage()."</div>";
            die();
        }
    }
    public static function getInstance()
    {
        if (!self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function getDbh()
    {
        return $this->dbh;
    }
    public function __sleep()
    {
        return array();
    }
    
    public function __wakeup()
    {
        $this->getDbh();
    }
}