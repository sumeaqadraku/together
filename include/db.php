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
            // Krijimi i lidhjes me bazën e të dhënave duke përdorur PDO
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->pass);

            // Aktivizo ndihmën për të kapur gabimet
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Mesazh gabimi nëse lidhja dështon
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Kjo metodë merr të dhënat për About Us
    public function fetchAboutUsContent($id) {
        $sql = "SELECT * FROM about_us WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function __destruct() {
        // Mbyll lidhjen kur objekti shkatërrohet
        $this->conn = null;
    }
}
?>
