<?php
class database{
    private $servername="localhost";
    private $username="root";
    private $dbname="cmdCraft";
    private $password="";
    private $pdo;

    public function getConn(){
        try{
            $dsn="mysql:host=$this->servername;dbname=$this->dbname";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            echo 'good';
        }catch(PDOException $e){
            echo 'not good';
        }
        return $this->pdo;
    }
}
?>

