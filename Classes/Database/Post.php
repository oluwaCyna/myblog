<?php

namespace Database;
use voku\helper\Paginator;

class Post {
    private $id;
    private $conn;
    private $title;
    private $category;
    private $body;
    private $image;
    private $slug;
    private $sql;
    private $statement;
    public $pages;
    public $message = [];
    public $posts = [];
 
    public function __construct($conn, $title='', $category='', $body='', $image='') {
        $this->conn = $conn;
        $this->title = $title;
        $this->category = $category;
        $this->body = $body;
        $this->image = $image;
        $this->slug = str_replace(",", "", (str_replace(" ", "-", strtolower($this->title)))) . "-" . (rand(135237, 896636));
    }

    public function AddPost() {
        $this->sql = "INSERT INTO posts(title, category, body, image, slug) VALUES(?,?,?,?,?)";
        $this->statement = $this->conn->prepare($this->sql);
        $this->statement->bind_param('sssss', $this->title, $this->category, $this->body, $this->image, $this->slug);
        $this->statement->execute();
        $this->message['add_post'] = 'Post uploaded successfully';
    }

    public function UpdatePost($title, $category, $body, $image, $slug) {
        $this->sql = "UPDATE posts SET title='$title', category='$category', body='$body', image='$image' WHERE slug='$slug'";
        if ($this->conn->query($this->sql) === TRUE) {
            $this->message['add_post'] = 'Post uploaded successfully';
        }else {
            $this->message['add_post'] = 'Failed uploading post';
        }
    }

    public function ViewPost() {
        $this->sql = "SELECT * FROM posts";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->posts = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->posts = null;
        }
    }

    public function ViewPostPaginate() {
        $this->sql = "SELECT * FROM posts";
        $this->pages = new Paginator(5, 'p');
        $rowCount = $this->conn->query('SELECT * FROM posts')->fetch_all(MYSQLI_ASSOC);
        $this->pages->set_total(count($rowCount)); 

        $this->posts = $this->conn->query($this->sql . $this->pages->get_limit());
        // if ($result->num_rows > 0) {
        //     $this->posts = $result->fetch_all(MYSQLI_ASSOC);
        // }else {
        //     $this->posts = null;
        // }
    }


    public function DeletePost($slug) {
        $this->sql = "DELETE FROM posts WHERE slug='$slug'";
        if ($this->conn->query($this->sql) === TRUE) {
            $this->message['add_post'] = 'Post uploaded successfully';
        }else {
            $this->message['add_post'] = 'Failed uploading post';
        }
    }

    public function SinglePost($slug) {
        $this->sql = "SELECT * FROM posts WHERE (slug='$slug')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->posts = $result->fetch_assoc();
        }else {
            header('Location: index.php');  ;
        }
    }
}