<?php
	include 'dbconn.php';

  if (!$connect->already_login()){
  $connect->link('user_login_page.php');
  }
  
  $user_id = $_SESSION['user_session'];
  $name = $connect->name($user_id);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<style>
	body {
	  background-color: #D6EEEE;
	}
</style>
   <header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="background-color:#892bcc;" data-bs-theme="dark">
      <ul class="nav">
      <li> <a class="navbar-brand col-1 me-0 px-4 fs-8 text-white" href="user_dboard.php">Logo</a> </li>
	  <li> <a class="btn mx-2 me-0 px-4 fs-8 text-white" href="user_dboard.php">Dashboard</a> </li>
	  <li> <a class="btn mx-2 me-0 px-4 fs-8 text-white" href="viewusers.php">admin</a> </li>
      </ul>

		  <a class=" px-3 btn" style="color:red" href="loggedout.php">Logout</a>
	</header>
	
		<center> <div class="container">
			<h1> Hello, <?=$name['username']?></h1> <br> <br>
		</div> </center>

</body>
</html>