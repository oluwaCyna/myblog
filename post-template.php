<?php 
include 'includes/autoload.php';
use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');

$post = new Post($database);
$post->SinglePost($_GET['slug']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="common/navigation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">

    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/b41ff46bee.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Theme style -->
  <link rel="stylesheet" href="vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <title>MyBlogWebsite</title>

</head>
<body>
    <?php include_once "common/navigation.php" ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header ">
            <h4><?php echo $post->posts['title'] ?></h4>
            </div>

            <div class="card-body">
            <div class="user-block mb-3">
                  <img class="img-circle" src="vendor/AdminLTE-3.2.0/dist/img/user1-128x128.jpg" alt="User Image">
                  <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                  <span class="description"><?php echo $post->posts['category']." - date" ?></span>
                </div>
                <img class="img-fluid pad" src="post-image/<?php echo $post->posts['image'] ?>" width="100%" alt="Photo">

                <p><?php echo $post->posts['body'] ?></p>
                <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button> -->
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="<?php echo "post-image/".$post->posts['image'] ?>" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="vendor/AdminLTE-3.2.0/dist/img/user4-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <img class="img-fluid img-circle img-sm" src="vendor/AdminLTE-3.2.0/dist/img/user4-128x128.jpg" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
    </div>
    
    <!-- BS5 JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>