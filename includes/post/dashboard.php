<?php 
session_start();
include '../includes/autoload.php';

use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway", "6144");

$data = new Post($database);
$data->CountDatabase();
