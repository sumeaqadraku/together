<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "together";
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->pass);

            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
         
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        
        $this->conn = null;
    }
}
?>