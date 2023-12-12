<?php

include 'dbconn.php';
    $userbase = new Users();

  session_start();

 if (!isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
      $deleteId = $_GET['deleteId'];
      $userbase->deleteUser($deleteId);
   }
?>

<!DOCTYPE html>
<html>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>View users</title>

</head>
<body>

<style type="text/css">
   body {
     background-color: #D6EEEE;
   }

   table {
   border-collapse: collapse;
   width: 50%;
   }

   th, td {
   text-align: left;
   padding: 5px;
   }  
   tr:nth-child(odd) {
   background-color: #E6E6E6;
   }
   tr:nth-child(even) {
   background-color: #D6EEEE;
   }

</style>

<?php
    if (isset($_GET['message1']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              User updated successfully
            </div>";
    }
    if (isset($_GET['message2']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              User deleted successfully
            </div>";
    }
  ?>

      <header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="background-color:#892bcc;" data-bs-theme="dark">
      <ul class="nav">
      <li> <a class="navbar-brand col-1 me-0 px-4 fs-8 text-white" href="user_dboard.php">Logo</a> </li>
     <li> <a class="btn mx-2 me-0 px-4 fs-8 text-white" href="user_dboard.php">Dashboard</a> </li>
      </ul> 
        <a class=" px-3 btn" style="color:red" href="loggedout.php">Logout</a> </header>

   <table align = "center" border = "1" cellpadding = "3" cellspacing = "0">


   		<tr>
   			<th>ID</th>
            <th>Full Name</th>
   			<th>Username</th>
   			<th>Password</th>
            <th>Edit User</th>
   		</tr>

        <?php 
          $userr = $userbase->displayUser(); 
          foreach ($userr as $users) {
        ?>
   		<tr>
   			<td><?php echo $users['id']; ?> </td>
            <td><?php echo $users['name']; ?> </td>
   			<td><?php echo $users['username']; ?> </td>
   			<td><?php echo $users['password']; ?> </td>
            <td> <button class="btn btn-primary mr-2"><a href="user_edit_page.php?editId=<?php echo $users['id'] ?>">
              <i class="fa fa-pencil text-white" aria-hidden="true"></i></a></button>

            <button class="btn btn-danger"><a href="viewusers.php?deleteId=<?php echo $users['id'] ?>" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash text-white" aria-hidden="true"></i>
            </td>

   		</tr>
   	<?php } ?>

   </table>
</body>
</html>