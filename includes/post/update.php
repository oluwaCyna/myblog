<?php
session_start();
include '../autoload.php';

use Post\Update;
use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway");

// Post update submission
if (isset($_POST['post-update-btn'])) {
    $update_post = new Update($_POST['title'], $_POST['category'], $_POST['paragraph1'], $_POST['paragraph2'], $_POST['paragraph3'], $_POST['paragraph4'], $_FILES['image'], $_FILES['image2']);
    $update_post->validate();

    if (count($update_post->errors) > 0) {
        $_SESSION["error"] = $update_post->errors;
        header('Location: ' . $_SERVER['HTTP_REFERER']);        
    }else {
        $update_post->character();
        unset($_SESSION["error"]);
      
echo $image;
        $upload = new Post($database);
        $upload->UpdatePost($update_post->validated['title'], $update_post->validated['category'], $update_post->validated['paragraph1'], $update_post->validated['paragraph2'], $update_post->validated['paragraph3'], $update_post->validated['paragraph4'], $update_post->validated['image'], $update_post->validated['image2'], $_SESSION["slug"]);
        unset($_SESSION["slug"]);
        $_SESSION["success"] = $upload->message['add_post'];
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);  
    }

}
