<?php
  class Users {

    public $database;

    function __construct($dbconn){
      $this->database = $dbconn;
  }

 
    public function userlogin($uname, $pword){
       try {
          $state = $this->database->prepare("SELECT * FROM user WHERE username=:username LIMIT 1");
          $state->execute(array(':username'=>$uname));
          $uRow = $state->fetch(PDO::FETCH_ASSOC);

          if ($state->rowCount() > 0) {
             if (password_verify($pword, $uRow['password'])){
                $_SESSION['user_online'] = $uRow['id'];
                return true;
             }
             else {
                return false;
             }
          }
       }

       catch ( PDOException $error ) {
           echo $error->getMessage();
       }
   }

    public function verifylogin($connect){
      $uname = $_POST['username'];
      $pword = $_POST['password'];
         
      if ($this->userlogin($uname,$pword)) {
         $this->link('user_dboard.php');
      } else if ($uname === "admin" && $pword === "admin") {
         $_SESSION['admin'] = 'admin';
         $this->link('adminpage.php');
      } else {
       echo "<p style='color:red;'>Invalid Username/Password</p>";
      } 
    }

    public function addUsers($name, $uname, $pword) {
       try {
           $authorization = password_hash($pword, PASSWORD_DEFAULT);
   
           $state = $this->database->prepare("INSERT INTO user (name, username,password) VALUES(:name, :username, :password)");           
           $state->bindparam(":name", $name);
           $state->bindparam(":username", $uname);
           $state->bindparam(":password", $authorization);            
           $state->execute(); 
           return $state; 
       }
       catch( PDOException $error ){
           echo $error->getMessage();
       }    
    }

   public function displayName($user_id) {
      $state = $this->database->prepare("SELECT * FROM user WHERE id=:user_id");
      $state->execute(array(":user_id"=>$user_id));
      $connect = $state->fetch(PDO::FETCH_ASSOC);

      return $connect;
   }

   public function already_login() {
      if (isset($_SESSION['user_online']) || isset($_SESSION['admin'])) {
         return true;
      }
   }
 
   public function link($url){
       header("Location: $url");
   }
 
}
?>