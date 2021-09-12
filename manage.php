<?php
//Veritabanında yer alan post listesi gösterilmelidir. Eğer ?post=X şeklinde bir query parametresi verildiyse ($_GET) sadece ilgili post gösterilmelidir.
//db bağlantısı onaylandı
require_once "post.class.php";
$posts = new Post; // Create post object
$post=$posts->getPostlist(); // Post object assigns a variable


echo "<a href='?action=create'><button type='button'>Add New Post</button></button></a>";  // Add post button
if (isset($_GET["action"])){  // Form action controls
  switch($_GET["action"]){
  case "edit": // Edit Section
    $postid=(int) $_GET["post"];
    $id=$post[$postid]["id"];
    $title=$post[$postid]["title"];
    $content=$post[$postid]["content"]; 
    echo "<a href='manage.php'><button type='button'>Post List</button></button></a>"; 
    echo "<form action='manage.php?action=update' method='POST'>
    <div>
    <div>
      <label>Title</label>
      <input type='text'  name='title' value='$title' required>
    </div>
    <div>
      <label>Content</label>
      <textarea name='content' rows='10' required>$content</textarea>
    </div>
    <input type='hidden' name='id' value='$id'>
    <div>
    <button type='submit'>Update Post</button></div>
    </div>
    </form>";
    break;

    case "create": //Create Post Section
    echo "<a href='manage.php'><button type='button'>Post List</button></button></a>";
    echo "<form action= 'manage.php?action=store' method='POST'>
    <div>
    <div >
      <label>ID</label><br>
      <input type='text' name='id' required>
      <label>Title</label>
      <input type='text' name='title' required>
    </div>
    <div>
      <label >Content</label>
      <textarea  name='content' rows='10' required></textarea>
    </div>
    <div><button type='submit' >Creat New Post</button></div>
    </div>
    </form>";
    break;
    
    
    break;
    case "delete"; //Delete section
        $postid=(int) $_GET["post"];  // Delete post according to post id action=delete  
        $posts->deletePost($postid);
        return header('Location: manage.php');
    break;   
    case "store"; 
        $posts->createPost($_POST["id"],$_POST["title"],$_POST["content"]); // Store post according to action=create 
        return header('Location: manage.php');
    
    case "update";
        $postid=(int) $_POST["id"];
        $posts->updatePost($postid,$_POST["title"],$_POST["content"]);     // Edit post according to value of edit section 
        return header('Location: manage.php');
        break;
        default:
            return header('Location: manage.php');  // If there is not action return manage.php
  };
}
else{
  // If there is not action, show post list    
 foreach ($post as $id => $post) { 
     echo"                       
<div >
    <table border=1>
     <tbody>
        <tr>
          <td>$post[id]</td>  
          <td>$post[title]</td>
          <td>
            <a href='?action=edit&post=$id'><button type='button'>Edit</button></a>  
            <a href='manage.php?action=delete&post=$post[id]'><button type='button'>Delete</button></a>
          </td>
        </tr>
     </tbody>
    </table>
</div>";
}
}