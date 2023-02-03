<?php 
session_start();
include '../includes/autoload.php';

use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');

$data = new Post($database);
$data->CountDatabase();
