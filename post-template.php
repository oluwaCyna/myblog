<?php
require_once('./includes/post/single.php');
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
          <span class="username"><a href="#">Mr. John Doe - Administrator</a></span>
          <span class="description"><?php echo $post->posts['category'] . " - " . $post->posts['date'] ?></span>
        </div>
        <img class="img-fluid pad" src="post-image/<?php echo $post->posts['image'] ?>" width="100%" alt="Photo">

        <p class="pt-2"><?php echo $post->posts['paragraph1'] ?></p>
        <?php echo empty($post->posts['paragraph2']) ? "" : "<p class='pt-2'>".$post->posts['paragraph2']."</p>" ?>

        <?php echo empty($post->posts['image2']) ? "" : "<img class='img-fluid pad' src='post-image/".$post->posts['image2']."' width='100%' alt='Photo'>" ?>

        <?php echo empty($post->posts['paragraph3']) ? "" : "<p class='pt-2'>".$post->posts['paragraph3']."</p>" ?>
        <?php echo empty($post->posts['paragraph4']) ? "" : "<p class='pt-2'>".$post->posts['paragraph4']."</p>" ?>

        <p class="notice float-left">Please <a class="text-primary" href="login.php">Login</a> or <a class="text-primary" href="register.php">Sign up</a> to <b>LIKE</b> or add <b>COMMENT</b> to this post.</p>

        <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button> -->
        <button type="button" class="like btn btn-default btn-sm <?php echo $post->like == 1 ? 'bg-blue' : '' ?>"><i class="far fa-thumbs-up"></i> Like</button>
        <span class="float-right text-muted"><?php echo (count($post->post_likes)) ?> likes - <?php echo (count($post->comments)) ?> comments</span>
      </div>
      <!-- /.card-body -->
      <div class="card-footer card-comments">
        <?php $i = 1;
        foreach ($post->comments as $comment) {
          echo "                
                <div class='card-comment'>
                  <img class='img-circle img-sm' src='post-image/" . $post->posts['image'] . "' alt='User Image'>

                  <div class='comment-text'>
                    <span class='username'>
                      " . General\User::get_username($comment['user_id']) . "
                      <span class='text-muted float-right'>" . $comment['date'] . "</span>
                    </span>
                    " . $comment['comment'] . "
                  </div>
                </div>
                ";
        } ?>
      </div>
      <!-- /.card-footer -->
      <div class="card-footer">

        <?php if (array_key_exists("success", $_SESSION)) { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo ($_SESSION['success']) ?></strong>
          </div>
        <?php unset($_SESSION["success"]);
        } ?>

        <?php if (array_key_exists("failure", $_SESSION)) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo ($_SESSION['failure']) ?></strong>
          </div>
        <?php unset($_SESSION["failure"]);
        } ?>

        <script>
          $(".alert").alert();
        </script>

        <form action="<?php $_SERVER['HTTP_HOST'] ?>" method="post">
          <!-- <img class="img-fluid img-circle img-sm" src="vendor/AdminLTE-3.2.0/dist/img/user4-128x128.jpg" alt="Alt Text"> -->
          <!-- .img-push is used to add margin to elements next to floating images -->
          <div class="img-push">
            <input name="user_id" type="hidden" value="<?php echo $_SESSION['user']['id'] ?>" />
            <input name="post_id" type="hidden" value="<?php echo $post->posts['id'] ?>" />
            <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
          </div>
        </form>
      </div>
      <!-- /.card-footer -->
    </div>
    <form id="like-form" action="<?php $_SERVER['HTTP_HOST'] ?>" method="post">
      <input name="user_id" type="hidden" value="<?php echo $_SESSION['user']['id'] ?>" />
      <input name="post_id" type="hidden" value="<?php echo $post->posts['id'] ?>" />
      <input name="like" type="hidden" value="<?php echo $post->like == 1 ? 0 : 1 ?>" />
  </div>
  </form>

  <script>
    $(document).ready(function() {
      $(".like").click(function() {
        $("#like-form").submit();
      })

      function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }

      if (getCookie("user") != "") {
        $(".notice").hide();
      } else {
        $(".like").hide();
        $(".card-footer").hide();
        $("#like-form").hide();
      }

    });
  </script>

  <!-- BS5 JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  <?php include_once "common/footer.php" ?>
</body>

</html>