<?php

/*
 * This class establishes a connection with the database
 */

class DBconnect {

    // Specify the database credentials
    private $host = "localhost";
    private $username = "root";
    private $db_name = "api";
    private $password = "";
    public $conn;

    // Get the database connection
    public function connect()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "error: ".$e->getMessage();
        }
        return $this->conn;
    }
}
?>
