<?php
session_start();
include '../autoload.php';

use Post\Add;
use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');
// Post update submission
if (isset($_POST['post-update-btn'])) {
    $update_post = new Add($_POST['title'], $_POST['category'], $_POST['body'], $_FILES['image']);
    $update_post->validate();

    if (count($update_post->errors) > 0) {
        $_SESSION["error"] = $update_post->errors;
        header('Location: ' . $_SERVER['HTTP_REFERER']);        
    }else {
        $update_post->character();
        unset($_SESSION["error"]);
        $upload = new Post($database);
        $upload->UpdatePost($update_post->validated['title'], $update_post->validated['category'], $update_post->validated['body'], $update_post->validated['image'],$_SESSION["slug"]);
        unset($_SESSION["slug"]);
        $_SESSION["success"] = $upload->message['add_post'];
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);  
    }

}


// print_r($update_post->errors);
// if (empty($update_post->errors)) {
//     $update_post->character();
//     print_r($update_post->validated);
// }else {
//     print_r($update_post->errors);
// }
