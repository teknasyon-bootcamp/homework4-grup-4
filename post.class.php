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
        $sql = "SELECT * FROM posts";
        $data = $this->connect()->query($sql);

        return $data->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getparticularPost($post_id = null) // Get particular post
    {
        $sql = "SELECT * FROM posts WHERE post_id = ?";
        $data = $this->connect()->prepare($sql);
        $data->execute([$post_id]);

        return $data->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function createPost($title, $content, $published_at){ // Create new post
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
            $sql = "INSERT INTO posts VALUES (title, content)";
            $newPost = $this->connect()->prepare($sql);    
            $newPost->execute([$title, $title, $content, $published_at]);

        }
    }
 
    public function updatePost($post_id, $title, $content) // Update post
    {
        $post_id = $_GET["post_id"]?? null;

        if (!$post_id) // Check if post post_id not exist
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
            $sql = $str = "UPDATE posts SET title = ?, content = ? WHERE post_id = ?";
            $updatePost = $this->connect()->prepare($sql);    
            $updatePost->execute([
                $title,
                $content,
                $post_id,
            ]);

        }
    }
  
    public function deletePost($post_id) // Delete post
    {
        $post_id = $_GET["post_id"]?? null;

        if(!$post_id) // Check if post post_id not exist
        {
        header ("index.php git");
        }
        else 
        {
            $sql = "DELETE FROM posts where post_id = ?";
            $deletePost = $this->connect()->prepare($sql);    
            $deletePost->execute([$post_id]);
        }
    }
}   
