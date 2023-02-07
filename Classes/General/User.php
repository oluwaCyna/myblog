<?php

namespace General;

class User {

    public static function get_user($id) {
        $conn = mysqli_connect('localhost', 'root', '123456789', 'myblog');
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
        echo "<i>@" .$user['username'] . "</i>"; 
    }

    public static function get_email($id) {
        $user = self::get_user($id);
        echo $user['email']; 
    }
}