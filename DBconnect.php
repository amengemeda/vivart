<?php

class DBConnect 
{
    protected $connection;
    public function __construct(){
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="vivart";
        try {
            //"mysql:host=$server;dbname=$dbname";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection=$conn;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          } 
    }
    public function getConnection(){
        return $this->connection;
    }
    public function closeConnection(){
         $this->connection=null;
    }

}

?>