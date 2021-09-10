<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı

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
                <a class="navbar-brand p-2 text-primary fs-3 fw-bold" href="#">Group4</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto fw-bolder">
                        <li class="nav-item">
                            <a class="nav-link text-primary"  href="#">All Posts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            require_once "post.class.php";
            $posts = new Post;
            $posts->getPostlist();
        ?>

        <div class="card text-center mt-5">
            <div class="card-header">
                Post id
            </div>
            <div class="card-body">
                <h5 class="card-title">Title</h5>
                <p class="card-text">Content</p>
                <a href="http://localhost/manage.php?post=$item[id]" class="btn btn-primary">Details...</a>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
        <div class="card text-center mt-5">
            <div class="card-header">
                Post id
            </div>
            <div class="card-body">
                <h5 class="card-title">Title</h5>
                <p class="card-text">Content</p>
            </div>
            <div class="card-footer">
                <ul class="nav nav-pills d-md-flex justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Delete</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>
