  
<?php

 // İçerisinde sadece Post sınıfının tanımlanması gerekiyor. Bu Post sınıfı ile:
 //  Yazı listesine ulaşılması
 //  Yazı detay bilgilerine ulaşılması
 //  Yeni yazı ekleme işlemlerinin yapılması
 //  Yazıyı güncelleme işlemlerinin yapılması
 //  Yazıyı silme işlemlerinin yapılması

//manage.php - post listesi görünüyor mu? Yeni yazı eklemek için bir link bulunuyor mu? Yazı listesinde herbir yazı için düzenleme ve silme linkleri bulunuyor mu?
//manage.php?action=create - yeni post oluşturma formu görüntüleniyor mu?(YAPILDI)
//manage.php veya manage.php?action=store - Yeni post oluşturma işlemi yapıldı mı?(YAPILDI)
//manage.php?action=edit&post=1 - İlgili postu güncelleme için form görüntüleniyor mu? Formdaki alanların değerleri ilgili postun değerleri ile güncellenmiş mi?(YAPILDI)
//manage.php veya manage.php?action=update&post=1 - İlgili postun güncelleme işlemi yapıldı mı? (YAPILDI)
//manage.php?action=delete&post=1 - İlgili postun silinme işlemi yapıldı mı? (YAPILDI)

//dosya yolu bulunamassa eğer fatal error verdiğinden require_once tercih ediyorum
requre_once "db.class.php";

class Post extends Db
{
   private $posts = [];
   private $manage = 0;
   $action = 0;
    public function getPostlist(int $manage = 0)
    { // db den post dataları pull etme 
        $this->manage = $manage;
        $this->posts = $this->getPostDetails();
        switch ($action) 
        {
          case "Create":
                $this->createForm();
                break;
          case "Store":
                $this->createFormPost();
                break;
          default:
               $this-->listPost();
        }
    }
       public function getSelectPostList(int $manage = 0)
    {
        $id = $_GET["post"];
        $action = 0;
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        //Db den Id to post value pull 
        $this->manage = $manage; 
        $this->posts = $this->getSelectPostDetails($id);
        switch ($action) 
        {
           case "Create":
                $this->createForm();
                break;
           case "Store":
                $this->createFormPost();
                break;
           case "Edit":
                $this->editForm($id);
                break;
           case "Update":
                $this->editFormPost($id);
                break;
           case "Delete":
                $this->DeletePost($id);
                break;
            default:
                echo "Undefined";
                $this->listPost();
        }
    }
  
    public function formPost()
    {
        if (!empty($_POST["title"])) 
        {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $this->addPost($title, $content);
        }
    }
    public function createForm()
    {
        $action = "manage.php?action=store";?>
        <form method="post" action="<?php echo $action; ?>"> //Yeni post oluşturma işlemi yapılması
           <div>
           <label for="exampleFormControlInput">Title</label>
           <input type="text" name="title" required value>
            </div>              
              <div>
              <label for="exampleFormControlTextarea">Content</label>
              <textarea name="content"  required value rows="6">
               </textarea>
               </div>
       <button type="submit">Send</button>
         </form>
  <?php
    }
      public function createFormPost()
    {
        if (!empty($_POST["title"])) 
        {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $this->addPost($title, $content);
            echo 'Ekleme işlemi gerçekleşti . <a href="manage.php">Geri</a>';
        } 
        else 
        {
            echo "ERROR";
        }
    }
  
   public function listPost()
    { 
        $manage = $this->manage;
        $posts = $this->posts;
       
        if(array($posts)) 
      {
           if(count($posts) == 1) 
        {

          if(!empty($posts[0]["Id"])) //Seçilen Post kısmı
            {
               $this->Post($posts[0]["Id"], $posts[0]);
            }
         }   
            else 
            {
                echo "POST YOK";
            }
        }
    }
  
      public function postView(int $a, array $b) // Postları görüntüleme
    {
        $manage = $this->manage;
        $posts = $this->posts;
        
    <?php if ($manage) { ?>
    <a href="manage.php?action=delete&post=<?php echo $a; ?>" role="button">Delete</a>  
    <a href="manage.php?action=edit&post=<?php echo $a; ?>" role="button">Edit</a>
    <?php }
     <a href="<?php echo !empty($this->manage)
      ? "manage.php"
      : "index.php"; ?>?post=<?php echo $a; ?>" role="button">Show</a> 
  <?php } ?>

  <?php}
    public function editForm($id = 0)
    {
        if (!empty($id))
         {
            $b = $this->getSelectPostDetails($id);
            foreach($b as $a => $c)
            {
                $title = $c["Title"];
                $content = $c["Content"];
            }
        
            $action = "manage.php?action=update&post=$id";

        }
        ?>
    <form method="post" action="<?php echo $action; ?>">
     <div>
    <label for="exampleFormControlInput">Title</label>
    <input type="text" name="title" required value="<?php echo $title; ?>">                
     </div>
    
  <div>
  <label for="exampleFormControlTextarea1">Content</label>
  <textarea name="content" required value rows="6"><?php echo $content; ?></textarea>
  </div>
  <button type="submit">Send</button>
    </form>
  <?php
    }

      public function editFormPost($id)
    {
        if (!empty($_POST["title"])) 
        {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $this->updatePost($id, $title, $content);
            echo 'Update işlemi gerçekleştirildi. <a href="manage.php">Geri</a>';
        }
    }

 public function DeletePost(int $id)
    {
        $this->deletePost($id);
        echo 'Delete işlemi gerçekleştirildi. <a href="manage.php">Geri</a>';
    }

}

?>
