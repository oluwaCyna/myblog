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
    public $comments = [];
    public $replies = [];
    public $like;
    public $post_likes = [];

 
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
        $this->pages = new Paginator(10, 'p');
        $rowCount = $this->conn->query('SELECT * FROM posts')->fetch_all(MYSQLI_ASSOC);
        $this->pages->set_total(count($rowCount)); 
        $result = $this->conn->query($this->sql . $this->pages->get_limit());
        if ($result->num_rows > 0) {
            $this->posts = $this->conn->query($this->sql . $this->pages->get_limit());
        }else {
            $this->posts = [];
        }
    }

    public function ViewPostPaginate() {
        $this->sql = "SELECT * FROM posts";
        $this->pages = new Paginator(7, 'p');
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

    public function AddComment($comment, $user_id, $post_id) {
        $new_comment = htmlspecialchars($comment);
        $this->sql = "INSERT INTO comments(comment, user_id, post_id) VALUES(?,?,?)";
        $this->statement = $this->conn->prepare($this->sql);
        $this->statement->bind_param('sss', $new_comment, $user_id, $post_id);
        $this->statement->execute();
        $this->message['comment'] = 'comment added successfully';
    }

    public function ViewComment($post_id) {
        $this->sql = "SELECT * FROM comments WHERE (post_id='$post_id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->comments = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->comments = [];
        }
    }

    public function AddReply($reply, $user_id, $comment_id) {
        $new_reply = htmlspecialchars($reply);
        $this->sql = "INSERT INTO replies(reply, user_id, post_id) VALUES(?,?,?)";
        $this->statement = $this->conn->prepare($this->sql);
        $this->statement->bind_param('sss', $new_reply, $user_id, $comment_id);
        $this->statement->execute();
        $this->message['reply'] = 'comment added successfully';
    }

    public function ViewReply($comment_id) {
        $this->sql = "SELECT * FROM replies WHERE (comment_id='$comment_id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->replies = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->replies = [];
        }
    }

    public function LikeActivity($user_id, $post_id) {
        $this->sql = "SELECT * FROM post_likes WHERE (user_id='$user_id' AND post_id='$post_id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $this->like = $result['likes'];
        }else {
            $this->like = 0;
        }
    }

    public function AddOrUpdateLike($like, $user_id, $post_id) {
        $this->sql = "SELECT * FROM post_likes WHERE (user_id='$user_id' AND post_id='$post_id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->sql = "UPDATE post_likes SET likes='$like' WHERE (user_id='$user_id' AND post_id='$post_id')";  
            $this->conn->query($this->sql);
        }else {
            $this->sql = "INSERT INTO post_likes(likes, user_id, post_id) VALUES(?,?,?)";
            $this->statement = $this->conn->prepare($this->sql);
            $this->statement->bind_param('sss', $like, $user_id, $post_id);
            $this->statement->execute();
        }
        
    }

    public function ViewLike($post_id) {
        $this->sql = "SELECT * FROM post_likes WHERE (post_id='$post_id' AND likes='1')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->post_likes = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->post_likes = [];
        }
    }
}