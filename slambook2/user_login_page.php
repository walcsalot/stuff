<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
	<style>
 body{
            padding: 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/564x/d1/b0/83/d1b083ac9d9344250908137e08d6eb20.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
.container {
    max-width: 300px;
    margin: 0 auto;
    margin-top: 75px;
    padding: 50px;
}

	</style>

	<center> <div class="container shadow" style="max-width: 350px; background-color: white;">
      

		 <h2>Login here!</h2> <br>
     <?php

	include 'dbconn.php';

    if ($connect->already_login()!="") {
    	$connect->link('user_dboard.php');
    }

	if (isset($_POST['submit'])) {
        $connect->verifylogin($_POST);
    }
?>
     
		<form method="POST">
		 <div class="form-group mb-2 form-floating">
		 	<input type="text" name="username" class="form-control">
		 	<label>Username</label>
		 </div>
		 <div class="form-group mb-2 form-floating">
		 	<input type="password" name="password" class="form-control">
		 	<label>Password</label>
		 </div>

		 <button class="form-group mb-3 btn btn-primary w-100 " style="background-color:darkcyan;" type="submit" name="submit">Log in</button>

		 <a class="btn-link" href="user_register_page.php" style="color:darkgreen;" role="button">Register</a>

		</form>
	</div>
 </center>

</body>
</html>
