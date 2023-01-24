<?php

namespace Database;

class Connection {
    private $host_name;
    private $username;
    private $password;
    private $database;
    public $conn;

    public function __construct($host_name="localhost", $username="root", $password="", $database="myblog") {
        $this->host_name = $host_name;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect () {
        // $this->conn = new mysqli($this->host_name, $this->username, $this->password, $this->database);
        $this->conn = mysqli_connect($this->host_name, $this->username, $this->password, $this->database);

    }
}