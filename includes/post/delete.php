<?php
session_start();
include '../autoload.php';

use Post\Add;
use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');
// Post submission
if (isset($_POST['post-delete-btn'])) {
    $delete_post = new Post($database);
    $delete_post->DeletePost($_POST['slug']);
    header('Location: ' . $_SERVER['HTTP_REFERER']); 

}

