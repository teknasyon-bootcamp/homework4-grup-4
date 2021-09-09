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
    {
        $allPosts = $this->connect()->query("SELECT * FROM posts");

        foreach($allPosts->fetchAll(PDO::FETCH_ASSOC) as $post) {
        echo "<li> {$post["title"]} </li>";
        }
    }

    public function getparticularPost($id = null) // Get particular post
    {
     $id = $_GET["id"]?? null;
     
        if (!$id)
        {
          header("index.php git");
        }

        $particularPost = $this->connect()->prepare("SELECT * FROM posts WHERE id = id");
        $particularPost->execute([$id]);

        return $particularPost->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost($id, $name, $content, $created_at){ // Create new post
        $error = [];
        $title = $_POST["title"]?? null;
        $content = $_POST["content"]?? null;

        if (!$title) // Check for title
        {
            $error[] = "Başlık gerekli";
        }

        if (!$content) // Check content
        {
            $error[] = "İçerik gerekli";
        }

        if (!empty($error)) // If exist error(s)
        {
            foreach ($error as $er): 
            echo "<div> {$er} </div>"; // Print error(s)
            endforeach;
        }
        else // Add new post to DB
        {    
            $newPost = $this->connect()->prepare("INSERT INTO posts VALUES (title, content)");    
            $newPost->execute();

            header("index.php git");
        }
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
  
    public function deletePost() // Delete post
    {
        $id = $_GET["id"]?? null;

        if(!$id) // Check if post id not exist
        {
        header ("index.php git");
        }
        else 
        {
            $deletePost = $this->connect()->prepare("DELETE FROM posts WHERE id = _id");    
            $deletePost->execute();

            header("index.php git");
        }
    }
}   
