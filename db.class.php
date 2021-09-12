<?php
//İçerisinde sadece DB sınıfının tanımlanması gerekiyor.Bu DB sınıfı Post sınıfında veya nesnesinde kullanılacaktır. Veritabanı ile haberleşme için kullanılması gerekiyor.
class Db 
{ 
    public function __construct(
        private string $servername = "mariadb",
        private string $dbname="group4",
        private string $username="root",
        private string $password= "root",
    ){}

    protected function connect() // Database connection
    {
        try
        { 
            $dsn = "mysql:host=$this->servername; dbname=$this->dbname; charset=UTF8"; // Host and DB name
            $pdo = new PDO($dsn, $this->username, $this->password ); // PDO creation and DB connection
            return $pdo;
            echo "Veritabanı bağlantısı kuruldu";
        }
        catch(PDOException $e)
        {
            echo "Veritabanı hatası: {$e->getMessage()}";
            exit(1);
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

