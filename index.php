<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı
require_once "post.class.php";
$posts = new Post; // Create post object
$post = $posts->getPostlist(); // Post object assigns a variable
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>    
    <?php
        if(isset($_GET["post"])): // Control $_GET global
            $particularPost = $posts->getParticularPost($_GET["post"]);
           
            $particularPost = $particularPost[0];
           // var_dump($_GET);
            ?>
            <a href="http://localhost/homework/homework4-grup-4/index.php"><button>Posts List</button></a> <!--Return to index.php-->
            <div>                                           
                <h4><?= $particularPost["title"] ?> </h4> 
                <p><?= $particularPost["content"] ?> </p> <!--Particular Post Details-->
            </div>
            <?php
            else: 
            ?>
<h2>Posts</h2>
<?php
foreach ($post as $value): ?>  <!--List All Posts-->
<div>
   <h3> <?= $value['id'] ?>
   <a href="<?="http://localhost/homework/homework4-grup-4/index.php?post=".$value['id']  ?>"> <?= $value['title'] ?> </a>
</h3> 
</div>
<?php endforeach; 
endif;
?>
</body>
</html>

