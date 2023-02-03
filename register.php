<?php 
session_start();
// print_r($_SERVER);
// require_once "./includes/user/auth/register.php";

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
            <div class="card-header d-flex justify-content-between">
                Sign Up
            </div>

            <?php if (array_key_exists("failure", $_SESSION)) {?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong><?php echo($_SESSION['failure']) ?></strong>
                                </div>
              <?php unset($_SESSION["failure"]); } ?>

                            <script>
                                $(".alert").alert();
                            </script>


            <div class="card-body">
            <form action="./includes/user/auth/register.php" method="post" id="register-form" name="register-form" novalidate>
      <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['old']['username'] ?? null ?>">
    <div id="username-error" class="form-text text-danger"><?php echo $_SESSION['errors']['required']['username'] ?? null ?><?php echo $_SESSION['errors']['username'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['old']['email'] ?? null ?>">
    <div id="email-error" class="form-text text-danger"><?php echo $_SESSION['errors']['required']['email'] ?? null ?><?php echo $_SESSION['errors']['email'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <div id="password-error" class="form-text text-danger"><?php echo $_SESSION['errors']['required']['password'] ?? null ?><?php echo $_SESSION['errors']['password'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="confirm-password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirm-password" name="confirm-password">
    <div id="confirm-password-error" class="form-text text-danger"><?php echo $_SESSION['errors']['confirm_password'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label class="form-check-label">Already have an account? <a class="text-primary" href="login.php">Login</a></label>
  </div>
  <button type="submit" class="btn btn-primary" name="register">Submit</button>
</form>

            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>

    <!-- BS5 JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <div style="position:fixed; bottom:0; width:100%"><?php include_once "common/footer.php" ?></div>
</body>
</html>