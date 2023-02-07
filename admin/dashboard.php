<?php
require_once('../includes/post/dashboard.php');
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
    <a href="/" class="brand-link">
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
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">admin</a></li>
              <li class="breadcrumb-item"><a href="#">dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

      <div class="row">
      <div class="col-lg-3 col-6">

<div class="small-box bg-primary">
<div class="inner">
<h3><?php echo count($data->users) ?></h3>
<p>User Registrations</p>
</div>
<div class="icon">
<i class="fas fa-user-plus"></i>
</div>
<a href="./users.php" class="small-box-footer">
More info <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3><?php echo count($data->posts) ?></h3>
<p>Posts Uploaded</p>
</div>
<div class="icon">
<i class="fas fa-envelopes-bulk"></i>
</div>
<a href="./post/manage.php" class="small-box-footer">
More info <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3><?php echo count($data->comments) ?></h3>
<p>Comments</p>
</div>
<div class="icon">
<i class="fas fas fa-comments"></i>
</div>
<a href="./comments.php" class="small-box-footer">
More info <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3><?php echo count($data->post_likes) ?></h3>
<p>Likes</p>
</div>
<div class="icon">
<i class="fas fa-thumbs-up"></i>
</div>
<a href="#" class="small-box-footer">
More info <i class="fas fa-arrow-circle-right"></i>
</a>
</div>
</div>
        </div>

        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                Other stuff to be loaded here!
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
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
