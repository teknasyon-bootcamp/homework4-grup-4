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
        $sql = "SELECT * FROM posts"; // SQL query 
        $data = $this->connect()->query($sql); // Quering DB 

        return $data->fetchAll(PDO::FETCH_ASSOC); // Get all posts data from DB
    }

    public function getSinglePost($post_id = null) // Get particular post
    {
        $sql = "SELECT * FROM posts WHERE post_id = ?"; // SQL query 
        $data = $this->connect()->prepare($sql); // Quering DB
        $data->execute([$post_id]); // Get post from DB

        return $data->fetchAll(PDO::FETCH_ASSOC); // Get posts from DB
    }

    public function createPost($title, $content){ // Create new post   
        $sql = "INSERT INTO posts (title, content) VALUES (?, ?)"; // SQL query 
        $newPost = $this->connect()->prepare($sql); // Quering DB    
        $newPost->execute([$title, $content]); // Create new post at DB
    }
 
    public function updatePost($title, $content, $post_id) // Update post
    {
        $sql = "UPDATE posts SET title = ?, content = ? WHERE post_id = ?"; // SQL query 
        $updatePost = $this->connect()->prepare($sql); // Quering DB
        $updatePost->execute([$title, $content, $post_id]); // Update post at DB
    }
  
    public function deletePost($post_id) // Delete post
    {
        $sql = "DELETE FROM posts where post_id = ?"; // SQL query 
        $deletePost = $this->connect()->prepare($sql); // Quering DB
        $deletePost->execute([$post_id]); // Delete post from DB
    }
}   
