<?php
	include 'dbconn.php';

	if ($connect->already_login()!="") {
       $connect->link('user_dboard.php?Already logged in!');
	}

	//submit
	if (isset ($_POST['submit']) ) {
		$connect->verifyaddUsers($_POST);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Form</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
	<style>
body {
	  background-color: #D6EEEE;
}
.container {
    max-width: 300px;
    margin: 0 auto;
    margin-top: 100px;
    padding: 20px; 
}
	</style>

	<center> <div class="container shadow" style="max-width: 350px; background-color: white;">
		

			<h2> Register </h2> <br>

		 <div class="row">
		 	<form method="POST">

			<center> <div class="form-group mb-2 col-8 form-floating">
				<input type="text" name="username" class="form-control" required>
				<label>Username</label>
			</div> </center>

			<center> <div class="form-group mb-2 col-8 form-floating">
				<input type="password" name="password" class="form-control" required>
				<label>Password</label>
			</div> </center>

			<button class="mb-3 btn btn-primary w-75 py-3" style="background-color:darkcyan;" type="submit" name="submit" value="Register">Register</button>
		</div>
			<label>Already have an account?</label> <a class="btn-link" href="user_login_page.php" style="color:green;" role="button">Click here</a>
		</form>
	</div>
</center>
</body>
</html>