<?php 
session_start();

include __DIR__.'includes/autoload.php';
require_once 'vendor/autoload.php';
use Database\Post;

// $database = new mysqli('localhost', 'root', '', 'myblog');
$database = new mysqli("containers-us-west-183.railway.app", "root", "LeJXseePSOebenAcUBue", "railway", "6144");

$all_post = new Post($database);
$all_post->ViewPostPaginate();

// Extract Excerpt from the description
function the_excerpt ($string){
    $excerpt = explode("~", chunk_split($string, 420, "~")); 
    return $excerpt[0];
}

function excerpt ($string){
    if (strlen($string) > 85) {
        $excerpt = explode("~", chunk_split($string,85 , "~")); 
        return $excerpt[0]." ... ";
    }else {
        return $string;
    }
}