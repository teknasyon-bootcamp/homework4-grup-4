  
<?php

 // İçerisinde sadece Post sınıfının tanımlanması gerekiyor. Bu Post sınıfı ile:
 //  Yazı listesine ulaşılması
 //  Yazı detay bilgilerine ulaşılması
 //  Yeni yazı ekleme işlemlerinin yapılması
 //  Yazıyı güncelleme işlemlerinin yapılması
 //  Yazıyı silme işlemlerinin yapılması

//dosya yolu bulunamassa eğer fatal error verdiğinden require_once tercih ediyorum
requre_once "db.class.php";

class Post extends Db{

    public function getPostlist()
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

    public function getparticularPost()
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

    public function createPost(){
        $error = [];
        $title = $_POST["title"]?? null;
        $content = $_POST["content"]?? null;

        if (!$title) //Başlık yoksa 
        {
            $error[] = "Başlık gerekli"; //Uyarı ver
        }
        if (!$content) //İçerik yoksa
        {
            $error[] = "İçerik gerekli"; //uyarı ver
        }

        if (!empty($error)) //$error boş değilse
        {
            <?php foreach ($error as $er):?> //$error daki içeriği $er aktar 
            <div><?php echo $er ?> </div> //$er'i ekrana bas
            <?php endforeach; ?>
            </div> <?php
        }

        else 
        {  // Yeni yazı ekleme işlemlerinin yapılması
            
            $sql="INSERT INTO sections(title, content) 
                  VALUES (_title, _content)";
            $explanation = $this->connection()->extend($sql);
            $explanation->Value('_title',$title);
            $explanation ->Value('_content',$content);
            $explanation->execute();

            header("index.php git");
        }
    }



?>
