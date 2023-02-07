<?php session_start(); 
include '../../includes/autoload.php';

use Database\Post;

$database = new mysqli('localhost', 'root', '123456789', 'myblog');

$all_post = new Post($database);
$all_post->SinglePost($_GET['slug']);
$_SESSION['slug'] = $_GET['slug'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | MyBlogWebsite</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../vendor/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- fontawesome -->
  <script src="https://kit.fontawesome.com/b41ff46bee.js" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- BS5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/blog" class="brand-link">
      <img src="../../vendor/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MyBlogWebsite</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="./dashboard.php" class="nav-link">
              <i class="fa-solid fa-address-card nav-icon far"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../post/add.php" class="nav-link">
              <i class="fa-solid fa-plus nav-icon far"></i>
              <p>
                Add New Post
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../post/manage.php" class="nav-link">
              <i class="fa-solid fa-envelopes-bulk nav-icon far"></i>
              <p>
                Manage Posts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../comments.php" class="nav-link">
              <i class="fa-solid fa-comment nav-icon far"></i>
              <p>
                Comments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../users.php" class="nav-link">
              <i class="fa-solid fa-users nav-icon far"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADMIN DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">admin</a></li>
              <li class="breadcrumb-item"><a href="#">post</a></li>
              <li class="breadcrumb-item"><a href="#">update post</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update post</h3>
              </div>

              <?php if (array_key_exists("success", $_SESSION)) {?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong><?php echo($_SESSION['success']) ?></strong>
                                </div>
              <?php unset($_SESSION["success"]); } ?>

                            <script>
                                $(".alert").alert();
                            </script>

              <!-- /.card-header -->
              <!-- form start -->
              <form action="../../includes/post/update.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="mb-2">  
                <div class="form-group m-0">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo($all_post->posts['title']) ?? null ?>">
                  </div>
                  <span class="form-text text-danger" role="alert" ><?php echo($_SESSION['error']['required']['title']) ?? null ?></span>
                  </div>
                  <!-- select -->
                  <div class="mb-2">
                  <div class="form-group m-0">
                        <label>Category</label>
                        <select class="form-control" name="category">
                          <option value="<?php echo($all_post->posts['category']) ?? null ?>"><?php echo($all_post->posts['category']) ?? null ?></option>
                          <option value="general">General</option>
                          <option value="finance">Finance</option>
                          <option value="sports">Sport</option>
                          <option value="politics">Politics</option>
                          <option value="education">Education</option>
                          <option value="jokes">Jokes</option>
                        </select>
                    </div>
                    <span class="form-text text-danger" role="alert" ><?php echo($_SESSION['error']['required']['category']) ?? null ?></span>
                    </div>
                    <!-- textarea -->
                    <div class="mb-2">
                    <div class="form-group m-0">
                    <label>Paragraph one</label>
                    <textarea class="form-control" rows="10" name="paragraph1" placeholder="Write ..."><?php echo($all_post->posts['paragraph1']) ?? null ?></textarea>
                    </div>
                    <span class="form-text text-danger" role="alert" ><?php echo($_SESSION['error']['required']['paragraph1']) ?? null ?></span>
                    </div>

                    <div class="mb-2">
                    <div class="form-group m-0">
                    <label>Paragraph two</label>
                    <textarea class="form-control" rows="10" name="paragraph2" placeholder="Write ..."><?php echo($all_post->posts['paragraph2']) ?? null ?></textarea>
                    </div>
                    <span class="form-text text-danger" role="alert" ></span>
                    </div>

                    <div class="mb-2">
                    <div class="form-group m-0">
                    <label>Paragraph three</label>
                    <textarea class="form-control" rows="10" name="paragraph3" placeholder="Write ..."><?php echo($all_post->posts['paragraph3']) ?? null ?></textarea>
                    </div>
                    <span class="form-text text-danger" role="alert" ></span>
                    </div>

                    <div class="mb-2">
                    <div class="form-group m-0">
                    <label>Paragraph four</label>
                    <textarea class="form-control" rows="10" name="paragraph4" placeholder="Write ..."><?php echo($all_post->posts['paragraph4']) ?? null ?></textarea>
                    </div>
                    <span class="form-text text-danger" role="alert" ></span>
                    </div>

                    <div class="mb-2">
                    <div class="form-group m-0">
                      <label for="image">Post featured image</label>
                      <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <span class="form-text text-danger" role="alert" ></span>
                    </div>

                    <div class="mb-2">
                    <div class="form-group m-0">
                      <label for="image">Extra image</label>
                      <input type="file" class="form-control" name="image2" id="image">
                    </div>
                    <span class="form-text text-danger" role="alert" ></span>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="post-update-btn" class="btn btn-primary">UPDATE</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2023. Developed by <a href="https://wa.me/08133499101">Shina A.</a>.</strong> All rights reserved. <strong>Template from <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../vendor/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../vendor/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../vendor/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
