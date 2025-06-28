<?php

class Database
{
    private $host = "localhost:4406";
    private $user = "root";
    private $pass = "";
    private $dbname = "db_app_jaringan";
    public $conn;

    public function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Database error: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}