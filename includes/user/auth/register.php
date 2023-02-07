<?php 
session_start();
include './../../autoload.php';

use Auth\Register;
use Database\Auth;
// $errors = [];
$database = new mysqli('localhost', 'root', '123456789', 'myblog');


if (isset($_POST['register'])) {
    $register = new Register($_POST['email'], $_POST['username'], $_POST['password']);
    $register->validate_require();
    $register->validate_match();

    if (count($register->errors) > 0) {
        $_SESSION["errors"] = $register->errors;
        $_SESSION["old"]['email'] = $_POST['email'];
        $_SESSION["old"]['username'] = $_POST['username'];
        $_SESSION["failure"] = "You have an error. Please try again";
        header('Location: ' . $_SERVER['HTTP_REFERER']); 
    }else {
        $register->character();
        if ($register->validated['password'] === $_POST['confirm-password']) {
            $new_entry = new Auth($database, $register->validated['email'], $register->validated['username'], $register->validated['password']);
            $new_entry->save();
            if ($new_entry->message['email_availability']) {
                unset($_SESSION['errors']);
                $_SESSION["old"]['email'] = $_POST['email'];
                $_SESSION["old"]['username'] = $_POST['username'];
                $_SESSION['failure'] = 'Email already exists';
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
            }else {
                unset($_SESSION['old']);
                $_SESSION["user"] = $new_entry->user;

                function random_strings($length_of_string) {
                    $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@$%';
                    return substr(str_shuffle($str), 0, $length_of_string);
                }
                $cookie_name = "user";
                $cookie_value =  random_strings(35);
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                header('Location: /blog'); 
            }
        }else {
            $_SESSION['errors']['confirm_password'] = 'Password does not match';
            header('Location: ' . $_SERVER['HTTP_REFERER']); 
        }
        
    }

}

