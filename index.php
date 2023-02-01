<?php 
session_start();
include 'includes/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
use Database\Post;

$database = new mysqli('localhost', 'root', '', 'myblog');

$all_post = new Post($database);
$all_post->ViewPostPaginate();

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
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-center gap-2 float-left pt-2">
                    <div><i class="fa-solid fa-table-cells-large fa-2xl"></i></div>
                    <div><i class="fa-solid fa-bars fa-2xl"></i></div>
                </div>
                <form class="d-flex w-50 card-tools" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            <div class="card-body">
            <div class='d-flex card'>
            <?php $i = 1; foreach ($all_post->posts as $post) { 
                echo "
                    <div class='card-body d-flex gap-3 row'>
                    <div class='col'>
                    <img class='img-fluid pad' src='post-image/".$post['image']."' alt='Photo'>
                    </div>
                    <div class='col d-flex flex-column justify-content-between'>
                        <div class='d-flex flex-column'>
                        <h4>".$post['title']."</h4>
                        <p>".$post['body']."<a href='post-template.php?slug=".$post['slug']."'>continue</a></p>
                    </div>
                  <span class='' style='font-size: 12px;'>".$post['category']." - by Administrator - ".$post['date']." - 52 likes - 17 comments.</span>
                    </div>
                </div>
                ";}?>
                </div>
            </div>
            <div class="card-footer">
                <?php echo $all_post->pages->page_links(); ?>
            </div>
        </div>
    </div>

    <script>
       function viewPost (e) {
        let postNumber = e.dataset.postNumber;
        
       }

    </script>
    <!-- BS5 JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>