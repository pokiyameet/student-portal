<?php

class Database
{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "student_portal";

    public $conn;

    public function connect()
    {

        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($this->conn->connect_error) {
            throw new Exception("Database Connection Failed");
        }

        return $this->conn;
    }
}
