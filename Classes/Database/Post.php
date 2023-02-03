<?php

namespace Database;
use voku\helper\Paginator;

class Post {
    private $id;
    private $conn;
    private $title;
    private $category;
    private $paragraph1;
    private $paragraph2;
    private $paragraph3;
    private $paragraph4;
    private $image;
    private $image2;
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
    public $users;
 
    public function __construct($conn, $title='', $category='', $paragraph1='', $paragraph2='', $paragraph3='', $paragraph4='', $image='', $image2='') {
        $this->conn = $conn;
        $this->title = $title;
        $this->category = $category;
        $this->paragraph1 = $paragraph1;
        $this->paragraph2 = $paragraph2;
        $this->paragraph3 = $paragraph3;
        $this->paragraph4 = $paragraph4;
        $this->image = $image;
        $this->image2 = $image2;
        $this->slug = str_replace(",", "", (str_replace(" ", "-", strtolower($this->title)))) . "-" . (rand(135237, 896636));
    }

    public function AddPost() {
        $this->sql = "INSERT INTO posts(title, category, paragraph1, paragraph2, paragraph3, paragraph4, image, image2, slug) VALUES(?,?,?,?,?,?,?,?,?)";
        $this->statement = $this->conn->prepare($this->sql);
        $this->statement->bind_param('sssssssss', $this->title, $this->category, $this->paragraph1, $this->paragraph2, $this->paragraph3, $this->paragraph4, $this->image, $this->image2, $this->slug);
        $this->statement->execute();
        $this->message['add_post'] = 'Post uploaded successfully';
    }

    public function UpdatePost($title, $category, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $image, $image2, $slug) {
        if (!empty($image) && !empty($image2)){
        $this->sql = "UPDATE posts SET title='$title', category='$category', paragraph1='$paragraph1',paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', image='$image', image='$image2' WHERE slug='$slug'";
        }elseif (!empty($image) && empty($image2)) {
        $this->sql = "UPDATE posts SET title='$title', category='$category', paragraph1='$paragraph1',paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', image='$image' WHERE slug='$slug'";
        }elseif (empty($image) && !empty($image2)) {
            $this->sql = "UPDATE posts SET title='$title', category='$category', paragraph1='$paragraph1',paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', image2='$image2' WHERE slug='$slug'";
        }else {
            $this->sql = "UPDATE posts SET title='$title', category='$category', paragraph1='$paragraph1',paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4' WHERE slug='$slug'";
        }

        if ($this->conn->query($this->sql) === TRUE) {
            $this->message['add_post'] = 'Post updated successfully';
        }else {
            $this->message['add_post'] = 'Failed to update post';
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

    public function ViewCategoryPostPaginate($category) {
        $this->sql = "SELECT * FROM posts WHERE category='$category'";
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

    public function ViewUsersPaginate() {
        $this->sql = "SELECT * FROM users";
        $this->pages = new Paginator(10, 'p');
        $rowCount = $this->conn->query('SELECT * FROM posts')->fetch_all(MYSQLI_ASSOC);
        $this->pages->set_total(count($rowCount)); 

        $this->users = $this->conn->query($this->sql . $this->pages->get_limit());
        // if ($result->num_rows > 0) {
        //     $this->posts = $result->fetch_all(MYSQLI_ASSOC);
        // }else {
        //     $this->posts = null;
        // }
    }

    public function UserId($id) {
        $this->sql = "SELECT * FROM users WHERE (id='$id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->users = $result->fetch_assoc();
        }else {
            $this->users = [];
        }
    }

    public function ViewCommentsPaginate() {
        $this->sql = "SELECT * FROM comments";
        $this->pages = new Paginator(10, 'p');
        $rowCount = $this->conn->query('SELECT * FROM posts')->fetch_all(MYSQLI_ASSOC);
        $this->pages->set_total(count($rowCount)); 

        $this->comments = $this->conn->query($this->sql . $this->pages->get_limit());
        // if ($result->num_rows > 0) {
        //     $this->posts = $result->fetch_all(MYSQLI_ASSOC);
        // }else {
        //     $this->posts = null;
        // }
    }

    public function DeletePost($slug) {
        $this->sql = "DELETE FROM posts WHERE slug='$slug'";
        $this->conn->query($this->sql);
    }

    public function DeleteUser($id) {
        $this->sql = "DELETE FROM users WHERE id='$id'";
        $this->conn->query($this->sql);
    }


    public function DeleteComment($id) {
        $this->sql = "DELETE FROM comments WHERE id='$id'";
        $this->conn->query($this->sql);
    }

    public function SinglePost($slug) {
        $this->sql = "SELECT * FROM posts WHERE (slug='$slug')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->posts = $result->fetch_assoc();
        }else {
            $this->posts = [];
        }
    }

    public function SinglePostId($id) {
        $this->sql = "SELECT * FROM posts WHERE (id='$id')";
        $result = $this->conn->query($this->sql);
        if ($result->num_rows > 0) {
            $this->posts = $result->fetch_assoc();
        }else {
            $this->posts = [];
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

    public function CountDatabase() {
        $user_sql = "SELECT * FROM users";
        $post_sql = "SELECT * FROM posts";
        $comment_sql = "SELECT * FROM comments";
        $like_sql = "SELECT * FROM post_likes WHERE (likes='1')";

        $user_result = $this->conn->query($user_sql);
        if ($user_result->num_rows > 0) {
            $this->users = $user_result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->users = [];
        }

        $post_result = $this->conn->query($post_sql);
        if ($post_result->num_rows > 0) {
            $this->posts = $post_result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->posts = [];
        }

        $comment_result = $this->conn->query($comment_sql);
        if ($comment_result->num_rows > 0) {
            $this->comments = $comment_result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->comments = [];
        }

        $like_result = $this->conn->query($like_sql);
        if ($like_result->num_rows > 0) {
            $this->post_likes = $like_result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->post_likes = [];
        }
    }
}