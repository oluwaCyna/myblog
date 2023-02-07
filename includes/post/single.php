<?php
session_start();
include 'includes/autoload.php';
use Database\Post;

$database = new mysqli('localhost', 'root', '123456789', 'myblog');


$post = new Post($database);
$post->SinglePost($_GET['slug']);
$post->ViewComment($post->posts['id']);
if ($_SESSION != [] ){
    $post->LikeActivity($_SESSION['user']['id'], $post->posts['id']);
}
$post->ViewLike($post->posts['id']);


// comment submission
if (isset($_POST['comment'])) {
    if ($_POST['comment'] != ""){
        $comment = new Post($database);
        $comment->AddComment($_POST['comment'], $_POST['user_id'], $_POST['post_id']);   
        $_SESSION["success"] = $post->message['comment'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);    
    }else {
        $_SESSION["failure"] = "Can't be blank";
        header('Location: ' . $_SERVER['HTTP_REFERER']);        
    }
}

if (isset($_POST['like'])) {
        $like = new Post($database);
        $like->AddOrUpdateLike($_POST['like'], $_POST['user_id'], $_POST['post_id']);   
        header('Location: ' . $_SERVER['HTTP_REFERER']);    
}
