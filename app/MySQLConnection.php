<?php 

abstract class ConnectToDatabase {
    protected $pdo;
    abstract protected function connection();
    protected function disconnect(){
        $this->pdo = null;
    }
}

class MySQLConnection extends ConnectToDatabase {
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host,$dbname,$username,$password){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        
    }

    protected function connection(){
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }
    
}