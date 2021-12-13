<?php
// used to get mysql database connection
class Database{

    // specify your own database credentials
    private $host = "51.178.152.213";
    private $db_name = "agomez_agenda_db";
    private $username = "agomez_usr";
    private $password = "abc123.";
    public $conn;


    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>