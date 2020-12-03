<?php

class Database {

    // specify your own database credentials

    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    // get the database connection
    public function getConnection() {

        $this->conn = null;

        $server = $_SERVER['HTTP_HOST'];

        $hostName = 'localhost';
        $dbName = 'sorvete';
        $userName = 'root';
        $pass = '';

        $this->host = $hostName;
        $this->db_name = $dbName;
        $this->username = $userName;
        $this->password = $pass;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
