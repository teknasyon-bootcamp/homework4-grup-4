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
}
?>

