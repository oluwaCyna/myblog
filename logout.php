<?php
session_start();
setcookie("user", "", time() - (86400 * 30), "/");

session_destroy();
header('Location: /');
