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
        $explanation = $this->connection()->extend($sql); 
        $explanation->execute();
        
    $result = $explanation->fetchAll();
    
        foreach ($result as $s)
        {
          echo $s[1] . "<br>";
          echo $s[2] . "<br>";
          echo $s[3] . "<br>";
        }
    }

    public function getparticularPost() // Get particular post
    {
     $id = $_GET["id"]?? null;
     
        if (!$id)
        {
          header("index.php git");
        }
          $sql = "SELECT * FROM posts WHERE id = _id";
          $explanation = $this->connection()->extend($sql);
          $explanation->Value("_id",$id);
          $explanation->execute();

        while($result = $explanation->fetchAll()){
            return $result;
        }
    }

    public function createPost(){ // Create new post
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
            $sql="INSERT INTO sections(title, content) 
                  VALUES (_title, _content)";
            $explanation = $this->connection()->extend($sql);
            $explanation->Value('_title',$title);
            $explanation ->Value('_content',$content);
            $explanation->execute();

            header("index.php git");
        }
    }
 
    public function updatePost() // Update post
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
            $sql = "UPDATE sections SET title = _title, content = _content WHERE id = _id)";
            $explanation = $this->connection()->prepare($sql);
            $explanation->Value("_title" , $title);
            $explanation->Value("_content" , $content);
            $explanation->Value("_id" , $id);
            $explanation->execute();
            
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
        $sql = "DELETE FROM posts WHERE id = _id";
        $explanation = $this->connection()->extend($sql);
        $explanation->Value("_id",$id);
        $explanation->execute();
        
        header("index.php git");
        }
    }
}   
