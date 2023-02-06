<?php
include 'autoload.php';
use Database\Connection;

// $database = new Connection('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway");

$database->connect();

if (!mysqli_connect_error()) {
    echo "Connected successfully";
}
