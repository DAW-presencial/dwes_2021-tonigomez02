<?php
// used to get mysql database connection
class Database{

    // specify your own database credentials
    private $host = "localhost:3309";
    private $db_name = "agenda";
    private $username = "root";
    private $password = "tonigomez";
    public $conn;


    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>