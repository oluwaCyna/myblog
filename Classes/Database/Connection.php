<?php

namespace Database;

class Connection {
    private $host_name;
    private $username;
    private $password;
    private $database;
    public $conn;

    public function __construct($host_name="localhost", $username="root", $password="123456789", $database="myblog") {
        $this->host_name = $host_name;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect () {
        $this->conn = mysqli_connect($this->host_name, $this->username, $this->password, $this->database);

    }
}