<?php

// İçerisinde sadece Post sınıfının tanımlanması gerekiyor. Bu Post sınıfı ile:
//  Yazı listesine ulaşılması
//  Yazı detay bilgilerine ulaşılması
//  Yeni yazı ekleme işlemlerinin yapılması
//  Yazıyı güncelleme işlemlerinin yapılması
//  Yazıyı silme işlemlerinin yapılması

require_once "db.class.php"; // Require db.class file

class Post extends Db
{
    public function getPostlist() // Get all posts
    {   $sqlcommand = "SELECT *FROM posts";
        $allPosts = $this->connect()->query($sqlcommand);

        foreach($allPosts->fetchAll(PDO::FETCH_ASSOC) as $post) {
        echo "<div><h1>{$post["title"]}</h1>
        {$post["content"]}</div>";
        
        }
    }

    public function getParticularPost(int $id) // Get particular post
    {
    // $id = $_GET["post"]?? null;
     
      //  if (!$id)
      // {
      //    header("index.php git");
      // }
      //   else{
            $sqlcommand = "SELECT * FROM posts WHERE id = :id";
            $statement = $this->connect()->prepare($sqlcommand);
            $statement->bindValue(":id",$id);
            $statement->execute();
            $particularPost = $statement->fetchAll(PDO::FETCH_ASSOC);
          //  var_dump($result);
        //  if(!is_int($particularPost["id"])) {
        //    echo "<h1>Posta erişilemedi </h1>";
        //}
        
            foreach($particularPost as $post )
            echo "<div><h1>{$post["title"]}</h1>
            {$post["content"]}</div>";
           
         //  if(empty($result[0])){
         //       return 0;
         //   }
        //    return $result;
      //  $particularPost = $this->connect()->query("SELECT * FROM posts WHERE id = :id");
       // $particularPost->execute([$id]);
      //  }
      //  return $particularPost->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost(int $id, string $title, string $content){ // Create new post
      //  $error = [];
      //  $title = $_POST["title"]?? null;
      //  $content = $_POST["content"]?? null;

      //  if (!$title) // Check for title
      //  {
      //      $error[] = "Başlık gerekli";
      //  }

      //  if (!$content) // Check content
      //  {
     //       $error[] = "İçerik gerekli";
     //   }

      //  if (!empty($error)) // If exist error(s)
      //  {
      //      foreach ($error as $er): 
     //       echo "<div> {$er} </div>"; // Print error(s)
      //      endforeach;
      //  }
      //  else // Add new post to DB
     //  {   //ADD NEW POST
            $sqlcommand = "INSERT INTO posts (id,title,content) VALUES (:id,:title,:content)"; 
            $statement = $this->connect()->prepare($sqlcommand);
            $statement->bindValue(":id",$id);
            $statement->bindValue(":title",$title);
            $statement->bindValue(":content",$content);    
            $statement->execute();

      //      header("index.php git");
     //   }
    }
 
    public function updatePost($id, $name, $content) // Update post
    {
        $id = $_GET["id"]?? null;

        if (!$id) // Check if post id not exist
        {
          header("index.php git");
        }

        $error = [];
        $title = $_POST["title"]?? null;
        $content = $_POST["content"]?? null;

        if(!$title) // Check for title
        {
          $error[] = 'Başlık gerekli';
        }

        if (!$content) // Check for content
        {
            $error[] = "İçerik gerekli";
        }

        if (!empty($error)) // If exist error(s)
        {
            foreach ($error as $er):
            echo "<div> {$er} </div>"; // Print error(s)
            endforeach;
        }
        else // Update post
        {
            $updatePost = $this->connect()->prepare("UPDATE sections SET id = id, title = title, content = content WHERE id = id)");    
            $updatePost->execute([
                $id,
                $name,
                $content,
            ]);

            header("index.php git");
        }
    }
  
    public function deletePost($id) // Delete post
    {    $sqlcommand = "DELETE FROM posts WHERE id= :id";
      //  $id = $_GET["id"]?? null;

      //  if(!$id) // Check if post id not exist
      //  {
      //  header ("index.php git");
      //  }
      //  else 
      //  {
            $statement = $this->connect()->prepare($sqlcommand);
            $statement->bindValue(":id",$id);    
            $statement->execute();

         //   header("index.php git");
     //   }
    }
}   