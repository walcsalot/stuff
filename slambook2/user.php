<?php
class Users {
    public $database;
 
    function __construct($dbconn) {
      $this->database = $dbconn;
    }
    
    //allows you to log in
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
    //adds a user to log in
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

    //it verifies what you input in the Registration Form
    public function verifyaddUsers($connect) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //errors when not inputting a lot or lack of inputs
    if ($username == "") {
      echo "Insert/Invalid Username"; 
    } else if (strlen($username) > 20) {
      echo "Your Username is too long! Make it lesser than 20";
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
    //it verifies the log in you input, directing you into userlogin function if correct, if you input admin in both username and password, it directs you to the admin page instead
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
   
   //it puts you back in the Dashboard page if you go to the Login Page while in session
   public function already_login() {
      if(isset($_SESSION['user_online']) || isset($_SESSION['admin'])) {
         return true;
      }
   }

   //links you to a different page
   public function link($url){
       header("Location: $url");
   }
   //end of users stuff

   
   //shows you the name you inputted through the registration form
   public function displayName($user_id) {
      $stment = $this->database->prepare("SELECT * FROM user WHERE id=:user_id");
      $stment->execute(array(":user_id"=>$user_id));
      $connect = $stment->fetch(PDO::FETCH_ASSOC);

      return $connect;
   }

   //edit stuff
   //it lets you edit the Name, Username, and Password in the admin page
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
     //this is for the to-do list page, it lets you put a list.
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
    //gives you an option to edit the list
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
  
    //same thing as the updatelist function, but for admins.
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