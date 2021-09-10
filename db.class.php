<?php
//İçerisinde sadece DB sınıfının tanımlanması gerekiyor.Bu DB sınıfı Post sınıfında veya nesnesinde kullanılacaktır. Veritabanı ile haberleşme için kullanılması gerekiyor.
class Db 
{ 
    private string $dbname="group4";
    private string $username="root";
    private string $password= "123group4";
    private string $servername = "localhost";

    protected function connection()
    {
        try
        { 
            $dsn = "mysql:host=$this-> servername; dbname=$this->dbname";
            $pdo = new PDO($dsn, $this->password , $this->username);
            echo "Db bağlantısı kuruldu";
        }
        catch(Exception $e)
        {
            echo "Db hatası: " . $e->getMessage();
        }
        
    }
        protected function addPost(string $title, string $content)
    {
        try 
        {
          $sql = "INSERT INTO posts (Title, Content) 
                VALUES (_Title, _Content)";
            $explanation = $this->connection()->extend($sql);
            $explanation->Value("_Title", $title);
            $explanation->Value("_Content", $content);
            $explanation->execute();
        } 
        catch (Exception $e) 
        {
            echo "Db hatası: " . $e->getMessage();
        }
    }

    protected function updatePost( int $id,string $title,string $content) 
    {
        try 
        {
          $sql ="UPDATE posts SET Title = _Title, Content = _Content WHERE Id = :Id";
            $explanation = $this->connection()->extend($sql);
            $explanation->Value("_Title", $title);
            $explanation->Value("_Content", $content);
            $explanation->Value("_Id", $id);
            $explanation->execute();
        } 
        catch (Exception $e) 
        {
            echo "Db hatası: " . $e->getMessage();
        }
    }
    protected function deletePost(int $id)
    {  
        try 
        {
            $sql = "DELETE FROM posts WHERE Id = _Id";
            $explanation = $this->connection()->extend($sql);
            $explanation->Value("_Id", $id);
            $explanation->execute();
        } 
        catch (Exception $e) 
        {
            echo "Db hatası: " . $e->getMessage();
        }
    }
    
     protected function getPostDetails()
    {
        try 
        {
          $sql = "SELECT * FROM posts";
          $explanation = $this->connection()->extend($sql);
          $explanation->execute();
          $result = $explanation->fetchAll();
            return $result;
        } 
        catch (Exception $e) 
        {
            echo "Db hatası: " . $e->getMessage();
        }
    }
    
     protected function getSelectPostDetails(int $id)
    {
        try 
        {
          $sql = "SELECT * FROM posts WHERE Id = _Id";
          $explanation = $this->connection()->extend($sql);
          $explanation->Value("_Id", $id);
          $explanation->execute();
            
            $result = $explanation->fetchAll();
             return $result;
        } 
        catch (Exception $e)
        {
            echo "Db hatası: " . $e->getMessage();
        }
    }
}
?>

