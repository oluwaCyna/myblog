<?php 

namespace Database;

use Exception;

class Auth {
    private $id;
    private $conn;
    private $email;
    private $username;
    private $password;
    private $hash_password;
    private $sql;
    private $statement;
    public $pages;
    public $message = [];
    public static $user = [];
 
    public function __construct($conn, $email, $username, $password) {
        $this->conn = $conn;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function email_exists() {
        $this->sql = "SELECT * FROM users WHERE email = '$this->email'";
            $result = $this->conn->query($this->sql)->fetch_assoc();
            if ($result['password'] == md5($this->password)) {
                $this->message['success'] = "Matched details";
                $this->user = $result;
            }else {
                $this->message['failure'] = "Incorrect details";
            }
    }

    public function save() {
        $this->hash_password = md5($this->password);
        $this->sql = "INSERT INTO users(email, username, password) VALUES(?,?,?)";
        $this->statement = $this->conn->prepare($this->sql);
        $this->statement->bind_param('sss', $this->email, $this->username, $this->hash_password);
        try{
            $this->statement->execute();
        }catch(Exception $e){
            $this->message['email_availability'] = $e->getMessage();
        };
        $this->message['register'] = 'User added successfully';
        $this->id = $this->conn->insert_id;
        $this->get_user();
    }

    public function get_user() {
        $this->sql = "SELECT * FROM users WHERE (id='$this->id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->user = $result->fetch_assoc();
        }
    }

}