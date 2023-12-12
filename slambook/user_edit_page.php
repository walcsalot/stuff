<?php 

include 'dbconn.php';
$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id='$id'";
$result = $conn->query($sql);
$users = $result->fetch_assoc();
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
.container {
    max-width: 300px;
    margin: 0 auto;
    margin-top: 100px;
    padding: 20px; 
}
</style>


<center> <div class="container shadow" style="max-width: 450px; background-color: white;">
		<form action="user_edit.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $users['id']; ?>">

			<h2> Register </h2> <br>

		 <div class="row">
			<center> <div class="mb-2 col-15 form-floating">
				<input type="text" name="name" value="<?php echo $users['name']; ?>" class="form-control" required="">
				<label>Full Name</label>
			</div> </center>

			<center> <div class="mb-2 col-8 form-floating">
				<input type="text" name="username" value="<?php echo $users['username']; ?>" class="form-control" required>
				<label>Username</label>
			</div> </center>

			<center> <div class="mb-2 col-8 form-floating">
				<input type="text" name="password" value="<?php echo $users['password']; ?>" class="form-control" required>
				<label>Password</label>
			</div> </center>

			<button class="mb-3 btn btn-primary w-100 py-3" style="background-color:darkcyan;" type="submit" name="submit" value="Update User">Update User</button>
		</div>
		</form>
	</div>
</center>
</body>
</html>