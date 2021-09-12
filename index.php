<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı

    require_once "post.class.php";

    $postsObj = new Post;
    $posts = $postsObj->getPostlist();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Posts | Group 4</title>
  </head>
  <body>
    <div class="container text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand p-2 text-primary fs-3 fw-bold" href="<?php echo $_SERVER['PHP_SELF']?>">Group4</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto fw-bolder">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?php echo $_SERVER['PHP_SELF']?>">All Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?php echo "http://localhost/homework4-grup-4/manage.php" ?>">Manage Posts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php

        if(isset($_GET['postId'])):
            $singlePost = $_GET['postId'];
            $postId = $postsObj->getSinglePost($singlePost);
            $postId = $postId[0];
    ?>
    
        <div class="card text-center mt-5">
            <div class="card-header">
                <?php echo $postId['post_id'] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"> <?php echo $postId['title'] ?></h5>
                <p class="card-text"> <?php echo $postId['content'] ?></p>    
            </div>
            <div class="card-footer text-muted">
                Published at <i><?php echo $postId['published_at'] ?></i>
            </div>
        </div>

    <?php
        else:
            $postId = "";
    ?>

    <?php foreach ($posts as $post): ?>
        
        <div class="card text-center mt-5">
            <div class="card-header">
                <?php echo $post['post_id'] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"> <?php echo $post['title'] ?></h5>
                <p class="card-text"> <?php echo $post['content'] ?></p>
                <a href="<?php echo $_SERVER['PHP_SELF'] . "?postId=" . $post['post_id'] ?>" class="btn btn-primary">Details</a>
            </div>
            <div class="card-footer text-muted">
                Published at <i><?php echo $post['published_at'] ?></i>
            </div>
        </div>

    <?php endforeach; ?>

    <?php endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>