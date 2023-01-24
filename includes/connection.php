<?php
include 'autoload.php';
use Database\Connection;

$database = new Connection('localhost', 'root', '', 'myblog');
$database->connect();

if (!mysqli_connect_error()) {
    echo "Connected successfully";
}
