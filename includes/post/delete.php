<?php
session_start();
include '../autoload.php';

use Post\Add;
use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway", "6144");


// Post deletion
if (isset($_POST['post-delete-btn'])) {
    $delete_post = new Post($database);
    $delete_post->DeletePost($_POST['slug']);
    $_SESSION['delete'] = 'Post deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}

// User deletion
if (isset($_POST['user-delete-btn'])) {
    $delete_user = new Post($database);
    $delete_user->DeleteUser($_POST['id']);
    $_SESSION['delete'] = 'User deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}

// Comment deletion
if (isset($_POST['comment-delete-btn'])) {
    $delete_comment = new Post($database);
    $delete_comment->DeleteComment($_POST['id']);
    $_SESSION['delete'] = 'Comment deleted';
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}