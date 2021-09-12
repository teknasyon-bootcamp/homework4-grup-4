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

    public function connect() // Database connection
    {
        try
        { 
            $dsn = "mysql:host=$this->servername; dbname=$this->dbname; charset=UTF8"; // Host and DB name
            $pdo = new PDO($dsn, $this->username, $this->password ); // PDO creation and DB connection
            return $pdo;
        }
        catch(PDOException $e)
        {
            echo "Database error: {$e->getMessage()}";
            exit(1);
        }     
    }
}

?>