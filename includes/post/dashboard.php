<?php 
session_start();
include '../includes/autoload.php';

use Database\Post;

$database = new mysqli('localhost', 'root', '123456789', 'myblog');


$data = new Post($database);
$data->CountDatabase();
