<?php
session_start();
include '../autoload.php';

use Post\Add;
use Database\Post;

$database = new mysqli('localhost', 'root', '123456789', 'myblog');


// Post submission
if (isset($_POST['post-submit-btn'])) {
    $new_post = new Add($_POST['title'], $_POST['category'], $_POST['paragraph1'], $_POST['paragraph2'], $_POST['paragraph3'], $_POST['paragraph4'], $_FILES['image'], $_FILES['image2']);
    $new_post->validate();

    if (count($new_post->errors) > 0) {
        $_SESSION["error"] = $new_post->errors;
        $_SESSION["old"]['title'] = $_POST['title'];
        $_SESSION["old"]['category'] = $_POST['category'];
        $_SESSION["old"]['paragraph1'] = $_POST['paragraph1'];
        $_SESSION["old"]['paragraph2'] = $_POST['paragraph2'];
        $_SESSION["old"]['paragraph3'] = $_POST['paragraph3'];
        $_SESSION["old"]['paragraph4'] = $_POST['paragraph4'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);        
    }else {
        $new_post->character();
        unset($_SESSION["error"], $_SESSION["old"]);
        $upload = new Post($database, $new_post->validated['title'], $new_post->validated['category'], $new_post->validated['paragraph1'], $new_post->validated['paragraph2'], $new_post->validated['paragraph3'], $new_post->validated['paragraph4'], $new_post->validated['image'], $new_post->validated['image2']);
        $upload->AddPost();

        $_SESSION["success"] = $upload->message['add_post'];
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);  
    }

}
