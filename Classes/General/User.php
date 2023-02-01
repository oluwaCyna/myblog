<?php

namespace General;

class User {

    public static function get_user($id) {
        $conn = mysqli_connect('localhost', 'root', '', 'myblog');
        $sql = "SELECT * FROM users WHERE (id='$id')";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }else {
            return null;
        }
      }

    public static function get_username($id) {
        $user = self::get_user($id);
        echo $user['username']; 
    }

    public static function get_email($id) {
        $user = self::get_user($id);
        echo $user['email']; 
    }
}