<?php

// İçerisinde sadece Post sınıfının tanımlanması gerekiyor. Bu Post sınıfı ile:
//  Yazı listesine ulaşılması
//  Yazı detay bilgilerine ulaşılması
//  Yeni yazı ekleme işlemlerinin yapılması
//  Yazıyı güncelleme işlemlerinin yapılması
//  Yazıyı silme işlemlerinin yapılması

require_once "db.class.php"; 

class Post extends Db
{
    
  public function getPostlist() // Get all posts
  { try{ 
    $sqlcommand = "SELECT * FROM posts";               //SQL command prepare
    $statement = $this->connect()->query($sqlcommand); // Database connection and send command
    return $statement->fetchAll(PDO::FETCH_ASSOC);     // Return all post details 
    }catch(Exception $e){
    echo "Database error:" . $e->getMessage();
  }
  }                     

  public function getParticularPost($id=null) // Get particular post
  { 
    try{
    $sqlcommand = "SELECT * FROM posts WHERE id = ?";    // SQL command prepare
    $statement = $this->connect()->prepare($sqlcommand); // Database connection and prepare command 
    $statement->execute([$id]);                          // Send command
    return $statement->fetchAll(PDO::FETCH_ASSOC);       // Return single post detail
    }catch(Exception $e){
    echo "Database error:" . $e->getMessage();
  }
  }

  public function createPost( int $id, string $title, string $content) // Create new post
  { 
    try{
    $sqlcommand = "INSERT INTO posts (id,title,content) VALUES (:id,:title,:content)"; //SQL command prepare
    $statement = $this->connect()->prepare($sqlcommand);                               // Database connection and prepare command 
    return $statement->execute([":id"=>$id,":title"=>$title,":content"=>$content]);    // Bind key to variable 
    }catch(Exception $e){
    echo "Database error:" . $e->getMessage();
  }
  }

  public function deletePost($id) // Delete post
  {  
    try{
    $sqlcommand = "DELETE FROM posts WHERE id= ?";       //SQL command prepare
    $statement = $this->connect()->prepare($sqlcommand); // Database connection and prepare command  
    $statement->execute([$id]);                          // Send command
    }catch(Exception $e){
      echo "Database error" . $e->getMessage();
    }  
  }
  public function updatePost($id, $title, $content) // Update post
  {
    try{
    $sqlcommand = "UPDATE posts SET title=:title , content=:content WHERE id=:id "; //SQL command prepare
    $statement = $this->connect()->prepare($sqlcommand);                            // Database connection and prepare command 
    $statement->execute([                                                           // Send command
      ":title"=>$title,                                                             // Bind key to variable 
      ":content"=>$content,
      ":id"=>$id,
      ]);
    }catch(Exception $e){
      echo "Database error" . $e->getMessage();
    }         
  }   
}   