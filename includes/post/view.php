<?php
include '../../includes/autoload.php';
require_once '../../vendor/autoload.php';

use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway");

$all_post = new Post($database);
$all_post->ViewPost();
?>