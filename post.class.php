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

    public function getSinglePost($post_id = null) // Get particular post
    {
        $sql = "SELECT * FROM posts WHERE post_id = ?";
        $data = $this->connect()->prepare($sql);
        $data->execute([$post_id]);

        return $data->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function createPost($title, $content){ // Create new post   
        $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
        $newPost = $this->connect()->prepare($sql);    
        $newPost->execute([$title, $content]);
    }
 
    public function updatePost($title, $content, $post_id) // Update post
    {
        $sql = "UPDATE posts SET title = ?, content = ? WHERE post_id = ?";
        $updatePost = $this->connect()->prepare($sql);    
        $updatePost->execute([
            $title,
            $content,
            $post_id,
        ]);
    }
  
    public function deletePost($post_id) // Delete post
    {
        $sql = "DELETE FROM posts where post_id = ?";
        $deletePost = $this->connect()->prepare($sql);    
        $deletePost->execute([$post_id]);
    }
}   
