<?php
class Users {
    public $database;
 
    function __construct($dbconn) {
      $this->database = $dbconn;
    }

    public function userlogin($username, $password) {
       try {
          $stment = $this->database->prepare("SELECT * FROM user WHERE username=:username LIMIT 1");
          $stment->execute(array(':username'=>$username));
          $userRow=$stment->fetch(PDO::FETCH_ASSOC);

          if ($stment->rowCount() > 0) {
             if (password_verify($password, $userRow['password'])) {
                $_SESSION['user_online'] = $userRow['id'];
                return true;
             } else {   
                return false;
             }
          }
       }
       catch(PDOException $error){
           echo $error->getMessage();
       }
   }

    public function addUsers($username,$password) {
       try {

           $authentication = password_hash($password, PASSWORD_DEFAULT);
           $stment = $this->database->prepare("INSERT INTO user (username, password) VALUES(:username, :password)");
           $stment->bindparam(":username", $username);
           $stment->bindparam(":password", $authentication);            
           $stment->execute(); 
   
           return $stment; 
       }
       catch(PDOException $error) {
           echo $error->getMessage();
       }    
    }
    public function verifyaddUsers($connect) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //errors when not inputting or lack of inputs
    if ($username == "") {
      echo "Insert/Invalid Username"; 
    } else if ($password == "") {
      echo "Insert Password";
    } else if (strlen($password) < 7) {
      echo "Your password must be higher than 7 inputs";
    }
    //errors when already taken
   else {
      try {
         $stment = $this->database->prepare("SELECT username FROM user WHERE username=?");
         $stment->execute([$username]);
         $userRow=$stment->fetch(PDO::FETCH_ASSOC);

         if ($userRow['username'] == $username) {
            echo "The Username you inputted has already been taken";
         } else {
            if ($this->addUsers($username, $password)) {
                $this->link('user_login_page.php');
            }
         }
     }
     catch (PDOException $error){
        echo $error->getMessage();
     }
  }
}

    public function verifylogin($connect) {
      $username = $_POST['username'];
      $password = $_POST['password'];
         
      if ($this->userlogin($username,$password)) {
         $this->link('user_dboard.php');
      } else if ($username === "admin" && $password === "admin") {
         $_SESSION['admin'] = 'admin';
         $this->link('adminpage.php');
      } else {
       echo "<p style='color:red;'>Invalid Username/Password</p>";
      } 
    }
 
   public function already_login() {
      if(isset($_SESSION['user_online']) || isset($_SESSION['admin'])) {
         return true;
      }
   }
 
   public function link($url){
       header("Location: $url");
   }

  /*public function insertTask($task, $user_id){
   try{
      $stmt = $this->db->prepare("INSERT INTO tasks(task,user_id) VALUES(:task)");
      $stmt->bindparam(":task", $task);
  
      $stmt->execute();
         return true;
      }
      catch(PDOException $e){
        echo $e->getMessage();
        return false;
      }
   }*/

   public function name($user_id) {
      $stment = $this->database->prepare("SELECT * FROM users WHERE id=:user_id");
      $stment->execute(array(":user_id"=>$user_id));
      $connect = $stment->fetch(PDO::FETCH_ASSOC);

      return $connect;
   }
  
   /*public function updateTask($task_id, $new_task) {
      try{
          $stmt = $this->db->prepare("UPDATE tasks SET  task=:new_task WHERE id=:task_id");
          $stmt->bindparam(":new_task", $new_task);
          $stmt->bindparam(":task_id", $task_id);
          $stmt->execute();
          
          return $this->redirect('Todolist.php');

      }
      catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
  }*/
  
}

?>