
<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı

require_once "post.class.php";
$posts = new Post;
echo $posts->getPostlist();
?>
