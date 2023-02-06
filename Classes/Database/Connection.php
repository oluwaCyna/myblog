<?php

namespace Database;

class Connection {
    private $host_name;
    private $username;
    private $password;
    private $database;
    private $port;
    public $conn;

    public function __construct($host_name="containers-us-west-183.railway.app", $username="root", $password="LeJXseePSOebenAcUBue", $database="railway", $port="6144") {
        $this->host_name = $host_name;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }

    public function connect () {
        // $this->conn = new mysqli($this->host_name, $this->username, $this->password, $this->database);
        $this->conn = mysqli_connect($this->host_name, $this->username, $this->password, $this->database, $this->port);

    }
}