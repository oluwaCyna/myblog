<?php 
session_start();
include './../../autoload.php';

use Auth\Login;
use Database\Auth;
// $errors = [];
$database = new mysqli('localhost', 'root', '', 'myblog');

if (isset($_POST['login'])) {
    $login = new Login($_POST['email'], $_POST['password']);
    $login->validate_require();
    $login->validate_match();

    if (count($login->errors) > 0) {
        $_SESSION["errors"] = $login->errors;
        $_SESSION["old"]['email'] = $_POST['email'];
        $_SESSION["failure"] = "You have an error. Please try again";
        header('Location: ' . $_SERVER['HTTP_REFERER']); 
    }else {
        $login->character();
        $login_entry = new Auth($database, $login->validated['email'], '', $login->validated['password']);
        $login_entry->email_exists();
        if ($login_entry->message['failure']) {
            unset($_SESSION['errors']);
            $_SESSION["old"]['email'] = $_POST['email'];
            $_SESSION['failure'] = $login_entry->message['failure'];
            header('Location: ' . $_SERVER['HTTP_REFERER']); 
        }else {
            unset($_SESSION['old']);
            $_SESSION["user"] = $login_entry->user;
            header('Location: /blog'); 

            unset($_SESSION['errors']);
            $_SESSION["old"]['email'] = $_POST['email'];
            $_SESSION["old"]['username'] = $_POST['username'];
            $_SESSION['failure'] = 'Email already exists';
            header('Location: ' . $_SERVER['HTTP_REFERER']); 
        }

        if ($login_entry->message['success']) {
            unset($_SESSION['errors']);
            unset($_SESSION['old']);
            unset($_SESSION['failure']);
            header('Location: /blog'); 
        }
        // }else {
        //     $_SESSION['errors']['confirm_password'] = 'Password does not match';
        //     header('Location: ' . $_SERVER['HTTP_REFERER']); 
        // }
        
    }

}

