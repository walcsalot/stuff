<?php 

include 'dbconn.php';

    if (isset($_GET['id'])) {
        $user_id = $_GET['id']; 
        $stment = $dbconn->prepare("SELECT * from user WHERE id=:user_id");
        $stment->execute([':user_id' => $user_id]);
        $users = $stment->fetch(PDO::FETCH_ASSOC);
    }
    

    if (isset($_POST['submit'])) {  
        $editname = $_POST['editname'];
        $editusername = $_POST['editusername'];
        $editpassword = $_POST['editpassword'];
        $connect->updateProfile($user_id, $editname, $editusername, $editpassword);
    }

 ?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initil-scale=1">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<style type="text/css">
body {
      background-color: #D6EEEE;
}
 input[type="submit"] {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
          
        }


</style>


<form method="POST">
    <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
<center>
        <h3> <label>Name</label> </h3>
        <input type="text" name="editname" value="<?php echo $users['name']; ?>"> <br>
        <h3> <label>username</label> </h3>
        <input type="text" name="editusername" value="<?php echo $users['username']; ?>"> <br>
        <h3> <label>password:</label> </h3>
        <input type="text" name="editpassword" value="<?php echo $users['password']; ?>"><br><br>
        <input type="submit" name="submit" value="Update User">
         <a href="Profile.php">Cancel</a>
</center>

</form>
</body>
</html>