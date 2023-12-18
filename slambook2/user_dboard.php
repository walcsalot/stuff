<?php
  include 'dbconn.php';

  if(!$connect->already_login()) {
  $connect->link("user_login_page.php?You are not logged in!");
  }
  
  $user_id = $_SESSION['user_online'];
  $user = $connect->displayName($user_id);

  if (isset($_POST['submit'])) {
    $connect->link('search_users.php');
  }
  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="user_dboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<style>
        <div "task-list" {
            top: 10%;
        }

</style>
<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1999px; height: 60px; background-color:#892bcc;" data-bs-theme="dark">
    <ul class="nav">
 
        <li><a class="navbar-brand fas fa-home  col-1 me-0 px-5 fs-10 text-white" href="user_dboard.php">Home</a></li>
        <li><a class="navbar-brand fas fa-user col-1 me-0 px-5 fs-8 text-white" href="user_todolist.php">To-Do List</a></li>
        <li><a class="navbar-brand fas fa-user-cog col-1 me-0 px-5 fs-8 text-white" href="Profile.php">Profile</a></li>
        <li><form method="GET" action="search_users.php">
        <label for="search"><b>Search Users:</label>
        <input type="text" name="search" placeholder="Enter username" style="width: 400px;  padding: 2px;">
        <button type="submit">Search</button>
    </form>
    </ul>
    <a class="navbar-brand fas fa-sign-out-alt " style="color:darkblue" href="loggedout.php">Logout</a>
</header>
	
<center> <div class="container" style="background-color: white; max-width: auto; max-height: 10px;">
			 <center> <h3> Hello, <?=$user['name']?></h3> <br> <br> </center>
		</div> </center>
</body>
</html>

