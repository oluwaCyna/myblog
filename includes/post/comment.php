<?php
include '../includes/autoload.php';
require_once '../vendor/autoload.php';

use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway", "6144");

$comments = new Post($database);
$comments->ViewCommentsPaginate();

?>