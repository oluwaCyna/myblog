<?php
session_start();
require_once('../includes/post/comment.php');
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
  <link rel="stylesheet" href="../vendor/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- fontawesome -->
  <script src="https://kit.fontawesome.com/b41ff46bee.js" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/blog" class="brand-link">
      <img src="../vendor/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="./post/add.php" class="nav-link">
              <i class="fa-solid fa-plus nav-icon far"></i>
              <p>
                Add New Post
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./post/manage.php" class="nav-link">
              <i class="fa-solid fa-envelopes-bulk nav-icon far"></i>
              <p>
                Manage Posts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./comments.php" class="nav-link">
              <i class="fa-solid fa-comment nav-icon far"></i>
              <p>
                Comments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./users.php" class="nav-link">
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
              <li class="breadcrumb-item"><a href="#">comments</a></li>
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Posts</h3>
        </div>

        <?php if (array_key_exists("delete", $_SESSION)) {?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong><?php echo($_SESSION['delete']) ?></strong>
                        </div>
      <?php unset($_SESSION["delete"]); } ?>

                    <script>
                        $(".alert").alert();
                    </script>

        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th style="width: 45%">Comment</th>
                <th style="width: 15%">User</th>
                <th style="width: 35%">Post</th>
                <th style="width: 10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach ($comments->comments as $comment) { 
                $comments->SinglePostId($comment['post_id']);
                $comments->UserId($comment['user_id']);
                
              echo "<tr>
                <td>$i</td>
                <td><a>".$comment['comment']."</a></td>
                <td>".$comments->users['username']."</td>
                <td><a href='/blog/post-template.php?slug=".$comments->posts['slug']."'>".$comments->posts['title']."</a></td>
                <td>
                  <form action='../includes/post/delete.php' method='POST' class=''>
                    <input name='id' type='hidden' class='form-control' value='".$comment['id']."'>
                    <button name='comment-delete-btn' class='btn btn-danger' type='submit' '>DELETE</button>
                  </form>
                </td>
              </tr>"; $i++;} ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        <?php echo $comments->pages->page_links(); ?>
        </div>
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
<script src="../vendor/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../vendor/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../vendor/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../vendor/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
