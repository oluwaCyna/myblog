<?php 
require_once "./includes/user/auth/register.php";
require_once "./includes/user/auth/login.php";
?>

<!-- Modal -->
<div class="modal fade" id="register-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
      <form action="./includes/user/auth/register.php" method="post" id="register-form" name="register-form" novalidate>
      <div class="mb-3">
    <label for="register-username" class="form-label">Username</label>
    <input type="text" class="form-control" id="register-username" name="register-username">
    <div id="register-username-error" class="form-text text-danger"><?php echo $_SESSION['error']['required']['username'] ?? null ?> <?php $_SESSION['error']['username'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="register-email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="register-email" name="register-email">
    <div id="register-email-error" class="form-text text-danger"><?php echo $errors['required']['email'] ?? null ?><?php $errors['email'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="register-password" class="form-label">Password</label>
    <input type="password" class="form-control" id="register-password" name="register-password">
    <div id="register-password-error" class="form-text text-danger"><?php echo $errors['required']['password'] ?? null ?><?php echo $errors['password'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label for="register-confirm-password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="register-confirm-password" name="register-confirm-password">
    <div id="register-confirm-password-error" class="form-text text-danger"><?php echo $errors['confirm_password'] ?? null ?></div>
  </div>
  <div class="mb-3">
    <label class="form-check-label">Already have an account? <a class="text-primary" onclick="callLogin();">Login</a></label>
  </div>
  <button type="submit" class="btn btn-primary" name="register">Submit</button>
</form>

<form action="index.php" method="post" id="login-form" name="login-form" novalidate>
  <div class="mb-3">
    <label for="login-email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="login-email" name="login-email">
    <div id="login-email-error" class="form-text text-danger"></div>
  </div>
  <div class="mb-3">
    <label for="login-password" class="form-label">Password</label>
    <input type="password" class="form-control" id="login-password" name="login-password">
    <div id="login-password-error" class="form-text text-danger"></div>
  </div>
  <div class="mb-3">
    <label class="form-check-label">Don't have an account? <a class="text-primary" onclick="callRegister();">Register</a></label>
  </div>
  <button type="submit" class="btn btn-primary" name="login">Submit</button>
</form>
      </div>
        </div>
  </div>
</div>

<!-- <script src="./asset/js/auth.js"></script> -->
