<?php

namespace Database;

class Connection {
    private $host_name;
    private $username;
    private $password;
    private $database;
    public $conn;

    public function __construct($host_name="containers-us-west-183.railway.app", $username="root", $password="LeJXseePSOebenAcUBue", $database="railway") {
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