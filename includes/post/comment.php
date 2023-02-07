<?php
include '../includes/autoload.php';
require_once '../vendor/autoload.php';

use Database\Post;

$database = new mysqli('localhost', 'root', '123456789', 'myblog');


$comments = new Post($database);
$comments->ViewCommentsPaginate();

?>