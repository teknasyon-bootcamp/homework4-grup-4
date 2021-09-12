<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı
    require_once "post.class.php"; // Require post.class file

    $postsData = new Post; // Create new Post object
    $posts = $postsData->getPostlist(); // Get all posts
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Manage | Group 4</title>
  </head>
  <body>
      <div class="container text-center">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand p-2 text-primary fs-3 fw-bold" href="<?php echo "index.php" ?>">Group4</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto fw-bolder">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?php echo $_SERVER['PHP_SELF']?>">All Posts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php    
        if(isset($_GET['action'])) { // If there is some action on post(s)
            switch($_GET['action']) {
                case 'create': // if action is create               
                    echo '<h5 class="bg-primary text-light p-3 ">Create Post</h5>' ?>
                    <hr>
                    <form id="newPostForm" class="d-grid gap-2 col-6 mx-auto my-5" action="manage.php?action=store" method="post">
                        <div class="mb-3">
                            <input class="form-control" id="title" type="text" placeholder="Title" name="title"/>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="content" type="text" placeholder="Content" name="content" style="height: 10rem;"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit" name="new" >Store</button>
                        </div>
                    </form>

                <?php 
                break; 
                
                case 'store': // if action is store 
                    $title = $_POST['title']; // Get title
                    $content = $_POST['content']; // Get content
                    $postsData->createPost($title, $content); // Create new post at DB

                    header('Location: manage.php'); // Redirect to manage.php page 
                break;

                case 'edit': // If action is edit
                    $singlePost = (int) $_GET['postId']; // Get current post ID
                    $post = $postsData->getSinglePost($singlePost); // Get current post from DB
                    $post = $post[0]; // Current post
                    
                    // Show post header and edit post form
                    echo '<h5 class="bg-primary text-light p-3 ">Update Post</h5>'; ?>

                    <hr>
                    <form id="updatePostForm" class="d-grid gap-2 col-6 mx-auto my-5" action="manage.php?action=update&postId=<?php echo $singlePost ?>" method="post">
                        <div class="mb-3">
                            <input class="form-control" id="post_id" type="text" placeholder="Post ID" readonly name="postId" value="<?php echo $post['post_id'] ?>"/>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" id="title" type="text" placeholder="Title" name="title" value="<?php echo $post['title'] ?>"/>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="content" type="text" placeholder="Content" name="content" style="height: 10rem;"><?php echo $post['content'] ?></textarea>
                        </div>
                            <div class="d-grid">
                            <button class="btn btn-primary text-light btn-lg" type="submit" name="update" >Save</button>
                        </div>
                    </form>

                <?php 
                break; 
                
                case 'delete': // If action is delete
                    $postId = (int) $_GET['postId']; // Get current post ID
                    $postsData->deletePost($postId); // Delete post from DB

                    header('Location: manage.php'); // Redirect to manage.php page 
                break;

                case 'update': // If action is update
                    $postId = (int) $_POST['postId']; // Get current post ID
                    $title = $_POST['title']; // Get post title
                    $content = $_POST['content']; // Get post content
                    $postsData->updatePost($title, $content, $postId); // Update post at DB
                break;

                default: //f action method not match with existings
                    return header('Location: manage.php'); // Redirect to manage.php page
                break;
            }
        // If there no action on post(s), show all posts 
        } else { ?> 

            <div class="d-grid gap-2 col-6 mx-auto my-5">
                <a class="btn btn-primary" type="button" href="manage.php?action=create">Add New Post</a>
            </div>

            <?php foreach ($posts as $post): ?> 

            <div class="card text-center mt-5">
                <div class="card-header">
                    <?php echo $post['post_id'] ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $post['title'] ?></h5>
                    <p class="card-text"> <?php echo $post['content'] ?></p>
                </div>
                <div class="card-footer text-muted">
                    <div>
                        <p>Published at <i><?php echo $post['published_at'] ?></i></p>
                    </div> 
                    
                    <div>
                        <ul class="nav nav-pills d-md-flex justify-content-center">
                            <li class="nav-item"> 
                                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . "?action=edit&postId=" . $post['post_id'] ?>">Edit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . "?action=delete&postId=" . $post['post_id'] ?>">Delete</a>
                            </li>
                        </ul> 
                    </div>
                </div>
            </div>

        <?php endforeach; 
        } ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>
