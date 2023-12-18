<?php
class Users {
    public $database;
 
    function __construct($dbconn) {
      $this->database = $dbconn;
    }
    
    //users stuff
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

    public function addUsers($name,$username,$password) {
       try {

           $authentication = password_hash($password, PASSWORD_DEFAULT);
           $stment = $this->database->prepare("INSERT INTO user (name, username, password) VALUES(:name, :username, :password)");
           $stment->bindparam(":name", $name);
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
    $name = $_POST['name'];
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
         $stment = $this->database->prepare("SELECT name,username FROM user WHERE name=? OR username=?");
         $stment->execute([$name,$username]);
         $userRow=$stment->fetch(PDO::FETCH_ASSOC);

         if ($userRow['username'] == $username) {
            echo "The Username you inputted has already been taken";
         } else {
            if ($this->addUsers($name, $username, $password)) {
                $this->link('registration_success.php');
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
         $this->link('viewusers.php');
      } else {
       echo "<center> <p style='color:red;'>Invalid Username/Password</p> <center>";
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
   //end of users stuff

   //search user
   /*public function searchUsers($search) {
        try {
            $stment = $this->database->prepare("SELECT * FROM user WHERE name LIKE :search");
            $stment->bindValue(':search', '%' . $search . '%');
            $stment->execute();
            $connect = $stment->fetchAll(PDO::FETCH_ASSOC);

            return $connect;

        } catch (PDOException $error) {
          echo $error->getMessage();
          return false;
        }
}*/

   //shows you the name you inputted through the registration form
   public function displayName($user_id) {
      $stment = $this->database->prepare("SELECT * FROM user WHERE id=:user_id");
      $stment->execute(array(":user_id"=>$user_id));
      $connect = $stment->fetch(PDO::FETCH_ASSOC);

      return $connect;
   }

   //edit stuff
   public function editUsers($user_id, $name, $username, $password) {
      try {
          $authentication = password_hash($password, PASSWORD_DEFAULT);
          $stment = $this->database->prepare("UPDATE user SET name=:name, username=:username, password=:password WHERE id=:user_id");
          $stment->bindparam(":name", $name);
          $stment->bindparam(":username", $username);
          $stment->bindparam(":password", $authentication);
          $stment->bindparam(":user_id", $user_id);
          $stment->execute();
          
          return $this->link('viewusers.php?Success');

      }
      catch(PDOException $error) {
          echo $error->getMessage();
          return false;
      }
   }
     public function insertList($list, $user_id){
      try {
        $stment = $this->database->prepare("INSERT INTO lists (list, user_id) VALUES (:list, :name)");
        $stment->bindparam(":list", $list);
        $stment->bindparam(":name", $user_id);
        $stment->execute();
         return true;
      }
      catch(PDOException $error) {
        echo $error->getMessage();
        return false;
      }
   }

    public function updateList($list_id, $updatelist) {
      try {
          $stment = $this->database->prepare("UPDATE lists SET list=:updatelist WHERE id=:list_id");
          $stment->bindparam(":updatelist", $updatelist);
          $stment->bindparam(":list_id", $list_id);
          $stment->execute();
          
          return $this->link('user_todolist.php');

      }

      catch(PDOException $error) {
          echo $error->getMessage();
          return false;
      }
  }
    public function adminupdateList($list_id, $updatelist) {
      try {
          $stment = $this->database->prepare("UPDATE lists SET list=:updatelist WHERE id=:list_id");
          $stment->bindparam(":updatelist", $updatelist);
          $stment->bindparam(":list_id", $list_id);
          $stment->execute();
          
          return $this->link('viewusers.php');

      }

            catch(PDOException $error) {
          echo $error->getMessage();
          return false;
      }
  }

}//User Class Close
?>