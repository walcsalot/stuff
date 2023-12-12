<?php
  class Users {
    private $db;

    function __construct($db_conn){
      $this->db = $db_conn;

    public function addUser($post) {
    $name = $this->db->real_escape_string($_POST['name']);
    $uname = $this->db->real_escape_string($_POST['username']);
    $pass = $this->db->real_escape_string($_POST['password']);
    $query = "INSERT INTO user(name,username,password) VALUES('$name', '$uname', '$pass')";
    $sql = $this->db->query($query);

    if ($sql == true) {
    header("Location:registration_success.php");
  } else {
    echo "Registration failed try again!";
          }
}

    public function displayUser() {
    $query = "SELECT * FROM user";
    $result = $this->con->query($query);

      if ($result->num_rows > 0) {
          $data = array();
      while ($row = $result->fetch_assoc()) {
            $data[] = $row;
      }
        return $data;
      } else {
        echo "No found records";
      }
}

    public function Idrecord($id) {
    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = $this->con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
            echo "Record not found";
    }
}
    public function deleteUser($id) { //delete function
    $query = "DELETE FROM user WHERE id = '$id'";
    $sql = $this->con->query($query);
    
    if ($sql == true) {
            header("Location:viewusers.php?message2=delete");
    } else {
            echo "Record does not delete try again";
           }
  }
}

  class Login extends Users {
  
    public function login($uname, $pass) {
      $uname = $this->con->real_escape_string($_POST['username']);
      $pass = $this->con->real_escape_string($_POST['password']);

      $query = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";
      $sql = $this->con->query($query);
      $user = $sql->fetch_assoc();

      if ($sql->num_rows > 0) {

      session_start();
      $_SESSION['user_id'] = $user['id'];

      $this->con->close();
      header("Location: user_dboard.php");
      } else {
    header("Location: user_login_page.php?error=Wrong Username/Password");
  }
}

  public function is_loggedin(){
      if(isset($_SESSION['user_session'])){
         return true;
      }
   }
 
   public function redirect($url){
       header("Location: $url");
   }
 }

?>