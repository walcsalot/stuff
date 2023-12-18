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
            padding: 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/564x/95/cd/d8/95cdd8f7ddfe6749009719ef83244793.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

		.container {
		    max-width: 300px;
		    margin: 0 auto;
		    margin-top: 100px;
		    padding: 25px;
		}	

        .profile-container {
            margin-top: 20px;
            text-align: center;
        }
	</style>

	<center> <div class="container shadow" style="max-width: 350px; background-color: white;">
		

			<h2> Register </h2> <br>

		 <div class="row">
		 	<form method="POST">

			<center> <div class="form-group mb-2 col-8 w-100 form-floating">
				<input type="text" name="name" class="form-control" required>
				<label>Name (Full Name is Optional)</label>
			</div> </center>

			<center> <div class="form-group mb-2 col-8 w-100 form-floating">
				<input type="text" name="username" class="form-control" required>
				<label>Username</label>
			</div> </center>

			<center> <div class="form-group mb-2 col-8 w-100 form-floating">
				<input type="password" name="password" class="form-control" required>
				<label>Password</label>
			</div> </center>

			<button class="mb-3 btn btn-primary w-100 py-3" style="background-color:darkcyan;" type="submit" name="submit" value="Register">Register</button>
		</div>
			<label>Already have an account?</label> <a class="btn-link" href="user_login_page.php" style="color:green;" role="button">Click here</a>
		</form>
	</div>
</center>
</body>
</html>