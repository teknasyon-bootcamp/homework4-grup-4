<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı
require_once "post.class.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
</head>
<body>
   <!-- 
<h1>Select Post</h1>
    <form method="get">
        <label for="ID"></label>
        <input type="text" name="post", id="selectid">
        <button type="submit">Select Post</button>
    </form>
-->

    <h1>Post Lists</h1>
    <?php
    $posts = new Post; 

    if(isset($_POST["delButton"]))
    {
    $posts->deletePost($_POST["delID"]);
    }

    if(isset($_POST["addButton"]))
    {
    $posts->createPost($_POST["add-id"],$_POST["add-title"],$_POST["add-content"]);
    }
var_dump($_POST);
   // List all post
    if(!isset($_GET["post"])){  
        $posts->getPostlist();
    }
    else {
    $posts->getParticularPost($_GET["post"]); //Particular Post
    }
?>
    <h1>Create Post</h1>
    <form action="manage.php?create" method="post">
        <label for="id">ID</label>
        <input type="text" name="add-id" id="add-id">
        <label for="title">Name</label>
        <input type="text" name="add-title" id="title" />
        
        <label for="content">Content</label>
        <input type="text" name="add-content" id="content">

        <button name="addButton" type="submit">Add Post</button>
    </form>
    

    <h1>Delete Post</h1>
    <form method="post">
        <label for="id">ID</label>
        <input type="text" name="delID" id="delID" />
        <button name="delButton" type="submit">Delete User</button>
    </form>

    
    <form action="manage.php?create">
        <button type=></button>
    </form>
</body>
</html>




