<?php
session_start();
include '../autoload.php';

use Post\Add;
use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');
// Post submission
if (isset($_POST['post-submit-btn'])) {
    $new_post = new Add($_POST['title'], $_POST['category'], $_POST['body'], $_FILES['image']);
    $new_post->validate();

    if (count($new_post->errors) > 0) {
        $_SESSION["error"] = $new_post->errors;
        $_SESSION["old"]['title'] = $_POST['title'];
        $_SESSION["old"]['category'] = $_POST['category'];
        $_SESSION["old"]['body'] = $_POST['body'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);        
    }else {
        $new_post->character();
        unset($_SESSION["error"], $_SESSION["old"]);
        $upload = new Post($database, $new_post->validated['title'], $new_post->validated['category'], $new_post->validated['body'], $new_post->validated['image']);
        $upload->AddPost();

        $_SESSION["success"] = $upload->message['add_post'];
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);  
    }

}


// print_r($new_post->errors);
// if (empty($new_post->errors)) {
//     $new_post->character();
//     print_r($new_post->validated);
// }else {
//     print_r($new_post->errors);
// }
