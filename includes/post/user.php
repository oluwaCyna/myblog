<?php
include '../includes/autoload.php';
require_once '../vendor/autoload.php';

use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');

$users = new Post($database);
$users->ViewUsersPaginate();
?>