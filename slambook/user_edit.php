<?php

include	'dbconn.php';

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "UPDATE user SET name='$name', username='$username', password='$password' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: viewusers.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();