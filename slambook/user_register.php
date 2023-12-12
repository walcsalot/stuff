<?php

include 'dbconn.php';

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO user (name, username, password) VALUES ('$name', '$username', '$password')";

	if ($conn->query($sql) === TRUE) {
	
	header("Location: registration_success.php");

	exit();
	} else {
		header("Location: user_register_page.php?error=Input Credentials");
	}

	$conn->close();